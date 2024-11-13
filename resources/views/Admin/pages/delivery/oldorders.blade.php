@extends('Admin.layouts.master')
@section('title') Old-orders @endsection
@section('content')
    <div class="content">
        <div class="page-header">
            <div class="page-title">
                <h4> OldOrders Page </h4>
                <h6>Here You see all orders that alreadyDelivered</h6>
            </div>
            <div class="d-flex justify-content-end me-2">
              <strong>Total Delivered : {{$orders->count()}}</strong>
            </div>
        </div>
        @foreach($orders as $order)
            <div class="card mb-5">
                <div class="d-flex align-items-center flex-column flex-lg-row  gap-3 m-4">
                    <div class="w-100">
                        <form method="POST" action="{{route('update-delivery',$order->id)}}">
                            @csrf
                            @method('PUT')
                            <label class="mb-2">Delivery Status</label>
                            <div class="d-flex align-items-center gap-2 w-100">
                                <div class="form-group mb-0 w-100">
                                    <select class="select form-select" name="delivery_status" required style="min-width: 10rem !important;">
                                        <option selected disabled>Choose Delivery Status</option>
                                        <option  value="{{\App\Enums\deliveryStatusEnum::Pending->value}}" @if($order->delivery_status ==\App\Enums\deliveryStatusEnum::Pending->value ) selected @endif>Pending</option>
                                        <option  value="{{\App\Enums\deliveryStatusEnum::InTransit->value}}" @if($order->delivery_status == \App\Enums\deliveryStatusEnum::InTransit->value ) selected @endif>InTransit</option>
                                        <option  value="{{\App\Enums\deliveryStatusEnum::Delivered->value}}" @if($order->delivery_status == \App\Enums\deliveryStatusEnum::Delivered->value) selected @endif>Delivered</option>
                                    </select>
                                    @error('delivery_status')
                                    <p class="text-danger">{{$message}}</p>
                                    @enderror
                                </div>
                                <button class="btn py-2 btn-submit"  type="submit">Submit</button>

                            </div>
                        </form>
                    </div>
                </div>

            <div class="card-body mb-5">
                <div class="row">
                    <div class="col-lg-6 col-12">
                        <div class="form-group">
                            <label>Recipient Name :
                            @if($order->user_id == null)
                                {{$order->customer->name . " ( ". $order->customer->mobile . " )"}}
                            @else
                                {{$order->user->name . " ( ". $order->user->mobile . " )"}}
                            @endif
                            </label>
                        </div>
                    </div>
                    <div class="col-lg-6 col-sm-6 col-12">
                        <div class="form-group">
                            <label> A.B.N  :
                                @if($order->user_id == null)
                                    {{$order->customer->abn}}
                                @else
                                    Personal
                                @endif
                            </label>
                        </div>
                    </div>

                    <div class="col-lg-12 col-12">
                        <div class="form-group">
                            <label>To :
                                    {{$order->address->address}} , {{$order->address->city}} , {{$order->address->state}},{{$order->address->post_code}}
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
                                <li>
                                    <h4>Total G.S.T</h4>
                                    <h5>$ {{$order->total_gst}}</h5>
                                </li>
                                <li>
                                    <h4>Total Discount</h4>
                                    <h5>$ {{$order->total_discount}}</h5>
                                </li>

                                <li class="total">
                                    <h4>Grand Total</h4>
                                    <h5>$ {{$order->total}}</h5>
                                </li>
                            </ul>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        @endforeach
    </div>
@endsection

