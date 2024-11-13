@extends('Admin.layouts.master')
@section('main_head')
    <div class="page-title font-medium ">
        <h4> Orders Page</h4>
    </div>
@endsection
@section('title') Orders @endsection
@section('css')
    <link rel="stylesheet" href="{{asset('assets/dashboard/flatpickr/flatpickr.min.css')}}">
    <link rel="stylesheet" href="{{asset('assets/dashboard/@simonwep/pickr/themes/nano.min.css')}}">
    <style>
        .content{
            padding: 10px !important;
        }
        div.dataTables_wrapper div.dataTables_filter {
        width: 150px;
        margin-top: -65px;
        z-index: 100;
        position: absolute;
        right: 48px;
        top: 87px;
        /* float: right; */
        /* display: flex; */
        /* margin-right: 15px; */
         }
        .placehold {
            width: 177.6px;
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
        <!--  cards -->
        <div class="row">
            <div class="col-lg-3 col-sm-6 col-3 p-1 d-flex">
                <div class="dash-count  text-center p-1 p-md-4 justify-content-center justify-content-md-between justify-content-sm-between  ">
                    <div class="dash-counts">
                        <h4>{{$count['total_orders']}}</h4>
                        <h5>Total Orders</h5>
                    </div>
                    <div class="dash-imgs d-none d-sm-block">
                        <i data-feather="user"></i>
                    </div>
                </div>
            </div>

            <div class="col-lg-3 col-sm-6 col-3 p-1 d-flex">
                <div class="dash-count das1   text-center p-1 p-md-4 justify-content-center justify-content-md-between justify-content-sm-between  ">
                    <div class="dash-counts">
                        <h4>{{$count['total_revenue']}} $</h4>
                        <h5>Total Revenue</h5>
                    </div>
                    <div class="dash-imgs d-none d-sm-block">
                        <i data-feather="user-check"></i>
                    </div>
                </div>
            </div>

            <div class="col-lg-3 col-sm-6 col-3 p-1 d-flex">
                <div class="dash-count das2   text-center p-1 p-md-4 justify-content-center justify-content-md-between justify-content-sm-between  ">
                    <div class="dash-counts">
                        <h4>{{$count['cashiers_orders']}}</h4>
                        <h5>Cashier Orders</h5>
                    </div>
                    <div class="dash-imgs d-none d-sm-block">
                        <i data-feather="file-text"></i>
                    </div>
                </div>
            </div>

            <div class="col-lg-3 col-sm-6 col-3 p-1 d-flex">
                <div class="dash-count das3   text-center p-1 p-md-4 justify-content-center justify-content-md-between justify-content-sm-between  ">
                    <div class="dash-counts">
                        <h4>{{$count['online_orders']}}</h4>
                        <h5>Online Orders </h5>
                    </div>
                    <div class="dash-imgs d-none d-sm-block">
                        <i data-feather="file"></i>
                    </div>
                </div>
            </div>
        </div>

        <div class="card mb-0">
            <div class="card-body">
                <div class="table-top d-block">
                    <div class="d-flex flex-wrap justify-content-between">
                        <h4 class="text-nowrap  col-12 col-md-3">Orders List</h4>
                        <div class="d-flex col-12 col-md-8 align-items-center mt-4 mt-md-0 justify-content-end">
                            <form method="GET" class="d-flex justify-content-end gap-2 align-items-center col" action="{{route('orders')}}">
                                <div class="w-100">
                                    <select class="select form-select d-block" name="customer_id" required>
                                        <option value="" SELECTED disabled>Select Customer</option>
                                        @foreach($customers as $customer)
                                            <option value="{{ $customer->id }}" @if($customerId == $customer->id) selected @endif >{{ $customer->name }}</option>
                                        @endforeach
                                    </select>
                                </div>
                                <div>
                                <button type="submit" class="btn btn-sm btn-success text-white">Submit</button>
                                </div>
                            </form>
                            <div class="search-path p-0 m-0"></div>
                            <div class="">
                                <a href="{{route('orders')}}" class="btn btn-sm btn-danger text-white " >Reset</a>
                            </div>
                            <div class="placehold ms-3 d-none d-md-block"></div>
                        </div>

                    </div>
                </div>
                <div class="table-responsive">
                    <table class="table ">
                        <thead>
                        <tr>
                            <th style="display: none">No</th>
                            <th>No</th>
                            <th>Invoice Id</th>
                            <th>Date</th>
                            <th>Customer</th>
                            <th>Status</th>
                            <th>Paid Date </th>
                            <th>Total Due</th>
                          {{--  <th>paid</th>
                            <th>remaining</th>--}}
                            <th class="text-center">Details</th>
                        </tr>
                        </thead>
                        <tbody>
                        @foreach($orders as $order)
                            <tr>
                                <td style="display: none">{{$loop->iteration}}</td>
                                <td><a href="{{route('logs.order.payment',$order->id)}}">{{$order->id}}</a></td>
                                <td><a href="{{route('logs.order.payment',$order->id)}}">{{$order->serial}}</a></td>
                                <td><a href="{{route('logs.order.payment',$order->id)}}">
                                    {{$order->created_at->format('d-m-Y h:i A')}}
                                    </a>
                                </td>
                                <td><a href="{{route('logs.order.payment',$order->id)}}">
                                        {{$order->customer?->name?? "guest"}}</a>
                                </td>
                                <td>
                                    @if($order->status == \App\Enums\OrderStatusEnum::Paid->value)
                                        <a class="btn btn-sm btn-success text-white"  data-bs-toggle="modal" data-bs-target="#status_invoice_paid{{$order->id}}">
                                            Paid
                                        </a>
                                        <div class="modal fade" id="status_invoice_paid{{$order->id}}" tabindex="-1" aria-labelledby="status_invoice_paid{{$order->id}}"
                                             aria-hidden="true">
                                            <div class="modal-dialog modal-lg modal-dialog-centered" role="document">
                                                <div class="modal-content">
                                                    <div class="modal-header"  style="background-color: #FF9F43;">
                                                        <h5 class="modal-title text-white" >Order Paid With</h5>
                                                        <button type="button" class="close" data-bs-dismiss="modal" aria-label="Close">
                                                            <span aria-hidden="true">×</span>
                                                        </button>
                                                    </div>
                                                    <form method="POST" action="{{route('order-status',$order->id)}}">
                                                        @csrf
                                                        @method('PUT')
                                                        <div class="modal-body">
                                                            <div class="row">
                                                                <div class="col-lg-12  col-12 mt-4 d-flex justify-content-center">
                                                                    <div class="form-check form-check form-check-inline">
                                                                        <input class="form-check-input status_transfer" type="radio" value="0" name="payment_status" id="flexRadioDefault1"
                                                                               @if($order->payment_status == 0) checked @endif
                                                                         >
                                                                        <label class="form-check-label" for="flexRadioDefault1">
                                                                            Cash
                                                                        </label>
                                                                    </div>
                                                                    <div class="form-check form-check form-check-inline">
                                                                        <input class="form-check-input status_transfer" type="radio" value="1" name="payment_status" id="flexRadioDefault1"
                                                                               @if($order->payment_status == 1) checked @endif >
                                                                        <label class="form-check-label" for="flexRadioDefault1">
                                                                            Card
                                                                        </label>
                                                                    </div>
                                                                    <div class="form-check form-check form-check-inline">
                                                                        <input class="form-check-input status_transfer" type="radio" value="2" name="payment_status" id="flexRadioDefault1"
                                                                               @if($order->payment_status == 2) checked @endif >
                                                                        <label class="form-check-label" for="flexRadioDefault1">
                                                                            Bank Transfer
                                                                        </label>
                                                                    </div>
                                                                    <div class="form-check form-check form-check-inline">
                                                                        <input class="form-check-input status_unpaid" type="radio" value="0" name="status" id="flexRadioDefault1" >
                                                                        <label class="form-check-label" for="flexRadioDefault1">
                                                                            UnPaid
                                                                        </label>
                                                                    </div>
                                                                </div>

                                                            </div>
                                                            <div class="row">
                                                                <div class="col-lg-6  col-12 ">
                                                                    <div class="form-group">
                                                                        <label for="quantity">Max Amount Paid ( ${{$order->total}} )</label>
                                                                        <input type="number" name="amount_paid"   value="{{$order->amount_paid}}"
                                                                               class="form-control amount_paid" min="1" step="0.01" max="{{$order->total}}" placeholder="Enter Valid Amount if available" >
                                                                    </div>
                                                                </div>
                                                                <div class="col-lg-6  col-12 mt-4">
                                                                    <div class="form-group">
                                                                        <input type="text" class="form-control datetime_paid" id="datetime_paid"
                                                                               name="paid_at"  value="{{$order->paid_at}}"
                                                                               placeholder="Paid At ">
                                                                        @error('paid_at')
                                                                        <p class="text-danger">{{$message}}</p>
                                                                        @enderror
                                                                    </div>
                                                                </div>
                                                            </div>
                                                        </div>
                                                        <div class="modal-footer d-flex justify-content-between">
                                                            <button class="btn btn-cancel"  type="button" data-bs-dismiss="modal" aria-label="Close">Cancel</button>
                                                            <button class="btn btn-submit" type="submit">Submit</button>
                                                        </div>
                                                    </form>
                                                </div>
                                            </div>
                                        </div>
                                    @elseif($order->status == \App\Enums\OrderStatusEnum::PartillyPaid->value)
                                        <a class="btn btn-sm btn-info text-white"  style="background-color: #0d6efd !important;" data-bs-toggle="modal" data-bs-target="#status_invoice_partially{{$order->id}}">
                                            P.Paid
                                        </a>
                                        <div class="modal fade" id="status_invoice_partially{{$order->id}}" tabindex="-1" aria-labelledby="status_invoice_partially{{$order->id}}"
                                             aria-hidden="true">
                                            <div class="modal-dialog modal-lg modal-dialog-centered" role="document">
                                                <div class="modal-content">
                                                    <div class="modal-header"  style="background-color: #FF9F43;">
                                                        <h5 class="modal-title text-white" >Order Paid With</h5>
                                                        <button type="button" class="close" data-bs-dismiss="modal" aria-label="Close">
                                                            <span aria-hidden="true">×</span>
                                                        </button>
                                                    </div>
                                                    <form method="POST" action="{{route('order-partilly-paid',$order->id)}}">
                                                        @csrf
                                                        @method('PUT')
                                                        <div class="modal-body">
                                                            <div class="row d-flex justify-content-center">
                                                                <div class="col-lg-6  col-12 mt-4 ">
                                                                    <div class="form-check form-check form-check-inline">
                                                                        <input class="form-check-input status_transfer" type="radio" value="0" name="payment_status" id="flexRadioDefault1"
                                                                               @if( $order->payment_status == \App\Enums\PaymentStatusEnum::Cash->value) checked @endif>
                                                                        <label class="form-check-label" for="flexRadioDefault1">
                                                                            Cash
                                                                        </label>
                                                                    </div>
                                                                    <div class="form-check form-check form-check-inline">
                                                                        <input class="form-check-input status_transfer" type="radio" value="1" name="payment_status" id="flexRadioDefault1"
                                                                               @if($order->payment_status == \App\Enums\PaymentStatusEnum::Card->value) checked @endif
                                                                        >
                                                                        <label class="form-check-label" for="flexRadioDefault1">
                                                                            Card
                                                                        </label>
                                                                    </div>
                                                                    <div class="form-check form-check form-check-inline">
                                                                        <input class="form-check-input status_transfer" type="radio" value="2" name="payment_status" id="flexRadioDefault1"
                                                                               @if($order->payment_status == \App\Enums\PaymentStatusEnum::PanKTransfar->value) checked @endif
                                                                        >
                                                                        <label class="form-check-label" for="flexRadioDefault1">
                                                                            Bank Transfer
                                                                        </label>
                                                                    </div>
                                                                    <div class="form-check form-check form-check-inline">
                                                                        <input class="form-check-input status_unpaid" type="radio" value="0" name="status" id="flexRadioDefault1" >
                                                                        <label class="form-check-label" for="flexRadioDefault1">
                                                                            UnPaid
                                                                        </label>
                                                                    </div>
                                                                </div>
                                                            </div>
                                                            <div class="row">
                                                                <div class="col-lg-6  col-12 ">
                                                                    <div class="form-group">
                                                                        <label for="quantity">Max Amount Paid ( ${{$order->remaining_amount}} )</label>
                                                                        <input type="number" name="amount_paid"  value="{{$order->remaining_amount}}"  max="{{$order->remaining_amount}}"
                                                                               class="form-control amount_paid" min="1" step="0.01" placeholder="Enter Valid Amount if available" >
                                                                    </div>
                                                                </div>
                                                                <div class="col-lg-6  col-12 mt-4">
                                                                    <div class="form-group">
                                                                        <input type="text" class="form-control datetime_paid" id="datetime_paid"
                                                                               name="paid_at"  value="{{old('paid_at')}}"
                                                                               placeholder="Paid At ">
                                                                        @error('paid_at')
                                                                        <p class="text-danger">{{$message}}</p>
                                                                        @enderror
                                                                    </div>
                                                                </div>
                                                            </div>
                                                        </div>
                                                        <div class="modal-footer d-flex justify-content-between">
                                                            <button class="btn btn-cancel"  type="button" data-bs-dismiss="modal" aria-label="Close">Cancel</button>
                                                            <button class="btn btn-submit" type="submit">Submit</button>
                                                        </div>
                                                    </form>
                                                </div>
                                            </div>
                                        </div>

                                    @else
                                        <a class="btn btn-sm btn-danger text-white"  data-bs-toggle="modal" data-bs-target="#status_invoice{{$order->id}}">
                                            UnPaid
                                        </a>

                                    @endif
                                        <div class="modal fade" id="status_invoice{{$order->id}}" tabindex="-1" aria-labelledby="status_invoice{{$order->id}}"
                                             aria-hidden="true">
                                            <div class="modal-dialog modal-lg modal-dialog-centered" role="document">
                                                <div class="modal-content">
                                                    <div class="modal-header"  style="background-color: #FF9F43;">
                                                        <h5 class="modal-title text-white" >Order Paid With</h5>
                                                        <button type="button" class="close" data-bs-dismiss="modal" aria-label="Close">
                                                            <span aria-hidden="true">×</span>
                                                        </button>
                                                    </div>
                                                    <form method="POST" action="{{route('order-update',$order->id)}}">
                                                        @csrf
                                                        @method('PUT')
                                                        <div class="modal-body">
                                                            <div class="row d-flex justify-content-center">
                                                                <input type="hidden" name="status" value="1">
                                                                <div class="col-lg-6  col-12 mt-4 ">
                                                                    <div class="form-check form-check form-check-inline">
                                                                        <input class="form-check-input" type="radio" value="0" name="payment_status" id="flexRadioDefault1"
                                                                               @if( $order->payment_status == \App\Enums\PaymentStatusEnum::Cash->value) checked @endif>
                                                                        <label class="form-check-label" for="flexRadioDefault1">
                                                                            Cash
                                                                        </label>
                                                                    </div>
                                                                    <div class="form-check form-check form-check-inline">
                                                                        <input class="form-check-input" type="radio" value="1" name="payment_status" id="flexRadioDefault1"
                                                                               @if($order->payment_status == \App\Enums\PaymentStatusEnum::Card->value) checked @endif
                                                                        >
                                                                        <label class="form-check-label" for="flexRadioDefault1">
                                                                            Card
                                                                        </label>
                                                                    </div>
                                                                    <div class="form-check form-check form-check-inline">
                                                                        <input class="form-check-input" type="radio" value="2" name="payment_status" id="flexRadioDefault1"
                                                                               @if($order->payment_status == \App\Enums\PaymentStatusEnum::PanKTransfar->value) checked @endif
                                                                        >
                                                                        <label class="form-check-label" for="flexRadioDefault1">
                                                                            Bank Transfer
                                                                        </label>
                                                                    </div>
                                                                </div>
                                                            </div>
                                                            <div class="row">
                                                                <div class="col-lg-6  col-12 ">
                                                                    <div class="form-group">
                                                                        <label for="quantity">Max Amount Paid ( ${{$order->total}} )</label>
                                                                        <input type="number" name="amount_paid" required value="{{$order->total}}"  max="{{$order->total}}"
                                                                               class="form-control" min="1" step="0.01" placeholder="Enter Valid Amount if available" >
                                                                    </div>
                                                                </div>
                                                                <div class="col-lg-6  col-12 mt-4">
                                                                    <div class="form-group">
                                                                        <input type="text" class="form-control" id="datetime_paid"
                                                                               name="paid_at"  value="{{old('paid_at')}}"
                                                                               placeholder="Paid At ">
                                                                        @error('paid_at')
                                                                        <p class="text-danger">{{$message}}</p>
                                                                        @enderror
                                                                    </div>
                                                                </div>
                                                            </div>
                                                        </div>
                                                        <div class="modal-footer d-flex justify-content-between">
                                                            <button class="btn btn-cancel"  type="button" data-bs-dismiss="modal" aria-label="Close">Cancel</button>
                                                            <button class="btn btn-submit" type="submit">Submit</button>
                                                        </div>
                                                    </form>
                                                </div>
                                            </div>
                                        </div>
                                </td>
                                {{--<td>
                                    @if($order->status == 1)
                                        <a class="btn btn-sm btn-success text-white"  data-bs-toggle="modal" data-bs-target="#status_invoice_paid{{$order->id}}">
                                            Paid
                                        </a>
                                        <div class="modal fade" id="status_invoice_paid{{$order->id}}" tabindex="-1" aria-labelledby="status_invoice_paid{{$order->id}}"
                                             aria-hidden="true">
                                            <div class="modal-dialog modal-lg modal-dialog-centered" role="document">
                                                <div class="modal-content">
                                                    <div class="modal-header"  style="background-color: #FF9F43;">
                                                        <h5 class="modal-title text-white" >Order Paid With</h5>
                                                        <button type="button" class="close" data-bs-dismiss="modal" aria-label="Close">
                                                            <span aria-hidden="true">×</span>
                                                        </button>
                                                    </div>
                                                    <form method="POST" action="{{route('order-status',$order->id)}}">
                                                        @csrf
                                                        @method('PUT')
                                                        <div class="modal-body">
                                                            <div class="row">
                                                                <div class="col-lg-12  col-12 mt-4 d-flex justify-content-center">
                                                                    <div class="form-check form-check form-check-inline">
                                                                        <input class="form-check-input status_transfer" type="radio" value="0" name="payment_status" id="flexRadioDefault1"
                                                                               @if($order->payment_status == 0) checked @endif
                                                                        >
                                                                        <label class="form-check-label" for="flexRadioDefault1">
                                                                            Cash
                                                                        </label>
                                                                    </div>
                                                                    <div class="form-check form-check form-check-inline">
                                                                        <input class="form-check-input status_transfer" type="radio" value="1" name="payment_status" id="flexRadioDefault1"
                                                                               @if($order->payment_status == 1) checked @endif >
                                                                        <label class="form-check-label" for="flexRadioDefault1">
                                                                            Card
                                                                        </label>
                                                                    </div>
                                                                    <div class="form-check form-check form-check-inline">
                                                                        <input class="form-check-input status_transfer" type="radio" value="2" name="payment_status" id="flexRadioDefault1"
                                                                               @if($order->payment_status == 2) checked @endif >
                                                                        <label class="form-check-label" for="flexRadioDefault1">
                                                                            Bank Transfer
                                                                        </label>
                                                                    </div>
                                                                    <div class="form-check form-check form-check-inline">
                                                                        <input class="form-check-input status_unpaid" type="radio" value="0" name="status" id="flexRadioDefault1" >
                                                                        <label class="form-check-label" for="flexRadioDefault1">
                                                                            UnPaid
                                                                        </label>
                                                                    </div>
                                                                </div>

                                                            </div>
                                                            <div class="row">
                                                                <div class="col-lg-6  col-12 ">
                                                                    <div class="form-group">
                                                                        <label for="quantity">Max Amount Paid ( ${{$order->total}} )</label>
                                                                        <input type="number" name="amount_paid"   value="{{$order->amount_paid}}"
                                                                               class="form-control amount_paid" min="1" step="0.01" max="{{$order->total}}" placeholder="Enter Valid Amount if available" >
                                                                    </div>
                                                                </div>
                                                                <div class="col-lg-6  col-12 mt-4">
                                                                    <div class="form-group">
                                                                        <input type="text" class="form-control datetime_paid" id="datetime_paid"
                                                                               name="paid_at"  value="{{$order->paid_at}}"
                                                                               placeholder="Paid At ">
                                                                        @error('paid_at')
                                                                        <p class="text-danger">{{$message}}</p>
                                                                        @enderror
                                                                    </div>
                                                                </div>
                                                            </div>
                                                        </div>
                                                        <div class="modal-footer d-flex justify-content-between">
                                                            <button class="btn btn-cancel"  type="button" data-bs-dismiss="modal" aria-label="Close">Cancel</button>
                                                            <button class="btn btn-submit" type="submit">Submit</button>
                                                        </div>
                                                    </form>
                                                </div>
                                            </div>
                                        </div>
                                    @else
                                        <a class="btn btn-sm btn-danger text-white"  data-bs-toggle="modal" data-bs-target="#status_invoice{{$order->id}}">
                                            UnPaid
                                        </a>
                                    @endif
                                    <div class="modal fade" id="status_invoice{{$order->id}}" tabindex="-1" aria-labelledby="status_invoice{{$order->id}}"
                                         aria-hidden="true">
                                        <div class="modal-dialog modal-lg modal-dialog-centered" role="document">
                                            <div class="modal-content">
                                                <div class="modal-header"  style="background-color: #FF9F43;">
                                                    <h5 class="modal-title text-white" >Order Paid With</h5>
                                                    <button type="button" class="close" data-bs-dismiss="modal" aria-label="Close">
                                                        <span aria-hidden="true">×</span>
                                                    </button>
                                                </div>
                                                <form method="POST" action="{{route('order-update',$order->id)}}">
                                                    @csrf
                                                    @method('PUT')
                                                    <div class="modal-body">
                                                        <div class="row d-flex justify-content-center">
                                                            <input type="hidden" name="status" value="1">
                                                            <div class="col-lg-6  col-12 mt-4 ">
                                                                <div class="form-check form-check form-check-inline">
                                                                    <input class="form-check-input" type="radio" value="0" name="payment_status" id="flexRadioDefault1"
                                                                           @if( $order->payment_status == \App\Enums\PaymentStatusEnum::Cash->value) checked @endif>
                                                                    <label class="form-check-label" for="flexRadioDefault1">
                                                                        Cash
                                                                    </label>
                                                                </div>
                                                                <div class="form-check form-check form-check-inline">
                                                                    <input class="form-check-input" type="radio" value="1" name="payment_status" id="flexRadioDefault1"
                                                                           @if($order->payment_status == \App\Enums\PaymentStatusEnum::Card->value) checked @endif
                                                                    >
                                                                    <label class="form-check-label" for="flexRadioDefault1">
                                                                        Card
                                                                    </label>
                                                                </div>
                                                                <div class="form-check form-check form-check-inline">
                                                                    <input class="form-check-input" type="radio" value="2" name="payment_status" id="flexRadioDefault1"
                                                                           @if($order->payment_status == \App\Enums\PaymentStatusEnum::PanKTransfar->value) checked @endif
                                                                    >
                                                                    <label class="form-check-label" for="flexRadioDefault1">
                                                                        Bank Transfer
                                                                    </label>
                                                                </div>
                                                            </div>
                                                        </div>
                                                        <div class="row">
                                                            <div class="col-lg-6  col-12 ">
                                                                <div class="form-group">
                                                                    <label for="quantity">Max Amount Paid ( ${{$order->total}} )</label>
                                                                    <input type="number" name="amount_paid" required value="{{$order->total}}"  max="{{$order->total}}"
                                                                           class="form-control" min="1" step="0.01" placeholder="Enter Valid Amount if available" >
                                                                </div>
                                                            </div>
                                                            <div class="col-lg-6  col-12 mt-4">
                                                                <div class="form-group">
                                                                    <input type="text" class="form-control" id="datetime_paid"
                                                                           name="paid_at"  value="{{old('paid_at')}}"
                                                                           placeholder="Paid At ">
                                                                    @error('paid_at')
                                                                    <p class="text-danger">{{$message}}</p>
                                                                    @enderror
                                                                </div>
                                                            </div>
                                                        </div>
                                                    </div>
                                                    <div class="modal-footer d-flex justify-content-between">
                                                        <button class="btn btn-cancel"  type="button" data-bs-dismiss="modal" aria-label="Close">Cancel</button>
                                                        <button class="btn btn-submit" type="submit">Submit</button>
                                                    </div>
                                                </form>
                                            </div>
                                        </div>
                                    </div>
                                </td>--}}
                                <td><a href="{{route('logs.order.payment',$order->id)}}">
                                    @if($order->status !=0)
                                        {{\Carbon\Carbon::parse($order->paid_at??$order->updated_at)->format('d-m-Y h:i A')}}
                                    @else
                                        00-00-00
                                    @endif
                                    </a>
                                </td>
                                <td><a href="{{route('logs.order.payment',$order->id)}}">
                                        {{$order->total}}</a>
                                </td>
                              {{--  <td><a href="{{route('logs.order.payment',$order->id)}}">
                                        ${{$order->amount_paid}}</a>
                                </td>
                                <td><a href="{{route('logs.order.payment',$order->id)}}">
                                        ${{$order->remaining_amount}}</a>
                                </td>--}}
                                <td>
                                    <div class="d-flex justify-content-center gap-2">
                                        <div>
                                            <a href="{{route('logs.order.payment',$order->id)}}"
                                               class="btn btn-sm btn-primary text-white hover:none">
                                                Details</a>
                                        </div>
                                        <div>
                                            <a href="{{route('invoice.pdf',$order->id)}}" download
                                               class="btn btn-sm btn-danger text-uppercase text-white hover:none" >
                                               pdf
                                            </a>
                                        </div>
                                        @if($order->deleted_at ==null)
                                        <div>
                                            <a style="margin: 2px" href="{{route('edit-invoice',$order->id)}}" >
                                                <img src="{{asset('assets/dashboard/img/icons/edit.svg')}}" style="width: 25px; margin-top: 0;" alt="img">
                                            </a>
                                        </div>
                                        @endif
                                            @if($order->deleted_at !=null)
                                                <div>
                                                    <span class="text-danger bold">تم الحذف</span>
                                                </div>
                                        @else
                                        <div>
                                            <a  data-bs-toggle="modal" data-bs-target="#delete{{$order->id}}">
                                                <img src="{{asset('assets/dashboard/img/icons/delete.svg')}}" alt="img">
                                            </a>
                                        </div>
                                        @endif
                                    </div>

                                    {{-- delete order --}}
                                    <div class="modal fade" id="delete{{$order->id}}" tabindex="-1"  aria-hidden="true">
                                        <div class="modal-dialog modal-dialog-centered" role="document">
                                            <div class="modal-content">
                                                <div class="modal-header" style="background-color: #FF9F43;" >
                                                    <h5 class="modal-title text-white" >Delete Order</h5>
                                                    <button type="button" class="close" data-bs-dismiss="modal" aria-label="Close">
                                                        <span aria-hidden="true">×</span>
                                                    </button>
                                                </div>
                                                <form method="POST" action="{{route('order-delete',$order->id)}}">
                                                    @csrf
                                                    @method('DELETE')
                                                    <div class="modal-body">
                                                        <div class="delete-order">
                                                            <img src="{{asset('assets/dashboard/img/icons/close-circle1.svg')}}" alt="img">
                                                        </div>
                                                        <div class="para-set text-center">
                                                            <p>Are You Sure Delete Order And invoices</p>
                                                        </div>
                                                    </div>
                                                    <div class="modal-footer d-flex justify-content-between">
                                                        <button class="btn btn-cancel" type="button" data-bs-dismiss="modal">No</button>
                                                        <button class="btn btn-danger" type="submit" >Yes</button>
                                                    </div>
                                                </form>
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
            <form method="GET" action="{{ route('orders') }}">
                <div class="d-flex justify-content-between">
                    <div class="ps-3">
                        @if($customerId)
                            <input type="hidden" name="customer_id" value="{{ $customerId }}">
                        @endif
                        <select name="number" class="ps-2 pe-2" onchange="this.form.submit()">
                            <option disabled selected>...</option>
                            <option value="10" @if($paginate == 10) selected @endif>10</option>
                            <option value="20" @if($paginate == 20) selected @endif>20</option>
                            <option value="30" @if($paginate == 30) selected @endif>30</option>
                            <option value="50" @if($paginate == 50) selected @endif>50</option>
                        </select>
                    </div>
                    <div>
                        {{ $orders->appends(request()->except('page'))->links()}}
                    </div>
                </div>
            </form>
        </div>

            <!-- Button trigger modal -->
            <div class="row mt-3">
                <div class="col-lg-12 col-sm-12 col-12 d-flex">
                    <div class="card flex-fill">
                        <div class="card-header pb-0 d-flex justify-content-between align-items-center">
                            <h4 class="card-title mb-0">Last Orders ( Cashier - Online ) </h4>
                            <div class="dropdown">
                                <a href="javascript:void(0);" data-bs-toggle="dropdown" aria-expanded="false" class="dropset">
                                    <i class="fa fa-ellipsis-v"></i>
                                </a>
                            </div>
                        </div>
                        <div class="card-body">
                            <div id="orders_line"></div>
                        </div>
                    </div>
                </div>
            </div>

        <div class="row mt-3">
            <div class="col-lg-12 col-sm-12 col-12 d-flex">
                <div class="card flex-fill">
                    <div class="card-header pb-0 d-flex justify-content-between align-items-center">
                        <h5 class="card-title mb-0">Total Revenue ( Total - Cashier - Online ) </h5>
                    </div>
                    <div class="card-body">
                        <div id="column_revenue"></div>
                    </div>
                </div>
            </div>
        </div>

    </div>
@endsection
@section('js')
    <script>
        var onlineOrder = @json($online_orders);
        var casierOrder = @json($cashier_orders);
        var date = @json($date);

        var totalRevenue = @json($total_revenue);
        var onlineRevenue = @json($online_revenue);
        var cashierRevenue = @json($cashier_revenue);

        $(document).ready(function() {
            var originalAmountPaid = $('.amount_paid').val();
            var originalDatePaid = $('.datetime_paid').val();

            $('.status_unpaid').on('change', function() {
                if ($(this).is(':checked')) {
                    $('.status_transfer').prop('checked', false);
                    $('.amount_paid').val('');
                    $('.datetime_paid').val('');
                }
            });

            $('.status_transfer').on('change', function() {
                if ($(this).is(':checked')) {
                    $('.status_unpaid').prop('checked', false);
                    $('.amount_paid').val(originalAmountPaid);
                    $('.datetime_paid').val(originalDatePaid);
                }
            });
        });
    </script>
    <script src="{{asset('assets/dashboard/flatpickr/flatpickr.min.js')}}"></script>
    <script src="{{asset('assets/dashboard/js/date&time_pickers.js')}}"></script>
    <script src="{{asset('assets/dashboard/js/dashboard/orderChart.js')}}"></script>
@endsection
