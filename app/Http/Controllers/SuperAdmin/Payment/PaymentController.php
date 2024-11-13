<?php

namespace App\Http\Controllers\SuperAdmin\Payment;

use App\Enums\packagePaymentEnum;
use App\Http\Controllers\Controller;
use App\Http\Requests\Api\Payments\PaymentRequest;
use App\Mail\TenantRegisterMail;
use App\Models\Payment;
use App\Models\SuperAdmin\Package;
use App\Models\SuperAdmin\PaymentMethod;
use App\Models\SuperAdmin\User;
use App\Models\Tenant;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Mail;
use Stripe\StripeClient;
use Spatie\Permission\Models\Permission;
use Spatie\Permission\Models\Role;

class PaymentController extends Controller
{

    function __construct()
    {
        $this->middleware(['can:payments-list'], ['only' => ['index']]);
//        $this->middleware(['can:paymentMethods-create'], ['only' => ['create', 'store']]);
        $this->middleware(['can:payments-edit'], ['only' => ['edit', 'update']]);
        $this->middleware(['can:payments-delete'], ['only' => ['destroy' , 'showDeleted', 'forceDelete' , 'restore']]);
    }

    public function index()
    {
        $payments = Payment::paginate(10);
        return view('dashboard.payments.index', compact('payments'));
    }


    public function edit($id)
    {
        $packages = Package::all();
        $payment = Payment::findOrFail($id);
        return view('dashboard.payments.edit', compact('payment', 'packages'));
    }

    public function update(Request $request, $id)
    {
        $validated = $request->validate([
            'package_id' => 'required|exists:packages,id',
            'user_id' => 'required|exists:users,id',
            'amount' => 'required|numeric|min:0.01',
            'currency' => 'required|string|size:3',
            'status' => 'required|string|in:pending,completed,failed,cancelled',
        ]);

        $payment = Payment::findOrFail($id);

        $payment->update($validated);

        $user_tanent = User::find($validated['user_id']);
        
        if ($request->status == 'completed') {
            try{
                $tenant = Tenant::create([
                    'id' => $payment->domain_name,
                    'user_id' => $request->user_id,
                ]);

                $tenant->domains()->create([
                    'domain' => $payment->domain_name,
                ]);

                $tenant->run(function () use($user_tanent) {
                    $user = \App\Models\User::create([
                        "name" => $user_tanent['name'],
                        "email" => $user_tanent['email'],
                        "email_verified_at" => $user_tanent['email_verified_at'],
                        "password" => $user_tanent['password'],
                        "mobile" => $user_tanent['mobile'],
                        "role_name" => "admin",
                    ]);
                   $permissions = [
                       'home',
                       "product",
                       "create_product",
                       "edit_product",
                       "delete_product",
                       'category',
                       'create_category',
                       "edit_category",
                       "delete_category",
                       "banner",
                       "create_banner",
                       "edit_banner",
                       "delete_banner",
                       "coupon",
                       "create_coupon",
                       "edit_coupon",
                       "delete_coupon",
                       "cashier",
                       "orders",
                       "invoices",
                       "delivery",
                       "employee",
                       "create_employee",
                       "edit_employee",
                       "delete_employee",
                       "role",
                       "create_role",
                       "edit_role",
                       "delete_role",
                       "setting",
                   ];
                   foreach ($permissions as $permission) {
                       Permission::create(['name' => $permission]);
                   }
                    $role = Role::create(['name' => 'admin']);
                    $permissions = Permission::pluck('id','id')->all();
                    $role->syncPermissions($permissions); // multiple permissions
                    $user->assignRole([$role->id]);
                });

            }catch (\Exception $e){
                return redirect()->back()->with('error', 'Error processing payment');
            }

            try {
                $name = $user_tanent->name;
                $email = $user_tanent->email;
                $password = $user_tanent->password;
                $messageSuperAdmin = 'Create New customer';
                $messageAdmin = 'this is email and password dashboard';
                $phone = $user_tanent->phone;

                Mail::to(env('MAIL_USERNAME'))
                    ->send(mailable: new TenantRegisterMail($name, $email, $password, $messageSuperAdmin, $phone));

                Mail::to($user_tanent->email)
                    ->send(new TenantRegisterMail($name, $email, $password, $messageAdmin, $phone));
            } catch (\Exception $e) {
                return redirect()->back()->with('error', 'Email could not be sent. Please try again.');
            }
        }
        return redirect()->route('payments.index')->with('success', 'Payment updated successfully.');
    }

    public function destroy(Request $request, $id)
    {
        $payment = Payment::findOrFail($id);
        $payment->delete();
        return redirect()->route('payments.index');
    }

    public function showDeleted()
    {
        $payments = Payment::onlyTrashed()->paginate(10);
        return view('dashboard.payments.deleted', compact('payments'));
    }

    public function forceDelete($id)
    {
        Payment::withTrashed()->where('id', $id)->forceDelete();
        return redirect()->route('payments.deleted')->with('success', 'Payment Method Permanently Deleted Successfully');
    }
    public function restore($id)
    {
        Payment::withTrashed()->where('id', $id)->restore();
        return redirect()->route('payments.index')->with('success', 'Payment Restored Successfully');
    }
}
