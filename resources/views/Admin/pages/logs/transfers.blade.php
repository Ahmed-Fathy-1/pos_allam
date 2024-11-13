@extends('Admin.layouts.master')
@section('main_head')
    <div class="page-title font-medium ">
        <h4> invoice logs</h4>
    </div>
@endsection
@section('title') Invoice Payment Transfers @endsection
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
        <div style="color: #212529 !important;" class="pb-2">
            <div class=" d-flex justify-content-between">
                <div><h4>Invoice Payment Transfers : {{$order->serial}}</h4></div>
                <div><h4>Customer : {{$order->customer?->name??"guest"}}</h4></div>
            </div>
        </div>

        <!-- /product list -->
        <div class="card">
            <div class="card-body">
                <!-- /Filter -->
                <div class="row">
                    <div class="table-responsive">
                        <table class="table  datanew">
                            <thead>
                            <tr class="text-center">
                                <th>#</th>
                                <th>Date</th>
                                <th>Type</th>
                                <th>Total Due</th>
                                <th>Paid</th>
                                <th>remaining</th>
                                <th>P.Type</th>
                            </tr>
                            </thead>
                            <tbody>
                            @foreach($transfers as $transfer)
                                <tr class="text-center">
                                    <td >{{$loop->iteration}}</td>
                                    <td >{{\Carbon\Carbon::parse($transfer->created_at)->format('d-m-Y H:i A')}}</td>
                                    <td>
                                        @if($transfer->Transfer->type == \App\Enums\PaymentTransferEnum::General->value )
                                            General
                                        @else
                                            Manual
                                        @endif
                                    </td>
                                    <td >${{$transfer->deserved_amount}}</td>
                                    <td>${{$transfer->amount_paid}}</td>
                                    <td>${{$transfer->deserved_amount - $transfer->amount_paid}}</td>
                                    <td>
                                        @if($transfer->transfer->payment_type == \App\Enums\PaymentStatusEnum::Card->value)
                                            Card
                                        @elseif($transfer->transfer->payment_type == \App\Enums\PaymentStatusEnum::Cash->value)
                                            Cash
                                        @elseif($transfer->transfer->payment_type == \App\Enums\PaymentStatusEnum::PanKTransfar->value)
                                            Bank-Transfer
                                        @else
                                            Balance
                                        @endif
                                    </td>
                                </tr>
                            @endforeach
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>
        </div>
        <!-- /product list -->
    </div>
@endsection

