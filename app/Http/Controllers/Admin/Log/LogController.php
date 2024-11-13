<?php

namespace App\Http\Controllers\Admin\Log;

use App\Http\Controllers\Controller;
use App\Models\Log;
use App\Models\Order;
use App\Models\OrderPaymentTransfer;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class LogController extends Controller
{
    public function logs(Request $request){
        $paginate = $request->number??10;
        $logs = Log::whereHas('order')->with('order')->latest('id')->paginate($paginate);
        return view('Admin.pages.logs.orders',compact('logs','paginate'));
    }

    final public function paymentLogs($id){
     $order = Order::findOrFail($id);
      $transfers = OrderPaymentTransfer::where('order_id',$id)->get();
      return view('Admin.pages.logs.transfers',compact('transfers','order'));
    }

}
