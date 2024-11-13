@extends('Admin.layouts.master')
@section('main_head')
    <div class="page-title font-medium ">
        <h4> {{$customer->name}} - profile</h4>
    </div>
@endsection
@section('title') Customer - profile @endsection
@section('css')
    <style>
        .content{
            padding: 10px !important;
        }
        div.dataTables_wrapper div.dataTables_filter {
            width: 200px;
            float: right;
            margin-top: -65px;
            margin-right: 100px;
            z-index: 100;
            /* display: flex; */
            position: absolute;
            right: 0%;
            top: 87px;
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

            <div class="row">
                <div class="col-lg-3 col-sm-6 col-12">
                    <div class="dash-widget">
                        <div class="dash-widgetimg">
                            <span><img src="{{asset('assets/dashboard/img/icons/dash1.svg')}}" alt="img"></span>
                        </div>
                        <div class="dash-widgetcontent">
                            <h5 ><span class="counters" data-count="{{$orders->count()}}">{{$orders->count()}}</span></h5>
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
                            <h5 >$<span class="counters" data-count="{{$orders->sum('total')}}">${{$orders->sum('total')}}</span></h5>
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
                            <h5 >$<span class="counters" data-count="{{$orders->where('status','!=',0)->sum('amount_paid')}}">{{$orders->where('status','!=',0)->sum('amount_paid')}}</span></h5>
                            <h6>Paid</h6>
                        </div>
                    </div>
                </div>
                <div class="col-lg-3 col-sm-6 col-12">
                    <div class="dash-widget dash2">
                        <div class="dash-widgetimg">
                            <span><img src="{{asset('assets/dashboard/img/icons/dash3.svg')}}" alt="img"></span>

                        </div>
                        @php
                        $unpaid = $orders->sum('total') - $orders->where('status','!=',0)->sum('amount_paid');
                        @endphp
                        <div class="dash-widgetcontent">
                            <h5 >$<span class="counters" data-count="{{$unpaid}}">{{$unpaid}}</span></h5>
                            <h6>UnPaid</h6>
                        </div>
                    </div>
                </div>
            </div>

        <!-- /product list -->
        <div class="card">
            <div class="card-body">
                <div class="page-header d-flex justify-content-start">

                    <a class="btn btn-added" data-bs-toggle="modal" data-bs-target="#create">
                        <img src="{{asset('assets/dashboard/img/icons/plus.svg')}}"
                             class="me-2" alt="img">
                        Add New Product
                    </a>

                    <div class="modal fade" id="create" tabindex="-1" aria-labelledby="create"
                         aria-hidden="true">
                        <div class="modal-dialog modal-lg modal-dialog-centered" role="document">
                            <div class="modal-content">
                                <div class="modal-header" style="background-color: #FF9F43;" >
                                    <h5 class="modal-title text-white" >New  Product</h5>
                                    <button type="button" class="close" data-bs-dismiss="modal" aria-label="Close">
                                        <span aria-hidden="true">×</span>
                                    </button>
                                </div>
                                <form method="POST" action="{{route('customer-product',$customer->id)}}" >
                                    @csrf
                                    <div class="modal-body">
                                        <div class="row">
                                            <div class="col-lg-6 col-12">
                                                <div class="select-group">
                                                    <label>Products</label>
                                                    <select  class="js-example select2" name="product_id" required >
                                                        <option selected disabled>Choose Product</option>
                                                        @foreach($products as $product)
                                                            <option value="{{$product->id}}">{{$product->name}}</option>
                                                        @endforeach
                                                    </select>
                                                    @error('product_id')
                                                    <p class="text-danger">{{$message}}</p>
                                                    @enderror
                                                </div>
                                            </div>
                                            <div class="col-lg-6 col-12">
                                                <div class="form-group">
                                                    <label>Unit</label>
                                                    <select class="select form-select" name="unit_id" required>
                                                        <option selected disabled>Choose Unit</option>
                                                        @foreach($units as $unit)
                                                            <option value="{{$unit->id}}">{{$unit->name}}</option>
                                                        @endforeach
                                                    </select>
                                                    @error('unit_id')
                                                    <p class="text-danger">{{$message}}</p>
                                                    @enderror
                                                </div>
                                            </div>
                                            <div class="col-lg-6 col-12">
                                                <div class="form-group">
                                                    <label for="quantity">Price</label>
                                                    <input type="number" name="price" step="0.01" min="1" id="totalAmt"
                                                           class="form-control" required
                                                           placeholder="Enter Price of Unit {{$unit->name}}">
                                                    @error('price')
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
                </div>
                <div class="table-responsive">
                    <table class="table  datanew">
                        <thead>
                        <tr>
                            <th>#</th>
                            <th>Name</th>
                            <th>Unit</th>
                            <th>Price</th>
                            <th>Action</th>
                        </tr>
                        </thead>
                        <tbody>
                        @foreach($customer->prices as $price)
                            <tr>
                                <td>{{$loop->iteration}}</td>
                                <td>{{$price->product->name}}</td>
                                <td>{{$price->unit->name}}</td>
                                <td>${{$price->price}}</td>
                                <td>
                                    <a class="me-3" data-bs-toggle="modal" data-bs-target="#edit_price{{$price->id}}">
                                        <img src="{{asset('assets/dashboard/img/icons/edit.svg')}}" alt="img">
                                    </a>
                                     {{--  Model Edit--}}
                                    <div class="modal fade" id="edit_price{{$price->id}}" tabindex="-1" aria-labelledby="edit_price{{$price->id}}"
                                         aria-hidden="true">
                                        <div class="modal-dialog modal-lg modal-dialog-centered" role="document">
                                            <div class="modal-content">
                                                <div class="modal-header" style="background-color: #FF9F43;">
                                                    <h5 class="modal-title text-white" >Edit Price {{$price->product->name}}</h5>
                                                    <button type="button" class="close" data-bs-dismiss="modal" aria-label="Close">
                                                        <span aria-hidden="true">×</span>
                                                    </button>
                                                </div>
                                                <form method="POST" action="{{route('customer-product',$customer->id)}}">
                                                    @csrf
                                                    <input type="hidden" name="product_id" value="{{$price->product_id}}">
                                                    <div class="modal-body">
                                                        <div class="row">
                                                            <div class="col-lg-6 col-12">
                                                                <div class="form-group">
                                                                    <label>Unit</label>
                                                                    <select class="select form-select" name="unit_id" required>
                                                                        <option selected disabled>Choose Unit</option>
                                                                        @foreach($units as $unit)
                                                                            <option value="{{$unit->id}}"
                                                                                    @if($unit->id == $price->unit_id) selected @endif>{{$unit->name}}</option>
                                                                        @endforeach
                                                                    </select>
                                                                    @error('unit_id')
                                                                    <p class="text-danger">{{$message}}</p>
                                                                    @enderror
                                                                </div>
                                                            </div>
                                                            <div class="col-lg-6 col-sm-6 col-12">
                                                                <div class="form-group">
                                                                    <label> Price </label>
                                                                    <input type="text" name="price" value="{{$price->price}}"
                                                                           required placeholder="Enter User Name">
                                                                    @error('price')
                                                                    <p class="text-danger">{{$message}}</p>
                                                                    @enderror
                                                                </div>
                                                            </div>

                                                        </div>
                                                        <div class="modal-footer d-flex justify-content-between">
                                                            <button class="btn btn-cancel" type="button" data-bs-dismiss="modal">Cancel</button>
                                                            <button class="btn btn-submit" type="submit">Submit</button>
                                                        </div>
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
        </div>
        <!-- /product list -->

        {{--Payment Transfers--}}
            <div class="card ">
                <div class="card-body">
                    <div class="table-top d-block">
                        <div class="d-flex flex-wrap justify-content-between">
                            <h4 class="text-nowrap  col-12 col-md-3">Payment Transfers</h4>
                        </div>
                    </div>
                    <div class="table-responsive">
                        <table class="table ">
                            <thead>
                            <tr>
                                <th>No</th>
                                <th>Date</th>
                                <th>Total Due</th>
                                <th>Amount Paid</th>
                                <th>Remaining</th>
                                {{--<th>Over Payment</th>--}}
                                <th>type</th>
                                <th>P.type</th>
                                <th>Details</th>
                            </tr>
                            </thead>
                            <tbody>

                            @foreach($transfers as $transfer)
                                <tr>
                                    <td>{{$loop->iteration}}</td>
                                    <td>{{$transfer->created_at->format('d-m-Y H:i A')}}</td>
                                    <td>${{$transfer->total_due}}</td>
                                    <td>${{$transfer->amount_paid}}</td>
                                    <td>${{$transfer->remaining}}</td>
                                    {{--<td>${{$transfer->over_payment}}</td>--}}
                                    <td>
                                        @if($transfer->type == \App\Enums\PaymentTransferEnum::General->value )
                                            General
                                        @else
                                            Manual
                                        @endif
                                    </td>
                                    <td>
                                        @if($transfer->payment_type == \App\Enums\PaymentStatusEnum::Cash->value)
                                            Cash
                                        @elseif($transfer->payment_type == \App\Enums\PaymentStatusEnum::Card->value)
                                            Card
                                        @else
                                            Bank-Transfer
                                        @endif
                                    </td>
                                    <td>
                                        @if($transfer->type == \App\Enums\PaymentTransferEnum::General->value )
                                            <a href="{{route('show-general-payment',$transfer->id)}}"
                                               class="btn btn-sm btn-primary text-white hover:none">
                                                Details</a>
                                        @else
                                            <a href="{{route('logs.order.payment',$transfer->order_id)}}"
                                               class="btn btn-sm btn-primary text-white hover:none">
                                                Logs</a>
                                        @endif
                                    </td>
                                </tr>
                            @endforeach
                            </tbody>
                        </table>

                        <form method="GET" action="{{ route('customer-profile',$customer->id) }}" class="pt-3">
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
                                    {{ $transfers->appends(request()->except('page'))->links()}}
                                </div>
                            </div>
                        </form>

                    </div>
                </div>
            </div>
        {{--/Payment Transfers--}}
        {{-- chart column--}}
            <div class="row">
                <div class="col-lg-12 col-sm-12 col-12 d-flex">
                    <div class="card flex-fill">
                        <div class="card-header pb-0 d-flex justify-content-between align-items-center">
                            <h4 class="card-title mb-0">Orders Statically [ total - paid - P.Paid - unpaid ] </h4>
                            <div class="dropdown">
                                <a href="javascript:void(0);" data-bs-toggle="dropdown" aria-expanded="false" class="dropset">
                                    <i class="fa fa-ellipsis-v"></i>
                                </a>
                            </div>
                        </div>
                        <div class="card-body">
                            <div id="order_statically"></div>
                        </div>
                    </div>
                </div>
            </div>
    </div>
@endsection

@section('js')
    <script>
        $(".js-example").select2({
            tags: true,
        });
        let totalOrders = @json($total_orders);
        let ordersPaid = @json($orders_paid);
        let orderRemaining = @json($orders_remaining);
        let ordersUnPaid = @json($order_notPaid);
        let categories = @json($dated);

     </script>
    <script src="{{asset('assets/dashboard/js/dashboard/customer_chart.js')}}"></script>
@endsection

