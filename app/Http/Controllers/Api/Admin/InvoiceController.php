<?php

namespace App\Http\Controllers\Api\Admin;

use App\Enums\OrderStatusEnum;
use App\Http\Controllers\Controller;
use App\Http\Requests\Admin\CustomStatementRequest;
use App\Models\Customer;
use App\Models\Order;
use App\Models\User;
use App\services\cashier\CashierService;
use Barryvdh\DomPDF\Facade\Pdf;
use Illuminate\Http\Request;

class InvoiceController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $online_customer = User::whereNull('role_name')->get();
        $cashier_customer = Customer::whereHas('addresses')->get();
        return view('Admin.pages.invoice.index',[
            'online_customer' => $online_customer,
            'cashier_customer'  => $cashier_customer,
        ]);
    }

    final public function pdf($id , CashierService $service){
        $invoice = Order::with(['orderDetails' => function($query) {
                                         $query->withTrashed();
                                         }, 'cashier', 'address'])
                     ->withTrashed()
                     ->where('id', $id)
                     ->firstOrFail();
        $service->log($id,'Export Invoice as Pdf');
        /*$pdf = PDF::loadView('Admin.pages.PDF.invoice', ['invoice' => $invoice]);
         return $pdf->download('invoice_' .$invoice->id .'.pdf');*/
        $html = view('Admin.pages.PDF.invoice', ['invoice' => $invoice])->render();
        $mpdf = new \Mpdf\Mpdf();
        $mpdf->WriteHTML($html);
        return $mpdf->Output('invoice_' . $invoice->id . '.pdf', 'D');
    }

    final public function print($id,CashierService $service){
        $invoice = Order::where('id', $id)->with('orderDetails', 'cashier', 'address')->firstorFail();
        $service->log($id,'Print Invoice');
//        $pdf = PDF::loadView('Admin.pages.PDF.invoice', ['invoice' => $invoice]);
//        return $pdf->stream('invoice_' . $invoice->id . '.pdf');
        $html = view('Admin.pages.PDF.invoice', ['invoice' => $invoice])->render();
        $mpdf = new \Mpdf\Mpdf();
        return($html);
//        $mpdf->WriteHTML($html);
//        return $mpdf->Output('invoice_' . $invoice->id . '.pdf', 'I');
    }

    final public function invoices($id,$status=null,$date=null){

        $query = Order::where('customer_id',$id)->with('orderDetails','cashier','address')
                ->when(isset($status) && $status!=null && $status!=3,function ($q) use ($status){
                    if($status == OrderStatusEnum::Paid->value)
                        $q->where('status',$status);
                    else{
                        $q->where('status','!=',1);
                    }
                })
                ->latest('id');
        if($date){
            $startOfWeek =\Carbon\Carbon::now()->startOfWeek(\Carbon\Carbon::MONDAY);
            $endOfWeek = \Carbon\Carbon::now()->endOfWeek(\Carbon\Carbon::SUNDAY);
            $query->whereDate('created_at', '>=', $startOfWeek)
                ->whereDate('created_at', '<=', $endOfWeek);
        }
        $invoice = $query->get();
      /*  $pdf = PDF::loadView('Admin.pages.PDF.all_invoice', ['invoice' => $invoice,'date' => $date]);
        return $pdf->download('invoice_'.$id.'.pdf');*/
        $html = view('Admin.pages.PDF.all_invoice', ['invoice' => $invoice,'date' => $date])->render();
        $mpdf = new \Mpdf\Mpdf();
        $mpdf->WriteHTML($html);
        return $mpdf->Output('invoice_'.$id.'.pdf', 'D');
    }

    //filter statement pdf
    final public function statementPdfFilter($id,Request $request){
        $data['start_date'] = $request->query('start_date');
        $data['end_date'] = $request->query('end_date');
        $data['status'] = $request->query('status');
        $invoice = $this->fiterSatament($data,$id);
//        $pdf = PDF::loadView('Admin.pages.PDF.all_invoice', ['invoice' => $invoice]);
//        return $pdf->download('invoice_'.$id.'.pdf');
        $html = view('Admin.pages.PDF.all_invoice', ['invoice' => $invoice])->render();
        $mpdf = new \Mpdf\Mpdf();
        $mpdf->WriteHTML($html);
        return $mpdf->Output('invoice_'.$id.'.pdf', 'D');

    }

    final public function statementPrintFilter($id,$start_date,$end_date,$status=null){
        $data['start_date'] = $start_date;
        $data['end_date'] = $end_date;
        $data['status'] = $status;
        $invoice = $this->fiterSatament($data,$id);
        $filterdate= ['start_date' =>$start_date,'end_date'=>$end_date ];
//        $pdf = PDF::loadView('Admin.pages.PDF.all_invoice', ['invoice' => $invoice,'filterdate' => $filterdate]);
//        return $pdf->stream('invoice_'.$id.'.pdf');
        $html = view('Admin.pages.PDF.all_invoice', ['invoice' => $invoice,'filterdate' => $filterdate])->render();
        $mpdf = new \Mpdf\Mpdf();
        return($html);
        /*$mpdf->WriteHTML($html);
        return $mpdf->Output('invoice_'.$id.'.pdf', 'I');*/
    }

    final public function invoicesPrintWeak($id,$status = null){
        $date = 6;
        $startOfWeek =\Carbon\Carbon::now()->startOfWeek(\Carbon\Carbon::MONDAY);
        $endOfWeek = \Carbon\Carbon::now()->endOfWeek(\Carbon\Carbon::SUNDAY);
        $invoice = Order::where('customer_id',$id)->with('orderDetails','cashier','address')
            ->whereDate('created_at', '>=', $startOfWeek)
            ->whereDate('created_at', '<=', $endOfWeek)
            ->when(isset($status) && $status!=null,function ($q) use ($status){
                if($status == OrderStatusEnum::Paid->value)
                    $q->where('status',$status);
                else{
                    $q->where('status','!=',1);
                }
            })
            ->latest('id')->get();;
//        $pdf = PDF::loadView('Admin.pages.PDF.all_invoice', ['invoice' => $invoice,'date' => $date ,"status" => $status]);
//        return $pdf->stream('invoice_'.$id.'.pdf');
        $html = view('Admin.pages.PDF.all_invoice', ['invoice' => $invoice,'date' => $date ,"status" => $status])->render();
        $mpdf = new \Mpdf\Mpdf();
        return$html;
//        $mpdf->WriteHTML($html);
//        return $mpdf->Output('invoice_'.$id.'.pdf', 'I');
    }


    /**
     * Display the specified resource.
     */
    public function show(CustomStatementRequest $request,string $id,$type)
    {
/*        if($type == 'customer'){*/
            $user = Customer::findOrFail($id);
            $start_date =$request->start_date?? null;
            $end_date =$request->end_date?? null;
            $status = $request->status??null;

            if(isset($request->date)){
                $start_date =\Carbon\Carbon::now()->startOfWeek(\Carbon\Carbon::MONDAY);
                $end_date = \Carbon\Carbon::now()->endOfWeek(\Carbon\Carbon::SUNDAY);

            }
            $paginate = $request->number??10;
            $count = [
                'total' => Order::where('customer_id',$id)->when(isset($start_date) && $start_date !=null,function ($q) use($start_date,$end_date){
                            $q->whereDate('created_at', '>=', $start_date)
                                ->whereDate('created_at', '<=', $end_date);

                })->count(),

                'total_purches' => Order::where('customer_id',$id)->when(isset($start_date) && $start_date !=null,function ($q) use($start_date,$end_date){
                                        $q->whereDate('created_at', '>=', $start_date)
                                            ->whereDate('created_at', '<=', $end_date);
                                     })->sum('total'),

                'paid' => Order::where('customer_id',$id)->when(isset($start_date) && $start_date !=null,function ($q) use($start_date,$end_date){
                                    $q->whereDate('created_at', '>=', $start_date)
                                        ->whereDate('created_at', '<=', $end_date);
                        })->where('status','!=',0)->sum('amount_paid'),

                "remaining" => Order::where('customer_id',$id)->when(isset($start_date) && $start_date !=null,function ($q) use($start_date,$end_date){
                            $q->whereDate('created_at', '>=', $start_date)
                                ->whereDate('created_at', '<=', $end_date);
                        })->where('status',0)->sum('total') +  Order::where('customer_id',$id)->when(isset($start_date) && $start_date !=null,function ($q) use($start_date,$end_date){
                                                                $q->whereDate('created_at', '>=', $start_date)
                                                                    ->whereDate('created_at', '<=', $end_date);
                                                            })->where('status','!=',0)->sum('remaining_amount'),

            ];

            $orders = Order::where('customer_id',$id)->when(isset($start_date) && $start_date !=null,function ($q) use($start_date,$end_date){
                                $q->whereDate('created_at', '>=', $start_date)
                                    ->whereDate('created_at', '<=', $end_date);
                 })
                ->when(isset($status) && $status !=null,function ($query) use ($status){
                    if($status == OrderStatusEnum::Paid->value)
                        $query->where('status',$status);
                    else{
                        $query->where('status','!=',1);
                    }
                })
                ->with('orderDetails','cashier','address')->latest('id')->paginate($paginate);

     /*   }else{
            $user = User::whereMobile($phone)->first();
            $name = $user->name;
            $mobile = $user->mobile;
            $abn = "Personal Client";
            $orders = Order::whereMobile($phone)->with('orderDetails','cashier','address')->paginate(10);
        }*/
        /*if($orders->isEmpty()){
            return redirect()->back()->withErrors('No Orders Yet To Show Report');
        }*/

        $date = []; $last_orders = [];
        if(isset($startOfWeek) && $startOfWeek !=null){
            $currentDate = $startOfWeek->copy()->subDay();
            for ($i=8 ; $i >0 ; $i--) {
                $startDate = $currentDate->addDays(1)->startOfDay();
                $endDate = $startDate->copy()->endOfDay();
                $date[] = $startDate->format('d M');
                $last_orders[] = Order::where('customer_id',$id)->whereBetween('created_at',[$startDate,$endDate])->count();
            }
            $last_orders = array_reverse($last_orders);
            $date = array_reverse($date);
        }else{
            $year = date('Y');
            $month = date('m');
            for($i = 0; $i < 12; $i++){
                $date[] = date('M Y', strtotime("$year-$month-01"));
                /*     if($type == 'customer'){*/
                $last_orders [] = Order::where('customer_id',$id)
                    ->whereYear('created_at', $year)
                    ->whereMonth('created_at', $month)
                    ->count();
                /*   }else{
                       $last_orders [] = Order::where('mobile',$phone)
                           ->whereYear('created_at', $year)
                           ->whereMonth('created_at', $month)
                           ->count();
                   }*/
                $month--;
                if ($month == 0) {
                    $month = 12;
                    $year--;
                }
            }
        }

        return view('Admin.pages.invoice.show',[
            'count' => $count,
            'orders' => $orders,
            'last_orders' => array_reverse($last_orders),
            'date' => array_reverse($date),
            'user' => $user,
            'paginate' => $paginate,
            'status' => $status,
            "start_date" => $start_date,
            "end_date" => $end_date,
        ]);
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


    private function fiterSatament($data,$id){
        $invoice = Order::where('customer_id',$id)->when(isset($data['status']) && $data['status']!=null,function ($q) use ($data){
                $q->where('status',$data['status']);
        })->whereDate('created_at', '>=', $data['start_date'])
            ->whereDate('created_at', '<=', $data['end_date'])->get();
        return $invoice;

    }
}
