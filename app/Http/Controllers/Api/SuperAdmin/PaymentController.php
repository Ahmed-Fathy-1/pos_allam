<?php

namespace App\Http\Controllers\Api\SuperAdmin;

use App\Enums\packagePaymentEnum;
use App\Http\Controllers\Controller;
use App\Http\Requests\Api\Payments\PaymentRequest;
use App\Models\Payment;
use App\Models\SuperAdmin\Package;
use App\Models\SuperAdmin\User;
use Illuminate\Support\Facades\DB;
use Stripe\StripeClient;
use Stripe\PaymentIntent;
use Stripe\Stripe;
use Exception;
use Illuminate\Http\Request;
use Illuminate\Support\Str;
use Stripe\Stripe as StripeGateway;

class PaymentController extends Controller
{

    public function initiatePayment(PaymentRequest  $request){
        DB::beginTransaction();
        try {
            $packageId =  $request->package_id;
            $package = Package::with('packageDetails')->findOrFail($packageId);

            // dd($package);

            if ($request->package_type == packagePaymentEnum::MONTHLY->value) {
                $amount = $package->packageDetails->Price_monthly;
            } else {
                $amount = $package->packageDetails->Price_annually;
            }

            if (!$amount) {
                return response()->json(['error' => 'Invalid package price'], 400);
            }

            $stripe = new StripeClient(config('services.stripe.secret'));

            $paymentIntent = $stripe->paymentIntents->create([
                'amount' => $amount * 100,
                'currency' => 'EGP',
                'automatic_payment_methods' => [
                    'enabled' => true,
                ],
            ]);

            $payment = new Payment();

            $payment->forceFill([
                'user_id' => $request->user_id,
                'package_id' => $request->package_id,
                'amount' => $amount,
                'domain_name' => $request->domain_name,
                'currency' => $paymentIntent->currency,
                'receipt' => $paymentIntent->receipt_email ?? null,
                'methods' => 'Stripe',
                'status' => 'pending',
                'transaction_id' => $paymentIntent->id,
                'transaction_data' => json_encode($paymentIntent),
            ])->save();

            $paymentData = [
                'id' =>$payment->id,
                'client_secret' => $paymentIntent->client_secret,
                'payment_intent' => $paymentIntent->id,
            ];

            DB::commit();

            return  response()->json(['data' => $paymentData]);
        }catch (\Exception $ex){
            DB::rollBack();
            return  response()->json('error on payment process',['error' =>$ex->getMessage()]);
        }
    }

    public function completePayment(Request $request)
    {
        Stripe::setApiKey(env('STRIPE_SECRET'));

        try {
            $paymentIntent = PaymentIntent::retrieve($request->payment_intent_id);
            $paymentIntent->confirm();

            return response()->json([
                'status' => $paymentIntent->status,
            ]);
        } catch (Exception $e) {
            return response()->json(['error' => $e->getMessage()], 500);
        }
    }


}
