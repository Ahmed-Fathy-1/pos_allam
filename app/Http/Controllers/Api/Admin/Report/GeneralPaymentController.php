<?php

namespace App\Http\Controllers\Api\Admin\Report;

use App\Enums\PaymentTransferEnum;
use App\Http\Controllers\Controller;
use App\Http\Requests\Admin\GeneralPaymentRequest;
use App\Models\Customer;
use App\Models\Order;
use App\Models\PaymentTransfer;
use App\Models\Setting;
use App\services\report\GeneralPaymentServices;
use Barryvdh\DomPDF\Facade\Pdf;
use Carbon\Carbon;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class GeneralPaymentController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index(Request $request)
    {
        $paginate = $request->number??10;
        $customers = Customer::whereHas('addresses')->get();
        $paymentTransfers = PaymentTransfer::latest('id')->paginate($paginate);
        return view('Admin.pages.report.generalPayment.index',
            [
                'customers' => $customers,
                'paginate' => $paginate,
                'paymentTransfers' => $paymentTransfers
            ]);
    }

    /**
     * Store a newly created resource in storage.
     */

  final  public function store(GeneralPaymentRequest $request)
    {
        DB::beginTransaction();
        try {
            $data = $request->validated();
            if($data['paid_at'] == null){
                $data['paid_at'] = Carbon::now();
            }
            $customer = Customer::findOrFail($data['customer_id']);
            $data['remaining'] = $data['total_due'] - $data['amount_paid'];
            $remove_amount = Setting::where('key', 'amount_remove')->first();
            if($data['remaining'] <= 0){
                $data['remaining'] = 0;
            }elseif($data['remaining'] <=$remove_amount->value){
                $data['remaining'] = 0;
            }
            if($data['amount_paid'] > $data['total_due']){
                $data['over_payment'] = $data['amount_paid'] - $data['total_due'];
                $balance = $customer->balance + $data['over_payment'];
                $customer->update(['balance' => $balance]);
            }
            $generalPayment = PaymentTransfer::create($data);
            $generalPayment->refresh();

            $orders = Order::where('customer_id',$data['customer_id'])
                        ->where('status', '!=', 1)
                        ->whereColumn('total','!=','amount_paid')->get();

            $amountPaid = (float) $data['amount_paid'];
            $ids = [];
            foreach ($orders as $order){
                //unpaid
                if($order->status == 0)
                {
                    if($amountPaid >= $order->total)
                    {
                        $deserved_amount = $order->total;
                        $order->update([
                            'status' => 1,
                            'payment_status' => $data['payment_type'],
                            'paid_at' => $data['paid_at'],
                            'amount_paid' =>$order->total ,
                        ]);
                        $order->refresh();
                        $generalPayment->ordersTansfer()->attach($order->id,['deserved_amount' => $deserved_amount ,'amount_paid' =>$order->amount_paid ]);
                        $amountPaid -= $order->total;
                    }
                    elseif($amountPaid > 0 )
                    {
                        $deserved_amount = $order->total;
                        $order->update([
                            'status' => 2,
                            'payment_status' => $data['payment_type'],
                            'paid_at' => $data['paid_at'],
                            'amount_paid' => $amountPaid ,
                            'remaining_amount' => $order->total - $amountPaid,
                        ]);
                        $order->refresh();
                        $ids[] = $order->id;
                        $generalPayment->ordersTansfer()->attach($order->id,['deserved_amount' => $deserved_amount ,'amount_paid' =>$order->amount_paid ]);
                        $amountPaid -= $order->amount_paid;
                    }
                    else{
                        break;
                    }
                    //paid but remaining money
                }
                elseif($order->status == 2)
                {
                    if($amountPaid >= $order->remaining_amount){
                        $remain =  $order->remaining_amount;
                        $paid = $order->amount_paid + $order->remaining_amount;
                        $order->update([
                            'status' => 1,
                            'payment_status' => $data['payment_type'],
                            'paid_at' => $data['paid_at'],
                            'amount_paid' => $paid,
                            'remaining_amount' => $order->total - $paid,
                        ]);
                        $order->refresh();
                        $ids[] = $order->id;
                        $generalPayment->ordersTansfer()->attach($order->id,['deserved_amount' => $remain ,'amount_paid' =>$remain ]);
                        $amountPaid -= $remain;
                    }elseif($amountPaid > 0 ){
                        $p_amount_paid = $amountPaid; $deserved_amount = $order->remaining_amount;
                        $paidRemain = $order->amount_paid + $amountPaid;
                        $order->update([
                            'status' => ($order->total - $paidRemain) == 0 ? 1 :2,
                            'payment_status' => $data['payment_type'],
                            'paid_at' => $data['paid_at'],
                            'amount_paid' => $paidRemain,
                            'remaining_amount' =>$order->total - $paidRemain ,
                        ]);
                        $order->refresh();
                        $ids[] = $order->id;
                        $generalPayment->ordersTansfer()->attach($order->id,['deserved_amount' => $deserved_amount ,'amount_paid' =>$p_amount_paid ]);
                        $amountPaid -= $p_amount_paid;
                    }
                    else{
                        break;
                    }
                }
                else{
                    break;
                }
            }
             $updateRemain = Order::whereKey($ids)->get();
            if($updateRemain->count() > 0){
                $remove = (float) $remove_amount->value;
               foreach ($updateRemain as $upremain){
                   if($upremain->remaining_amount <=$remove){
                       $remove-=$upremain->remaining_amoun;
                       $upremain->update([
                           'status' => 1,
                           'remaining_amount' => 0,
                           "total_discount" => $upremain->remaining_amount
                       ]);
                   }
               }
            }
            DB::commit();
            return redirect()->route('general.payment')->with('success','Success Payment Transfer');
        }catch (\Exception $ex){
            DB::rollBack();
            return  redirect()->back()->withErrors($ex->getMessage());
        }
    }

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        $payment = PaymentTransfer::with('ordersTansfer')->findOrFail($id);
        return view('Admin.pages.report.generalPayment.show',compact('payment'));
    }

    /**
     * Display the payment transfer pdf.
     */

    final public function paymentPdf($id){
        $payment = PaymentTransfer::with('ordersTansfer')->findOrFail($id);
        $pdf = PDF::loadView('Admin.pages.PDF.payment_invoice', ['payment' => $payment]);
        return $pdf->download('paymentTransfer_'.$id.'.pdf');
    }

    /**
     * Display the payment transfer print pdf.
     */

    final public function paymentPrint($id){
        $payment = PaymentTransfer::with('ordersTansfer')->findOrFail($id);
        $pdf = PDF::loadView('Admin.pages.PDF.payment_invoice', ['payment' => $payment]);
        return $pdf->stream('paymentTransfer_'.$id.'.pdf');
    }



    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        //
    }

    //customer should pay
    public function customerTotalDue($id){
        $customer = Customer::findOrFail($id);
        $orderAmount = Order::whereCustomerId($id)->where('status',0)->sum('total');
        $orderRemain = Order::whereCustomerId($id)->where('status','!=',0)->sum('remaining_amount');

        $un_pied = $orderAmount+$orderRemain;
        if ($un_pied > 0){
            $remaining_due = $un_pied;
        }else{
            $remaining_due = -$customer->balance;
        }
        return number_format($remaining_due, 2, '.', '');
    }

//    public function logOrder($id){
//        $payments = PaymentTransfer::
//    }
}
