@extends('Admin.layouts.master')
@section('main_head')
    <div class="page-title font-medium ">
        <h4>  Payments</h4>
    </div>
@endsection
@section('title') Payment transfers @endsection
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
                        <h4 class="text-nowrap  col-12 col-md-3">Payment transfers</h4>
                        <div>
                            <a class="btn btn-primary" data-bs-toggle="modal" data-bs-target="#create">
                                     Payment
                            </a>
                            <div class="modal fade" id="create" tabindex="-1" aria-labelledby="create"
                                 aria-hidden="true">
                                <div class="modal-dialog modal-lg modal-dialog-centered" role="document">
                                    <div class="modal-content">
                                        <div class="modal-header" style="background-color: #FF9F43;" >
                                            <h5 class="modal-title text-white" > Payment </h5>
                                            <button type="button" class="close" data-bs-dismiss="modal" aria-label="Close">
                                                <span aria-hidden="true">×</span>
                                            </button>
                                        </div>
                                        <form method="POST" action="{{route('pay.general.payment')}}">
                                            @csrf
                                            <input type="hidden" name="type" value="1">
                                            <div class="modal-body">
                                                <div class="row d-flex justify-content-center">
                                                    <div class="col-lg-6  col-12 mt-4 ">
                                                        <div class="form-check form-check form-check-inline">
                                                            <input class="form-check-input" type="radio" value="0" name="payment_type" id="flexRadioDefault1">
                                                            <label class="form-check-label" for="flexRadioDefault1">
                                                                Cash
                                                            </label>
                                                        </div>
                                                        <div class="form-check form-check form-check-inline">
                                                            <input class="form-check-input" type="radio" value="1" name="payment_type" id="flexRadioDefault1">
                                                            <label class="form-check-label" for="flexRadioDefault1">
                                                                Card
                                                            </label>
                                                        </div>
                                                        <div class="form-check form-check form-check-inline">
                                                            <input class="form-check-input" type="radio" value="2" name="payment_type" id="flexRadioDefault1">
                                                            <label class="form-check-label" for="flexRadioDefault1">
                                                                Bank Transfer
                                                            </label>
                                                        </div>
                                                    </div>
                                                </div>
                                                <div class="row">
                                                    <div class="col-lg-6 col-sm-6 col-12">
                                                        <div class="form-group">
                                                            <label>Customers</label>
                                                            <select class="select form-select" name="customer_id" required>
                                                                <option selected disabled>Choose Customers</option>
                                                                @foreach($customers as $customer)
                                                                    <option value="{{$customer->id}}">{{$customer->name}}</option>
                                                                @endforeach
                                                            </select>
                                                            @error('customer_id')
                                                            <p class="text-danger">{{$message}}</p>
                                                            @enderror
                                                        </div>
                                                    </div>
                                                    <div class="col-lg-6  col-12 ">
                                                        <div class="form-group">
                                                            <label for="quantity">Total Due</label>
                                                            <input type="number" disabled name="total_due"   id="total_due"
                                                                   class="form-control" min="1" step="0.01"
                                                                   placeholder="Total Due Of customer selected" >
                                                            <input type="hidden" name="total_due" id="total_due_hidden" value="">
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>
                                            <div class="row ps-2">
                                                <div class="col-lg-6  col-12 ">
                                                    <div class="form-group">
                                                        <label for="quantity">Amount Paid</label>
                                                        <input type="number" name="amount_paid" required
                                                               class="form-control" min="1" step="0.01" placeholder="Enter Valid Amount if available" >
                                                    </div>
                                                </div>
                                                <div class="col-lg-6  col-12">
                                                    <div class="form-group">
                                                        <label for="quantity">Payment Date </label>
                                                        <input type="text" class="form-control" id="datetime_paid"
                                                               name="paid_at"  value="{{old('paid_at')}}"
                                                               placeholder="Paid At ">
                                                        @error('paid_at')
                                                        <p class="text-danger">{{$message}}</p>
                                                        @enderror
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
                        </div>
                    </div>
                </div>
                <div class="table-responsive">
                    <table class="table ">
                        <thead>
                        <tr>
                            <th>No</th>
                            <th>Date</th>
                            <th>Customer</th>
                            <th>Total Due</th>
                            <th>Amount Paid</th>
                            <th>Remaining</th>
                           {{-- <th>Over Payment</th>--}}
                            <th>type</th>
                            <th class="text-center">Details</th>
                        </tr>
                        </thead>
                        <tbody>
                            @foreach($paymentTransfers as $paymentTransfer)
                               <tr>
                                <td>{{$loop->iteration}}</td>
                                <td>{{$paymentTransfer->created_at->format('d-m-Y h:i A')}}</td>
                                <td>{{$paymentTransfer->customer?->name??"Guest"}}</td>
                                <td>${{$paymentTransfer->total_due}}</td>
                                <td>${{$paymentTransfer->amount_paid}}</td>
                                <td>${{$paymentTransfer->remaining}}</td>
                               {{-- <td>${{$paymentTransfer->over_payment}}</td>--}}
                                <td>
                                    @if($paymentTransfer->type == \App\Enums\PaymentTransferEnum::General->value )
                                       General
                                    @else
                                       Manual
                                    @endif
                                </td>
                                <td>
                                    @if($paymentTransfer->type == \App\Enums\PaymentTransferEnum::General->value )
                                    <a href="{{route('show-general-payment',$paymentTransfer->id)}}"
                                       class="btn btn-sm btn-primary text-white hover:none">
                                        Details</a>
                                    @else
                                        <a href="{{route('logs.order.payment',$paymentTransfer->order_id)}}"
                                           class="btn btn-sm btn-primary text-white hover:none">
                                            Logs</a>
                                    @endif
                                </td>
                            </tr>
                            @endforeach
                        </tbody>
                    </table>
                </div>
            </div>

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

        </div>
    </div>
@endsection
@section('js')
    <script>
        $(".product-tags").select2({
            tags: true
        });
        $(document).ready(function () {
            $('select[name="customer_id"]').on('change', function () {
                var Customer_id = $(this).val();

                if (Customer_id){
                    $.ajax({
                        url: "{{ URL::to('admin/customer-total-due') }}/" + Customer_id, // THIS IS ROUTE
                        type: "GET",
                        headers: {
                            'X-CSRF-TOKEN': '{{ csrf_token() }}'
                        },
                        dataType: "json",
                        success: function (data) {
                            console.log(data);
                            $('#total_due').val(data);
                            $('#total_due_hidden').val(data);
                        },
                        error: function (xhr, status, error) {
                            console.error(xhr.responseText);
                        }
                    });
                }
                else {
                    console.log('AJAX load did not work');
                }
            });
        });
    </script>
    <script src="{{asset('assets/dashboard/flatpickr/flatpickr.min.js')}}"></script>
    <script src="{{asset('assets/dashboard/js/date&time_pickers.js')}}"></script>
@endsection
