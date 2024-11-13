@extends('Admin.layouts.master')
@section('main_head')
    <div class="page-title font-medium ">
        <h4>Dashboard</h4>
    </div>
@endsection
@section('css')
    <style>
        .icon_containers span{
            color: #686665;
            font-weight: bold;
            font-size: 16px;
         }
        .fax{
            font-weight: 900;
            font-size: 50px;
            padding: 10px;

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
    </style>
@endsection
@section('title') Home @endsection
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

            <!-- home cards -->
            <div class="row mb-3 justify-content-center">
            <div class="col-lg-2 col-md-3 col-sm-4 col-3 p-1">
                    <a href="{{route('invoice')}}">
                    <div class="dash-count text-center p-1 p-md-4 justify-content-center justify-content-md-between justify-content-md-between  ">
                        <div class="dash-counts">
                            <h4>{{$count['users']}}</h4>
                            <h5>Customers</h5>
                        </div>
                        <div class="dash-imgs d-none d-md-block">
                            <i data-feather="user"></i>
                        </div>
                    </div>
                    </a>
                </div>


                <div class="col-lg-2 col-md-3 col-sm-4 col-3 p-1">
                    <a href="{{route('products')}}">
                    <div class="dash-count das1 text-center p-1 p-md-4 justify-content-center justify-content-md-between    ">
                        <div class="dash-counts">
                            <h4>{{$count['products']}}</h4>
                            <h5>products</h5>
                        </div>
                        <div class="dash-imgs d-none d-md-block">
                            <i data-feather="user-check"></i>
                        </div>
                    </div>
                    </a>
                </div>

                <div class="col-lg-2 col-md-3 col-sm-4 col-3 p-1 ">
                    <a href="{{route('category')}}">
                    <div class="dash-count das2 text-center p-1 p-md-4 justify-content-center justify-content-md-between    ">
                        <div class="dash-counts">
                            <h4>{{$count['category']}}</h4>
                            <h5>Category</h5>
                        </div>
                        <div class="dash-imgs d-none d-md-block">
                            <i data-feather="file-text"></i>
                        </div>
                    </div>
                    </a>
                </div>


                <div class="col-lg-2 col-md-3 col-sm-4 col-3 p-1 ">
                    <a href="{{route('orders')}}">
                    <div class="dash-count das3 text-center p-1 p-md-4 justify-content-center justify-content-md-between    ">
                        <div class="dash-counts">
                            <h4>{{$count['orders']}}</h4>
                            <h5>Orders</h5>
                        </div>
                        <div class="dash-imgs d-none d-md-block">
                            <i data-feather="file"></i>
                        </div>
                    </div>
                    </a>
                </div>

                <!-- home icons -->
                <div class="col-lg-4 d-flex justify-content-between align-items-center">
                    <div class="">
                        <a href="{{route('newIndex')}}">
                            <div class="icon_containers d-flex flex-column justify-content-center align-items-center"><i class="fa fax fa-shopping-cart"></i><span>Cashier</span></div>
                        </a>
                    </div>
                    <div class="">
                        <a href="{{route('products')}}">
                            <div class="icon_containers d-flex flex-column justify-content-center align-items-center"><i class="fa fax fa-shopping-bag"></i><span>Products</span></div>
                        </a>
                    </div>
                    <div class="">
                        <a href="{{route('orders')}}">
                            <div class="icon_containers d-flex flex-column justify-content-center align-items-center"><i class="fa fax fa-shopping-basket"></i><span>Orders</span></div>
                        </a>
                    </div>
                    <div class="">
                        <a href="{{route('all-customers')}}">
                            <div class="icon_containers d-flex flex-column justify-content-center align-items-center"><i class="fa fax fa-users"></i><span>Customers</span></div>
                        </a>
                    </div>
                </div>
            </div>

        <!-- Button trigger modal -->
        <div class="row mt-4">
            <div class="col-lg-7 col-sm-12 col-12 d-flex">
                <div class="card flex-fill">
                    <div class="card-header pb-0 d-flex justify-content-between align-items-center">
                        <h4 class="card-title mb-0">Delivery Status</h4>
                        <div class="dropdown">
                            <a href="javascript:void(0);" data-bs-toggle="dropdown" aria-expanded="false" class="dropset">
                                <i class="fa fa-ellipsis-v"></i>
                            </a>
                        </div>
                    </div>
                    <div class="card-body">
                        <div id="delivery_status"></div>
                    </div>
                </div>
            </div>
            <div class="col-lg-5 col-sm-12 col-12 d-flex">
                <div class="card flex-fill">
                    <div class="card-header pb-0 d-flex justify-content-between align-items-center">
                        <h5 class="card-title mb-0">Orders : Paid - P.Paid - UnPaid </h5>
                    </div>
                    <div class="card-body">
                        <div id="order_cashier_online"></div>
                    </div>
                </div>
            </div>

        </div>



    </div>
@endsection
@section('js')
    <script>
        $(".home-tags").select2({
            tags: true
        });
    </script>
    <script>
        var paidOrders = @json($paidOrders);
        var unPaidOrder = @json($unPaidOrder);
        var orderRemain = @json($orderRemain);
        var totalOrder = @json($total_order);
        var deliverPending = @json($delivery_pending);
        var deliverInTransit = @json($delivery_inTransit);
        var deliveryDelivered = @json($delivered);
        var date = @json($date);
     </script>
    <script src="{{asset('assets/dashboard/js/dashboard/index.js')}}"></script>
@endsection
