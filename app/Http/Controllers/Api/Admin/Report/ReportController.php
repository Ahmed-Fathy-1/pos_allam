<?php

namespace App\Http\Controllers\Api\Admin\Report;

use App\Enums\OrderStatusEnum;
use App\Http\Controllers\Controller;
use App\Http\Requests\Admin\ReportRequest;
use App\Models\Customer;
use App\Models\Order;
use App\Models\Report;
use App\Models\User;
use App\services\report\ReportServices;
use Barryvdh\DomPDF\Facade\Pdf;
use Carbon\Carbon;
use Illuminate\Http\Request;

class ReportController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $reports = Report::latest('id')->get();
        $users = Customer::whereHas('addresses')->get();
        return view('Admin.pages.report.index',compact('reports','users'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     */

    public function store(ReportRequest $request,ReportServices $services)
    {
             $validated = $request->validated();
            if (isset($data['customer_id'])){
                $customer = Customer::findOrFail($data['customer_id']);
                $orders = Order::where('customer_id',$validated['customer_id'])->with('orderDetails','cashier','address')
                    ->whereDate('created_at', '>=', $validated['start_date'])
                    ->whereDate('created_at', '<=', $validated['end_date'])
                    ->get();
                $data['vendor_mobile'] = $customer->mobile;
            }else{
                $orders = Order::with('orderDetails','cashier','address')
                    ->whereDate('created_at', '>=', $validated['start_date'])
                    ->whereDate('created_at', '<=', $validated['end_date'])
                    ->get();
            }
            if($orders->count() > 0){
                $report = Report::create($validated + ['user_id' => auth()->user()->id]);
              //  $services->invoice($orders,$validated,$report->id);
            }else{
                return  redirect()->back()->withErrors('No Data Between That Date To Make Reported');
            }

            return redirect()->back()->with('success','new report Created successfully');
    }

    final public function pdfStatement($id,$status = null){
        $report = Report::findOrFail($id);
        if (isset($report->customer_id) && $report->customer_id != null){
            $invoice = Order::whereCustomerId($report->customer_id)
                        ->with('orderDetails','cashier','address')
                        ->when(isset($status) && $status !=null,function ($query) use ($status){
                            if($status == OrderStatusEnum::Paid->value)
                                $query->where('status',$status);
                            else{
                                $query->where('status','!=',1);
                            }
                        })
                        ->whereDate('created_at', '>=', $report->start_date)
                        ->whereDate('created_at', '<=', $report->end_date)
                        ->latest('id')
                        ->get();
        }else{
            $invoice = Order::with('orderDetails','cashier','address')
                        ->when(isset($status) && $status !=null,function ($query) use ($status){
                            if($status == OrderStatusEnum::Paid->value)
                                $query->where('status',$status);
                            else{
                                $query->where('status','!=',1);
                            }
                        })
                        ->whereDate('created_at', '>=', $report->start_date)
                        ->whereDate('created_at', '<=', $report->end_date)
                        ->latest('id')
                        ->get();
        }

    /*    $pdf = PDF::loadView('Admin.pages.PDF.report', ['invoice' => $invoice , 'report' => $report ,"status" => $status]);
        return $pdf->download('invoice_'.$report->id.'.pdf');*/
        $html = view('Admin.pages.PDF.report', ['invoice' => $invoice , 'report' => $report ,"status" => $status])->render();
        $mpdf = new \Mpdf\Mpdf();
        $mpdf->WriteHTML($html);
        return $mpdf->Output('invoice_' . $report->id . '.pdf', 'D');
    }

    /**
     * Display the specified resource.
     */
    public function show(Request $request,string $id)
    {
        $status =$request->status??null;
        $report = Report::findOrFail($id);
        $customerId = $report->customer_id;
        $count = [
            'total' => Order::with('orderDetails')->when(isset($customerId) && $customerId !=null,function ($q) use ($customerId){
                            $q->whereCustomerId($customerId);
                    })->whereDate('created_at', '>=', $report->start_date)
                        ->whereDate('created_at', '<=', $report->end_date)
                        ->count(),

            'total_purches' =>Order::with('orderDetails')->when(isset($customerId) && $customerId !=null,function ($q) use ($customerId){
                            $q->whereCustomerId($customerId);
                        })->whereDate('created_at', '>=', $report->start_date)
                            ->whereDate('created_at', '<=', $report->end_date)->sum('total'),

            'paid' => Order::with('orderDetails')->when(isset($customerId) && $customerId !=null,function ($q) use ($customerId){
                    $q->whereCustomerId($customerId);
                })->whereDate('created_at', '>=', $report->start_date)
                    ->whereDate('created_at', '<=', $report->end_date)->sum('amount_paid'),
        ];

        $orders = Order::with('orderDetails')->when(isset($customerId) && $customerId !=null,function ($q) use ($customerId){
                          $q->whereCustomerId($customerId);
                 })
                ->when(isset($status) && $status !=null,function ($query) use ($status){
                    if($status == OrderStatusEnum::Paid->value)
                        $query->where('status',$status);
                    else{
                        $query->where('status','!=',1);
                    }
                })
                ->whereDate('created_at', '>=', $report->start_date)
                ->whereDate('created_at', '<=', $report->end_date)
                ->get();

        //pie chart for paid or unpaid
          $orderPaid = $orders->where('status',1)->where('remaining_amount',0)->count();
          $orderUnPaid = $orders->where('status',0)->count();
          $orderRemain = $orders->where('status',2)->count();

        $startdateinput = Carbon::parse($report->start_date)->addDay();
        $currentDate = Carbon::parse($report->end_date)->addDay();
        $differenceInDays = $startdateinput->diffInDays($currentDate);
         $i = $differenceInDays; $dates = []; $paid = []; $unPaid = []; $remain = []; $lineOrder = [];
/*        if ($differenceInDays <= 30) {*/
            for ($i; $i >=0 ; $i--){
                $startDate = $currentDate->subDays()->startOfDay();
                $endDate = $startDate->copy()->endOfDay();
                $date = $startDate->format('d M');

                ################# line Chart For orders  ###########
                $lineOrder[] = Order::when(isset($customerId) && $customerId !=null,function ($q) use ($customerId){
                    $q->whereCustomerId($customerId);
                })
                    ->where('status',1)
                    ->whereDate('created_at', '>=', $startDate)
                    ->whereDate('created_at', '<=', $endDate)
                    ->count();

                ################ column chart for orders fees ########
                $paid[] = Order::when(isset($customerId) && $customerId !=null,function ($q) use ($customerId){
                    $q->whereCustomerId($customerId);
                })->where('status','!=',0)
                    ->whereDate('created_at', '>=', $startDate)
                    ->whereDate('created_at', '<=', $endDate)->sum('amount_paid');

                $remain[] =  Order::when(isset($customerId) && $customerId !=null,function ($q) use ($customerId){
                    $q->whereCustomerId($customerId);
                })->where('status',2)
                    ->whereDate('created_at', '>=', $startDate)
                    ->whereDate('created_at', '<=', $endDate)->sum('remaining_amount');

                $unPaid[] = Order::when(isset($customerId) && $customerId !=null,function ($q) use ($customerId){
                    $q->whereCustomerId($customerId);
                })->where('status',0)
                    ->whereDate('created_at', '>=', $startDate)
                    ->whereDate('created_at', '<=', $endDate)->sum('total');
                $dates [] = $date;
            }
            $paid = array_reverse($paid);
            $remain = array_reverse($remain);
            $unPaid = array_reverse($unPaid);
            $lineOrder = array_reverse($lineOrder);
            $dates = array_reverse($dates);
/*        }else {
            // Calculate start and end year and month
            $start_year = Carbon::parse($report->start_date)->year;
            $start_month = Carbon::parse($report->start_date)->month;

            $end_year = Carbon::parse($report->end_date)->year;
            $end_month = Carbon::parse($report->end_date)->month;

            $current_year = $start_year;
            $current_month = $start_month;

            while ($current_year < $end_year || ($current_year == $end_year && $current_month <= $end_month)) {
                $dates[] = date('M Y', strtotime("$current_year-$current_month-01"));

                // line Chart For orders
                $lineOrder[] = Order::when(isset($customerId) && $customerId != null, function ($q) use ($customerId) {
                    $q->whereCustomerId($customerId);
                })
                    ->where('status', 1)
                    ->whereYear('created_at', $current_year)
                    ->whereMonth('created_at', $current_month)
                    ->count();

                // column chart for orders fees
                $paid[] = Order::when(isset($customerId) && $customerId != null, function ($q) use ($customerId) {
                    $q->whereCustomerId($customerId);
                })
                    ->where('status', 1)
                    ->whereYear('created_at', $current_year)
                    ->whereMonth('created_at', $current_month)
                    ->sum('amount_paid');

                $remain[] = Order::when(isset($customerId) && $customerId != null, function ($q) use ($customerId) {
                    $q->whereCustomerId($customerId);
                })
                    ->where('status', 1)
                    ->whereYear('created_at', $current_year)
                    ->whereMonth('created_at', $current_month)
                    ->sum('remaining_amount');

                $unPaid[] = Order::when(isset($customerId) && $customerId != null, function ($q) use ($customerId) {
                    $q->whereCustomerId($customerId);
                })
                    ->where('status', 0)
                    ->whereYear('created_at', $current_year)
                    ->whereMonth('created_at', $current_month)
                    ->sum('total');

                $current_month++;
                if ($current_month > 12) {
                    $current_month = 1;
                    $current_year++;
                }
            }
        }*/
        return view('Admin.pages.report.show',
            compact('report','count','orders','orderPaid','orderUnPaid','orderRemain','paid','remain','unPaid','dates','lineOrder','status'));
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(string $id)
    {
        //
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

    public function destroy(Request $request)
    {
        $report = Report::findOrFail($request->id);
        $report->delete();
        return redirect()->back()->with('success','Report Deleted Successfully');
    }
}
