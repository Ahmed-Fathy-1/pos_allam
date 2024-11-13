@extends('Admin.layouts.master')
@section('main_head')
    <div class="page-title font-medium " xmlns="http://www.w3.org/1999/html">
        <h4> Show Report</h4>
    </div>
@endsection
@section('title') Show Report @endsection
@section('css')
    <style>
        .content{
            padding: 10px !important;
        }
    </style>
@endsection
@section('content')
    <div class="content">
        <div class="row">
            <div class="col-lg-3 col-sm-6 col-12">
                <div class="dash-widget">
                    <div class="dash-widgetimg">
                        <span><img src="{{asset('assets/dashboard/img/icons/dash1.svg')}}" alt="img"></span>
                    </div>
                    <div class="dash-widgetcontent">
                        <h5 ><span class="counters" data-count="{{$count['total']}}">{{$count['total']}}</span></h5>
                        <h6>Total Orders </h6>
                    </div>
                </div>
            </div>
            <div class="col-lg-3 col-sm-6 col-12">
                <div class="dash-widget dash1">
                    <div class="dash-widgetimg">
                        <span><img src="{{asset('assets/dashboard/img/icons/dash2.svg')}}" alt="img"></span>
                    </div>
                    <div class="dash-widgetcontent">
                        <h5 >$<span class="counters" data-count="{{$count['total_purches']}}">${{$count['total_purches']}}</span></h5>
                        <h6>Total Purchase Due</h6>
                    </div>
                </div>
            </div>
            <div class="col-lg-3 col-sm-6 col-12">
                <div class="dash-widget dash3">
                    <div class="dash-widgetimg">
                        <span><img src="{{asset('assets/dashboard/img/icons/dash4.svg')}}" alt="img"></span>
                    </div>
                    <div class="dash-widgetcontent">
                        <h5 >$<span class="counters" data-count="{{$count['paid']}}">{{$count['paid']}}</span></h5>
                        <h6>Paid</h6>
                    </div>
                </div>
            </div>
            <div class="col-lg-3 col-sm-6 col-12">
                <div class="dash-widget dash2">
                    <div class="dash-widgetimg">
                        <span><img src="{{asset('assets/dashboard/img/icons/dash3.svg')}}" alt="img"></span>

                    </div>

                    <div class="dash-widgetcontent">
                        <h5 >$<span class="counters" data-count="{{$count['total_purches'] - $count['paid'] }}">{{$count['total_purches'] - $count['paid']}}</span></h5>
                        <h6>UnPaid</h6>
                    </div>
                </div>
            </div>
        </div>
        <div class="card mb-3">
            <div class="card-body">
              <h3 class="text-center">Report From ({{\Carbon\Carbon::parse($report->start_date)->format('d-m-Y')}} to {{\Carbon\Carbon::parse($report->end_date)->format('d-m-Y')}})</h3>
                <div class="row">
                    <div class="col-lg-6 col-sm-12 col-12">
                        <p><strong>Title : </strong> {{$report->title}}</p>
                    </div>
                    @if(isset($report->customer_id) && $report->customer_id !=null)

                        <div class="col-lg-6 col-sm-12 col-12">
                            <p><strong>Customer : </strong> {{$report->customer->name}}</p>
                            <p><strong>Phone : </strong> {{$report->customer->mobile}}</p>
                        </div>
                    @endif
                    <div class="col-lg-12 col-sm-12 col-12">
                        <p><strong>Description : </strong> {{$report->description}}</p>
                    </div>

                </div>
            </div>
        </div>

        <div class="card mb-0">
            <div class="card mb-0">
                <div class="card-body">
                    <div class="table-top d-block">
                        <div class="d-flex flex-wrap justify-content-between">
                            <h4 class="text-nowrap  col-12 col-md-3">Orders Details </h4>
                            <div class="d-flex  justify-content-between gap-2">
                                <form id="statementForm" method="GET" action="{{route('report-show',$report->id)}}">
                                    <div class="form-group mb-0">
                                        <select name="status" class="select2 form-select select-product" id = "statement_submit" required>
                                            <option selected disabled>Filter Orders Status</option>
                                            <!-- Populate this dropdown with product options -->
                                            <option value="0" @if($status !=null && $status ==0) selected @endif>UnPaid</option>
                                            <option value="1" @if($status == 1) selected @endif>Paid</option>
                                        </select>
                                    </div>
                                </form>
                                <a href="{{route('report-show',$report->id)}}" class="btn  btn-success text-white " >Reset</a>
                            </div>

                            <a href="{{route('report.pdf',["id" =>$report->id,"status" => $status])}}"
                               class="btn  btn-danger text-capitalize text-white hover:none mb-0"
                               download>
                                Report PDF
                            </a>
                        </div>
                    </div>
                    <div class="table-responsive">
                        <table class="table  datanew">
                            <thead>
                            <tr>
                                <th>#</th>
                                <th>Date</th>
                                <th>Status</th>
                                <th>Delivery </th>
                                <th>Qty</th>
                                <th>Total</th>
                                <th>paid</th>
                                <th>remaining</th>
                                <th class="text-center">Details</th>
                            </tr>
                            </thead>
                            <tbody>
                            @foreach($orders as $order)
                                <tr>
                                    <td data-bs-toggle="modal" data-bs-target="#details-order{{$order->id}}">
                                        {{$loop->iteration}}
                                    </td>
                                    <td  data-bs-toggle="modal" data-bs-target="#details-order{{$order->id}}">
                                        {{$order->created_at->format('Y-m-d')}}</td>
                                    <td data-bs-toggle="modal" data-bs-target="#details-order{{$order->id}}">
                                        @if($order->status == 0)
                                            <a class="btn btn-sm btn-danger text-white">UnPaid</a>
                                        @elseif($order->status == 1)
                                            <a class="btn btn-sm btn-success text-white">Paid</a>
                                        @else
                                            <a class="btn btn-sm btn-info text-white"  style="background-color: #0d6efd !important;">
                                                P.Paid
                                            </a>
                                        @endif
                                    </td>
                                    <td data-bs-toggle="modal" data-bs-target="#details-order{{$order->id}}">
                                        {{\App\Enums\deliveryStatusEnum::from($order->delivery_status)->name}}
                                    </td>
                                    <td data-bs-toggle="modal" data-bs-target="#details-order{{$order->id}}">
                                        {{$order->orderDetails->count()}}
                                    </td>
                                    <td data-bs-toggle="modal" data-bs-target="#details-order{{$order->id}}">
                                        ${{$order->total}}
                                    </td>
                                    <td data-bs-toggle="modal" data-bs-target="#details-order{{$order->id}}">
                                        ${{$order->amount_paid}}
                                    </td>
                                    <td data-bs-toggle="modal" data-bs-target="#details-order{{$order->id}}">
                                        ${{$order->remaining_amount}}
                                    </td>
                                    <td>
                                        <div class="d-flex justify-content-center gap-2">
                                            <div>
                                                <a data-bs-toggle="modal" data-bs-target="#details-order{{$order->id}}"
                                                   class="btn btn-sm btn-primary text-white hover:none">
                                                    Details</a>
                                            </div>
                                           {{-- <div>
                                                <a href="{{route('invoice.pdf',$order->id)}}"
                                                   class="btn btn-sm btn-danger text-uppercase text-white hover:none" download>
                                                    pdf
                                                </a>
                                            </div>--}}
                                        </div>
                                        <div class="modal fade" id="details-order{{$order->id}}" tabindex="-1"
                                             aria-labelledby= "details-order{{$order->id}}"
                                             data-bs-keyboard="false" aria-hidden="true">
                                            <!-- Scrollable modal -->
                                            <div class="modal-dialog modal-dialog-centered modal-xl">
                                                <div class="modal-content">
                                                    <div class="modal-header" style="background-color: #FF9F43;">
                                                        <h6 class="modal-title  text-white" id="staticBackdropLabel2">
                                                            Order Details
                                                        </h6>
                                                        <button type="button" class="btn-close" data-bs-dismiss="modal"
                                                                aria-label="Close"><span aria-hidden="true">×</span></button>
                                                    </div>
                                                    <div class="modal-body">
                                                        <div class="card-body mb-5">
                                                            <div class="row">
                                                                <div class="col-lg-6  col-12">
                                                                    <div class="form-group">
                                                                        <strong>Order From : </strong>
                                                                        @if($order->casier_id != null) Online
                                                                        @else
                                                                            Cashier
                                                                        @endif
                                                                    </div>
                                                                </div>
                                                                <div class="col-lg-6  col-12">
                                                                    <div class="form-group">
                                                                        <strong>Delivery : </strong>
                                                                        {{\App\Enums\deliveryStatusEnum::from($order->delivery_status)->name}}
                                                                    </div>
                                                                </div>
                                                                @php
                                                                    $data = $order->customer;
                                                                     if(!$data){
                                                                         $data = \App\Models\User::whereMobile($order->mobile)->first();
                                                                     }
                                                                @endphp
                                                                <div class="col-lg-6  col-12">
                                                                    <div class="form-group">
                                                                        <label>Customer:
                                                                            {{$data->name . " ( ". $data->mobile . " )"}}
                                                                        </label>
                                                                    </div>
                                                                </div>
                                                                <div class="col-lg-6  col-12">
                                                                    <div class="form-group">
                                                                        <label>To :

                                                                            @if($order->address_id != null)
                                                                                {{$order->address?->address}} , {{$order->address?->city}} , {{$order->address?->state}},{{$order->address?->post_code}}
                                                                            @else
                                                                                Guest
                                                                            @endif
                                                                        </label>

                                                                    </div>
                                                                </div>

                                                            </div>
                                                            <div class="row">
                                                                <div class="table-responsive">
                                                                    <table class="table">
                                                                        <thead>
                                                                        <tr >
                                                                            <th>Qty</th>
                                                                            <th>Description</th>
                                                                            <th> Price($)</th>
                                                                            <th>G.S.t ($)</th>
                                                                            <th>Subtotal ($)</th>
                                                                        </tr>
                                                                        </thead>
                                                                        <tbody>
                                                                        @foreach($order->orderDetails as $detail)
                                                                            <tr >
                                                                                <td>{{$detail->quantity}}</td>
                                                                                <td>
                                                                                    <div class="d-flex align-items-center gap-1">
                                                                                        {{$detail->product->name}}
                                                                                        <small>{{$detail->unit->name}}</small>
                                                                                    </div>
                                                                                </td>
                                                                                <td>${{$detail->price}}</td>
                                                                                <td>${{$detail->gst}} $</td>
                                                                                <td>${{$detail->sub_total}}</td>
                                                                            </tr>
                                                                        @endforeach

                                                                        </tbody>
                                                                    </table>
                                                                </div>
                                                            </div>
                                                            <div class="row ">
                                                                <div class="col-lg-12 float-md-right">
                                                                    <div class="total-order">
                                                                        <ul>
                                                                            <li class="total">
                                                                                <h4>Total Due</h4>
                                                                                <h5>${{$order->total}}</h5>
                                                                            </li>
                                                                        </ul>
                                                                    </div>
                                                                </div>
                                                            </div>
                                                        </div>
                                                    </div>
                                                    <div class="modal-footer d-flex justify-content-end">
                                                        <button class="btn btn-cancel"  type="button" data-bs-dismiss="modal" aria-label="Close">Cancel</button>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                    </td>
                                </tr>
                            @endforeach
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>
        </div>

        {{-- report chart --}}
        <div class="row mt-4">
            <div class="col-lg-7 col-sm-12 col-12 d-flex">
                <div class="card flex-fill">
                    <div class="card-header pb-0 d-flex justify-content-between align-items-center">
                        <h4 class="card-title mb-0">line chart Orders count </h4>
                        <div class="dropdown">
                            <a href="javascript:void(0);" data-bs-toggle="dropdown" aria-expanded="false" class="dropset">
                                <i class="fa fa-ellipsis-v"></i>
                            </a>
                        </div>
                    </div>
                    <div class="card-body">
                        <div id="order_count_line"></div>
                    </div>
                </div>
            </div>

            <div class="col-lg-5 col-sm-12 col-12 d-flex">
                <div class="card flex-fill">
                    <div class="card-header pb-0 d-flex justify-content-between align-items-center">
                        <h5 class="card-title mb-0">pie chart Orders : Paid - P.Paid- UnPaid </h5>
                    </div>
                    <div class="card-body">
                        <div id="order_status"></div>
                    </div>
                </div>
            </div>
        </div>
        <div class="row mt-4">
            <div class="col-lg-12 col-sm-12 col-12 d-flex">
                <div class="card flex-fill">
                    <div class="card-header pb-0 d-flex justify-content-between align-items-center">
                        <h5 class="card-title mb-0">Orders : Paid - UnPaid </h5>
                    </div>
                    <div class="card-body">
                        <div id="order_details"></div>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
@section('js')
    <script>
        let orderPaid = @json($orderPaid);
        let orderUnPaid = @json($orderUnPaid);
        let orderRemain = @json($orderRemain);
        let lineOrder = @json($lineOrder);
        let paid = @json($paid);
        let remain = @json($remain);
        let unPaid = @json($unPaid);
        let dates = @json($dates);
        $(document).ready(function (){
            $('#statement_submit').on('change',function (){
                $('#statementForm').submit();
            });
        });
    </script>
    <script src="{{asset('assets/dashboard/js/dashboard/report.js')}}"></script>
@endsection

