<?php

namespace App\Http\Controllers\SuperAdmin\PaymentMethods;

use App\Http\Requests\SuperAdmin\PaymentMethods\PaymentMethodRequest;
use App\Models\SuperAdmin\PaymentMethod;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Http\Traits\Utils\UploadFileTrait;
use Illuminate\Support\Facades\Auth;

class PaymentMethodController extends Controller
{
    use UploadFileTrait;

    protected $filePath = 'images/paymentMethods';

    function __construct()
    {
         $this->middleware(['can:paymentMethods-list'], ['only' => ['index']]);
         $this->middleware(['can:paymentMethods-create'], ['only' => ['create', 'store']]);
         $this->middleware(['can:paymentMethods-edit'], ['only' => ['edit', 'update']]);
         $this->middleware(['can:paymentMethods-delete'], ['only' => ['destroy' , 'trashedPaymethod', 'forceDelete' , 'restore']]);
    }

    public function index(Request $request)
    {
        $paymentMethods = PaymentMethod::latest()->paginate(5);
        return view('dashboard.paymentMethods.index',compact('paymentMethods'));
    }

    public function create()
    {
        return view('dashboard.paymentMethods.create');
    }

    public function store(PaymentMethodRequest $request)
    {
        $input = $request->validated();

        if (isset($input['image'])) {
            $input['image'] = $this->uploadFile($input['image'], $this->filePath);
        }

        PaymentMethod::create($input);

        return redirect()->route('payment-methods.index')->with('success','Payment Method created successfully');
    }


    public function edit($id)
    {
        $paymentMethods = PaymentMethod::find($id);
        return view('dashboard.paymentMethods.edit',compact('paymentMethods'));
    }

    public function update(PaymentMethodRequest $request, $id)
    {
        $input = $request->validated();

        $paymentMethod = PaymentMethod::find($id);

        if (isset($input['image'])) {
            $input['image'] = $this->updateFile($input['image'], $paymentMethod->image, $this->filePath);
        }

        $paymentMethod->update($input);

        return redirect()->route('payment-methods.index')->with('success','Payment Method updated successfully');
    }

    public function destroy($id)
    {
        PaymentMethod::find($id)->delete();
        return redirect()->route('payment-methods.index') ->with('success','Payment Method deleted successfully');
    }

    public function trashedPaymethod()
    {
        $paymentMethods = PaymentMethod::onlyTrashed()->get();
        return view('dashboard.paymentMethods.deleted', compact('paymentMethods'));
    }
    public function forceDelete($id)
    {
        PaymentMethod::withTrashed()->where('id', $id)->forceDelete();
        return redirect()->route('payments.trashedPaymethod')->with('success', 'Payment Method Permanently Deleted Successfully');
    }
    public function restore($id)
    {
        PaymentMethod::withTrashed()->where('id', $id)->restore();
        return redirect()->route('payments.trashedPaymethod')->with('success', 'Payment Method Restored Successfully');
    }
}
