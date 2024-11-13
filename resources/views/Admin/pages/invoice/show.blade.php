@extends('Admin.layouts.master')
@section('css')
    <!-- Color Picker Css -->
    <link rel="stylesheet" href="{{asset('assets/dashboard/flatpickr/flatpickr.min.css')}}">
    <link rel="stylesheet" href="{{asset('assets/dashboard/@simonwep/pickr/themes/nano.min.css')}}">
    <style>
        .dataTables_length{
            display: none;
        }
        div.dataTables_wrapper div.dataTables_paginate{
            display: none;
        }
        div.dataTables_wrapper div.dataTables_info{
            display: none;
        }
        .pagination li a{
            background: #FF9F43;
            color: #fff
        }
    </style>
@endsection
@section('title') Customer - Invoice  @endsection
@section('content')
    <div class="content">
        @if ($errors->any())
            <div class="alert alert-danger">
                <ul>
                    @foreach ($errors->all() as $error)
                        <li>{{ $error }}</li>
                    @endforeach
                </ul>
            </div>
        @endif
        <div class="page-header">
            <div class="page-title">
                <h4>Invoice And Report : {{$user->name}}   .</h4>
                <h6>Here  your Can statically of all {{$user->name}} purchase.</h6>
            </div>
            {{-- filter statment--}}
            <form id="statementForm" method="GET" action="{{route('invoice-show',['id' => $user->id, 'type' => 'customer'])}}">
                <input type="hidden" name="start_date" value="{{$start_date}}">
                <input type="hidden" name="end_date" value="{{$end_date}}">
                <div class="form-group mb-0">
                    <select name="status" class="select2 form-select select-product" id = "statement_submit" required>
                        <option selected disabled>Filter Statement Status</option>
                        <!-- Populate this dropdown with product options -->
                        <option value="0" @if($status != null && $status == 0)selected @endif>UnPaid</option>
                        <option value="1" @if($status == 1)selected @endif>Paid</option>
                    </select>
                </div>
            </form>

            <div class="page-title d-flex justify-content-between gap-2">
                {{-- custome date --}}
                <div >
                    <button class="btn btn-sm btn-primary text-white" data-bs-toggle="modal" data-bs-target="#create">
                        Customize
                    </button>
                    {{--model --}}
                    <div class="modal fade" id="create" tabindex="-1" aria-labelledby="create" aria-hidden="true">
                        <div class="modal-dialog modal-lg modal-dialog-centered" role="document">
                            <div class="modal-content">
                                <div class="modal-header" style="background-color: #FF9F43;">
                                    <h5 class="modal-title text-white">Customize Statements</h5>
                                    <button type="button" class="close" data-bs-dismiss="modal" aria-label="Close">
                                        <span aria-hidden="true">×</span>
                                    </button>
                                </div>
                                <form method="GET" action="{{route('invoice-show',['id' => $user->id, 'type' => 'customer'])}}">
                                    <div class="modal-body">
                                        <div class="row d-flex justify-content-center">
                                            <div class="col-lg-6  col-12 mt-4 ">
                                                <div class="form-check form-check form-check-inline">
                                                    <input class="form-check-input" type="radio" value="1" name="status" id="flexRadioDefault1">
                                                    <label class="form-check-label" for="flexRadioDefault1">
                                                        Paid
                                                    </label>
                                                </div>
                                                <div class="form-check form-check form-check-inline">
                                                    <input class="form-check-input" type="radio" value="0" name="status" id="flexRadioDefault1">
                                                    <label class="form-check-label" for="flexRadioDefault1">
                                                        UnPaid
                                                    </label>
                                                </div>
                                            </div>
                                        </div>
                                        <div class="row">
                                            <div class="col-lg-6  col-12">
                                                <div class="form-group">
                                                    <label>Start At </label>
                                                    <input type="text" class="form-control" id="humanfrienndlydate"
                                                           name="start_date" required value="{{old('start_date')}}"
                                                           placeholder="Choose Start Date Report" >
                                                    @error('start_date')
                                                    <p class="text-danger">{{$message}}</p>
                                                    @enderror
                                                </div>
                                            </div>
                                            <div class="col-lg-6 col-sm-12 col-12">
                                                <div class="form-group">
                                                    <label>End At </label>
                                                    <input type="text" class="form-control" id="humanfrienndlydate"
                                                           name="end_date" required value="{{old('end_date')}}"
                                                           placeholder="Choose end Date Report">
                                                    @error('end_date')
                                                    <p class="text-danger">{{$message}}</p>
                                                    @enderror
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="modal-footer d-flex justify-content-between">
                                        <button class="btn btn-cancel" type="button" data-bs-dismiss="modal"
                                                aria-label="Close">Cancel</button>
                                        <button class="btn btn-submit" type="submit">Submit</button>
                                    </div>
                                </form>
                            </div>
                        </div>
                    </div>
                </div>
                @if(isset($start_date) && $start_date!=null)

                    <a id="printFilterButton" type="button" data-bs-placement="top"
                       class="btn btn-sm btn-primary text-capitalize"  style="background-color: #4260fa !important ; border-color: #4260fa !important"
                       title="Print">
                        Print
                        {{--<img src="{{ asset('assets/dashboard/img/icons/printer.svg') }}" style="width: 25px; margin-top: 5px;"  alt="Print">--}}
                    </a>

                    <script>
                        document.getElementById('printFilterButton').addEventListener('click', function() {
                            var pdfUrl = "{{route('filter-statement-print',['id' =>$user->id,'start_date' =>$start_date,'end_date' =>$end_date,'status' =>$status])}}";
                            var iframe = document.createElement('iframe');
                            iframe.style.display = 'none';
                            iframe.src = pdfUrl;
                            document.body.appendChild(iframe);
                            iframe.onload = function() {
                                iframe.contentWindow.print();
                                setTimeout(function() {
                                    document.body.removeChild(iframe);
                                }, 80000);
                            };
                        });
                    </script>

                    <a href="{{ route('filter-statement-pdf', ['id' => $user->id,'start_date' => $start_date,'end_date'=>$end_date, 'status' => $status]) }}"
                       class="btn btn-sm btn-danger text-capitalize" title="PDF" >
                          PDF
                    </a>
                @else
                <form method="GET" action="{{route('invoice-show',['id' => $user->id, 'type' => 'customer'])}}">
                    <input type="hidden" name="status" value="{{$status}}">
                    <button type="submit" value="7" name="date"
                            class="btn btn-sm btn-primary text-white" >Current Week</button>
                </form>
                <a id="printButton" type="button" data-bs-placement="top"
                   class="btn btn-sm btn-primary text-capitalize"  style="background-color: #4260fa !important ; border-color: #4260fa !important"
                   title="Print">
                   Print Current Week
                    {{--<img src="{{ asset('assets/dashboard/img/icons/printer.svg') }}" style="width: 25px; margin-top: 5px;"  alt="Print">--}}
                </a>

                <a href="{{route('invoices.customer.pdf',["id" =>$user->id,'status' => $status??3,'date' => 6])}}"
                   class="btn btn-sm btn-primary text-capitalize" style="background-color: #4260fa !important; border-color: #4260fa !important" >PDF Current Week </a>

                <a href="{{route('invoices.customer.pdf',['id'=>$user->id , 'status' => $status])}}"
                   class="btn btn-sm btn-danger text-capitalize" >All Statement PDF</a>

                @endif
                <a href="{{route('invoice-show',['id' => $user->id, 'type' => 'customer'])}}"
                   class="btn btn-sm btn-success text-capitalize" >Reset</a>

                    <script>
                    document.getElementById('printButton').addEventListener('click', function() {
                        var pdfUrl = "{{route('invoices.customer.print-statement',["id" =>$user->id, "status" => $status])}}";
                        var iframe = document.createElement('iframe');
                        iframe.style.display = 'none';
                        iframe.src = pdfUrl;
                        document.body.appendChild(iframe);
                        iframe.onload = function() {
                            iframe.contentWindow.print();
                            setTimeout(function() {
                                document.body.removeChild(iframe);
                            }, 80000);
                        };
                    });
                    </script>

            </div>

        </div>
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
                        <h5 >$<span class="counters" data-count="{{$count['remaining']}}">{{$count['remaining']}}</span></h5>
                        <h6>UnPaid</h6>
                    </div>
                </div>
            </div>
        </div>

        <div class="row">
            <div class="col-lg-12 col-sm-12 col-12 d-flex">
                <div class="card flex-fill">
                    <div class="card-header pb-0 d-flex justify-content-between align-items-center">
                        <h4 class="card-title mb-0">Last Orders {{$user->name}} Took </h4>
{{--                        <div class="dropdown">--}}
{{--                            <div class="btn-group customizeb d-flex justify-content-between gap-2" role="group" aria-label="filter">--}}
{{--                                <button type="submit" value="10" name="datese" class="btn btn-primary-light btn-sm btn-wave">10 Days</button>--}}
{{--                                <button type="submit" value="21" name="datese" class="btn btn-primary-light btn-sm btn-wave">3 Weeks</button>--}}
{{--                                <button type="submit" value="30" name="datese" class="btn btn-primary-light btn-sm btn-wave">last month</button>--}}
{{--                            </div>--}}
{{--                        </div>--}}
                    </div>
                    <div class="card-body">
                        <div id="customer_order"></div>
                    </div>
                </div>
            </div>
        </div>

        <div class="row">
            <div class="card mb-0">
                <div class="card-body">
                    <div class="table-top">
                        <div class="search-set">
                            <div class="search-path">
                                <h4>Orders List</h4>
                            </div>
                        </div>
                    </div>
                    <div class="table-responsive">
                        <table class="table  ">
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
                                            UnPaid
                                        @elseif($order->status == 2)
                                            P.Paid
                                        @else
                                            Paid
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
                                            <div>
                                                <a href="{{route('invoice.pdf',$order->id)}}"
                                                   class="btn btn-sm btn-danger text-uppercase text-white hover:none" download>
                                                    pdf
                                                </a>
                                            </div>
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
                                                                <div class="table-responsive">
                                                                    <table class="table">
                                                                        <thead>
                                                                        <tr >
                                                                            <th>Qty</th>
                                                                            <th>Description</th>
                                                                            <th> Price($)</th>
                                                                            <th>G.S.t ($)</th>
                                                                            <th>Discount($)	</th>
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
                                                                                <td>{{$detail->price}} $</td>
                                                                                <td>{{$detail->gst}} $</td>
                                                                                <td>{{$detail->discount}} $</td>
                                                                                <td>{{$detail->sub_total}} $</td>
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
                                                                                <h5>$ {{$order->total}}</h5>
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

                <form method="GET" action="{{ route('invoice-show',['id' => $user->id, 'type' => 'customer']) }}">
                    <div class="d-flex justify-content-between">
                        <div class="ps-3">
                            @foreach(request()->query() as $key => $value)
                                @if($key != 'number') <!-- Exclude number to avoid duplication -->
                                <input type="hidden" name="{{ $key }}" value="{{ $value }}">
                                @endif
                            @endforeach
                            <select name="number" class="ps-2 pe-2" onchange="this.form.submit()">
                                <option disabled selected>...</option>
                                <option value="10" @if($paginate == 10) selected @endif>10</option>
                                <option value="20" @if($paginate == 20) selected @endif>20</option>
                                <option value="30" @if($paginate == 30) selected @endif>30</option>
                                <option value="50" @if($paginate == 50) selected @endif>50</option>
                            </select>
                        </div>
                        <div>
                            {{ $orders->appends(request()->query())->links() }}
                        </div>
                    </div>
                </form>

            </div>
        </div>
    </div>
@endsection
@section('js')
    <script src="{{asset('assets/dashboard/flatpickr/flatpickr.min.js')}}"></script>
    <script src="{{asset('assets/dashboard/js/date&time_pickers.js')}}"></script>
    <script>
        var orders = @json($last_orders);
        var date = @json($date);
        $(document).ready(function (){
            $('#statement_submit').on('change',function (){
                $('#statementForm').submit();
            });
        });
    </script>
    <script src="{{asset('assets/dashboard/js/dashboard/customer.js')}}"></script>
@endsection

