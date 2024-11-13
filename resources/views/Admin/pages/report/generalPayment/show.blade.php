@extends('Admin.layouts.master')
@section('main_head')
    <div class="page-title font-medium ">
        <h4>  Payments Details</h4>
    </div>
@endsection
@section('title') Payments Details @endsection
@section('css')
    <link rel="stylesheet" href="{{asset('assets/dashboard/flatpickr/flatpickr.min.css')}}">
    <link rel="stylesheet" href="{{asset('assets/dashboard/@simonwep/pickr/themes/nano.min.css')}}">
    <style>
        .content{
            padding: 10px !important;
        }

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

        <div class="card mb-0">
            <div class="card-body " >
                <div class="table-top d-block">
                    <div class="d-flex flex-wrap justify-content-between">
                        <h4 class="text-nowrap  col-12 col-md-3">Payments Details : {{$payment->customer->name}}</h4>
                        <div class="d-flex justify-content-between gap-2">
                            <a id="printButton" type="button" data-bs-placement="top" title="Print">
                                <img src="{{ asset('assets/dashboard/img/icons/printer.svg') }}" style="width: 25px; margin-top: 5px;"  alt="Print">
                            </a>
                            <a href="{{route('payment.transfer.pdf',$payment->id)}}" class="btn btn-sm btn-danger text-capitalize"
                               >Statement PDF</a>
                            <script>
                                document.getElementById('printButton').addEventListener('click', function() {
                                    var pdfUrl = "{{ route('payment.transfer.print', $payment->id) }}";
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
                </div>
                <div class="table-responsive">
                    <table class="table ">
                        <thead>
                        <tr>
                            <th>No</th>
                            <th>Date</th>
                            <th>Invoice ID</th>
                            <th>Status</th>
                            <th>Total Due</th>
                            <th>Amount Paid</th>
                            <th>Remaining</th>
                            <th>P.type</th>
                            <th class="text-center">Details</th>
                        </tr>
                        </thead>
                        <tbody>
                        @foreach($payment->ordersTansfer as $transfer)
                            <tr>
                                <td>{{$loop->iteration}}</td>
                                <td>{{$transfer->created_at->format('d-m-Y H:i A')}}</td>
                                <td>
                                    @if($transfer->serial !=null)
                                        {{$transfer->serial}}
                                    @else
                                        {{$transfer->id}}-{{\Carbon\Carbon::parse($transfer->created_at)->format('ymd')}}-
                                    @endif
                                </td>
                                <td>
                                    @if($transfer->status == 0)
                                        <a class="btn btn-sm btn-danger text-white">UnPaid</a>
                                    @elseif($transfer->status == 1)
                                        <a class="btn btn-sm btn-success text-white">Paid</a>
                                    @else
                                        <a class="btn btn-sm btn-info text-white"  style="background-color: #0d6efd !important;">
                                            P.Paid
                                        </a>
                                    @endif
                                </td>
                                <td>${{$transfer->total}}</td>
                                <td>${{$transfer->amount_paid}}</td>
                                <td>${{$transfer->remaining_amount}}</td>
                                <td>
                                    @if($transfer->payment_status == 0)
                                        Cash
                                    @elseif($transfer->payment_status == 1)
                                        Card
                                    @elseif($transfer->payment_status == '3')
                                        Balance
                                    @else
                                        Bank Transfer
                                    @endif
                                </td>
                                <td>
                                    <a data-bs-toggle="modal" data-bs-target="#details-order{{$transfer->id}}"
                                       class="btn btn-sm btn-primary text-white hover:none">
                                        Details</a>
                                    <div class="modal fade" id="details-order{{$transfer->id}}" tabindex="-1"
                                         aria-labelledby= "details-order{{$transfer->id}}"
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
                                                                    @if($transfer->casier_id != null) Online
                                                                    @else
                                                                        Cashier
                                                                    @endif
                                                                </div>
                                                            </div>
                                                            <div class="col-lg-6  col-12">
                                                                <div class="form-group">
                                                                    <strong>Delivery : </strong>
                                                                    {{\App\Enums\deliveryStatusEnum::from($transfer->delivery_status)->name}}
                                                                </div>
                                                            </div>

                                                            <div class="col-lg-6  col-12">
                                                                <div class="form-group">
                                                                    <label>Customer :
                                                                        {{$payment->customer->name . " ( ". $payment->customer->mobile . " )"}}
                                                                    </label>
                                                                </div>
                                                            </div>
                                                            <div class="col-lg-6  col-12">
                                                                <div class="form-group">
                                                                    <label>To :

                                                                        @if($transfer->address_id != null)
                                                                            {{$transfer->address?->address}} , {{$transfer->address?->city}} , {{$transfer->address?->state}},{{$transfer->address?->post_code}}
                                                                        @else
                                                                            not Assigned
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
                                                                        <th>Unit</th>
                                                                        <th> Price($)</th>
                                                                        <th>G.S.t ($)</th>
                                                                        <th>Subtotal ($)</th>
                                                                    </tr>
                                                                    </thead>
                                                                    <tbody>
                                                                    @foreach($transfer->orderDetails as $detail)
                                                                        <tr >
                                                                            <td>{{$detail->quantity}}</td>
                                                                            <td>
                                                                                <div class="d-flex align-items-center gap-1">
                                                                                    {{$detail->product->name}}
                                                                                    <small></small>
                                                                                </div>
                                                                            </td>
                                                                            <td>{{$detail->unit->name}}</td>
                                                                            <td>${{$detail->price}}</td>
                                                                            <td>{{$detail->gst > 0}}</td>
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
                                                                            <h5>${{$transfer->total}}</h5>
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
           {{-- @if($paymentTransfers->count() > 10)
                <form method="GET" action="{{ route('general.payment')}}">
                    <div class="d-flex justify-content-between">
                        <div class="ps-3">
                            <select name="number" class="ps-2 pe-2" onchange="this.form.submit()">
                                <option disabled selected>...</option>
                                <option value="10" @if($paginate == 10) selected @endif>10</option>
                                <option value="20" @if($paginate == 20) selected @endif>20</option>
                                <option value="30" @if($paginate == 30) selected @endif>30</option>
                                <option value="50" @if($paginate == 50) selected @endif>50</option>
                            </select>
                        </div>
                        <div>
                            {{ $paymentTransfers->appends(request()->except('page'))->links()}}
                        </div>
                    </div>
                </form>
            @endif--}}
        </div>
    </div>
@endsection
@section('js')
    <script>
        $(".product-tags").select2({
            tags: true
        });
    </script>
    <script src="{{asset('assets/dashboard/flatpickr/flatpickr.min.js')}}"></script>
    <script src="{{asset('assets/dashboard/js/date&time_pickers.js')}}"></script>
@endsection
