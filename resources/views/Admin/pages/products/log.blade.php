@extends('Admin.layouts.master')
@section('main_head')
    <div class="page-title font-medium ">
        <h4>Product - Details</h4>
    </div>
@endsection
@section('title') Product - Details @endsection
@section('css')
    <!-- Owl Carousel CSS -->
    <link rel="stylesheet" href="{{asset('assets/dashboard/plugins/owlcarousel/owl.carousel.min.css')}}">
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
            {{--<div class="d-flex justify-content-start align-items-center">
                <div>
                    <a class="btn btn-primary" href="{{route('product-edit',$product->id)}}"> Edit</a>
                </div>
            </div>--}}
            <div class="row">
                <div class="col-lg-4 col-sm-6 col-12">
                    <div class="dash-widget">
                        <div class="dash-widgetimg">
                            <span><img src="{{asset('assets/dashboard/img/icons/dash1.svg')}}" alt="img"></span>
                        </div>
                        <div class="dash-widgetcontent">
                            <h5 ><span class="counters" data-count="{{$pOrder->sum('quantity')}}">{{$pOrder->sum('quantity')}}</span></h5>
                            <h6>Total Quantity Purchase</h6>
                        </div>
                    </div>
                </div>
                <div class="col-lg-4 col-sm-6 col-12">
                    <div class="dash-widget dash1">
                        <div class="dash-widgetimg">
                            <span><img src="{{asset('assets/dashboard/img/icons/dash2.svg')}}" alt="img"></span>
                        </div>
                        <div class="dash-widgetcontent">
                            <h5 >$<span class="counters" data-count="{{$pOrder->sum('sub_total')}}">${{$pOrder->sum('sub_total')}}</span></h5>
                            <h6>Total Purchase Due</h6>
                        </div>
                    </div>
                </div>
                <div class="col-lg-4 col-sm-6 col-12">
                    <div class="dash-widget dash3">
                        <div class="dash-widgetimg">
                            <span><img src="{{asset('assets/dashboard/img/icons/dash4.svg')}}" alt="img"></span>
                        </div>
                        <div class="dash-widgetcontent">
                            <h5>%<span class="counters" data-count="{{$percentage}}">%{{$percentage}}</span></h5>
                            <h6>Total Purchase percentage</h6>
                        </div>
                    </div>
                </div>
            </div>
            <!-- /add -->
            <div class="row">
                <div class="col-lg-8 col-sm-12">
                    <div class="card">
                        <div class="card-body">
                            <div class="productdetails">
                                <ul class="product-bar">
                                    <li>
                                        <h4>Product</h4>
                                        <h6>{{$product->name}}</h6>
                                    </li>
                                    <li>
                                        <h4>Category</h4>
                                        <h6>{{$product->category->name}}</h6>
                                    </li>
                                    <li>
                                        <h4>Slug </h4>
                                        <h6>{{$product->slug_url}}</h6>
                                    </li>
                                    <li>
                                        <h4>Description</h4>
                                        <h6>{{$product->description}}</h6>
                                    </li>
                                </ul>
                                  <table class="table">
                                  <thead>
                                  <tr>
                                      <th>Stock</th>
                                      <th>Unit</th>
                                      <th>Status</th>
                                      <th>Price</th>
                                      <th>G.S.T</th>
                                      <th>Discount</th>
                                  </tr>
                                  </thead>
                                  <tbody>
                                  @foreach($product->prices as $price)
                                      <tr>
                                          <td>{{$price->stock}}</td>
                                          <td>{{$price->unit->name}}</td>
                                          <td class="text-capitalize">
                                              @if($price->status == 1)
                                                  <span class="badge bg-success">Active</span>
                                              @else
                                                  <span class="badge bg-danger">Inactive</span>
                                              @endif
                                          </td>
                                          <td>{{$price->price}}</td>
                                          <td>{{$price->gst}}</td>
                                          <td>{{$price->discount}}</td>
                                      </tr>
                                  @endforeach
                                  </tbody>
                              </table>
                            </div>


                        </div>
                    </div>
                </div>
                <div class="col-lg-4 col-sm-12">
                    <div class="card">
                        <div class="card-body">
                            <div class="slider-product-details">
                                <div class="owl-carousel owl-theme product-slide">
                                    @foreach($product->images as $image)
                                    <div class="slider-product">
                                        <img src="{{asset('storage/'.$image)}}" alt="img">
                                        <h4>Product Images</h4>
                                        <h6></h6>
                                    </div>
                                    @endforeach
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <!-- /add -->
            <div class="page-header">
                <div class="page-title">
                    <h4>Product Price Logs</h4>
                    <h6>Full details of a product prices Log</h6>
                </div>
            </div>
            {{--logs--}}
            <div class="row">
                <div class="col-lg-12 col-sm-12">
                    <div class="card">
                        <div class="card-body">
                            <div class="table-responsive">
                                <table class="table  datanew">
                                    <thead>
                                    <tr>
                                        <th>#</th>
                                        <th>Date</th>
                                        <th>Created By</th>
                                        <th>Unit</th>
                                        <th>OldPrice</th>
                                        <th>New Price</th>
                                    </tr>
                                    </thead>
                                    <tbody>
                                    @foreach($logs as $log)
                                        <tr>
                                            <td>{{$loop->iteration}}</td>
                                            <td>{{$log->created_at->format('Y-m-d')}}</td>

                                            <td>{{$log->user->name}}</td>
                                            <td>{{$log->unit->name}}</td>
                                            <td>{{$log->old_price}} $</td>
                                            <td>{{$log->new_price}} $</td>
                                        </tr>
                                    @endforeach
                                    </tbody>
                                </table>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            {{--logs--}}
            <div class="page-header">
                <div class="page-title">
                    <h4>Product Stock Logs</h4>
                    <h6>Full details of a product Stock Log</h6>
                </div>
            </div>
            {{--logs--}}
            <div class="row">
                <div class="col-lg-12 col-sm-12">
                    <div class="card">
                        <div class="card-body">
                            <div class="table-responsive">
                                <table class="table  datanew">
                                    <thead>
                                    <tr>
                                        <th>#</th>
                                        <th>Date</th>
                                        <th>Created By</th>
                                        <th>Unit</th>
                                        <th>OldStock</th>
                                        <th>NewStock</th>
                                    </tr>
                                    </thead>
                                    <tbody>
                                    @foreach($stock_logs as $stock)
                                        <tr>
                                            <td>{{$loop->iteration}}</td>
                                            <td>{{$stock->created_at->format('Y-m-d')}}</td>

                                            <td>{{$stock->user->name}}</td>
                                            <td>{{$stock->unit->name}}</td>
                                            <td>{{$stock->old_stock}} </td>
                                            <td>{{$stock->new_stock}} </td>
                                        </tr>
                                    @endforeach
                                    </tbody>
                                </table>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <div class="row">
                <div class="col-xl-6">
                    <div class="card custom-card">
                        <div class="card-header">
                            <div class="card-title text-capitalize">Purchase Details</div>
                        </div>
                        <div class="card-body">
                            <div id="column-basic"></div>
                        </div>
                    </div>
                </div>
                <div class="col-xl-6">
                    <div class="card custom-card">
                        <div class="card-header">
                            <div class="card-title text-capitalize">Logs Details</div>
                        </div>
                        <div class="card-body">
                            <div id="line-chart"></div>
                        </div>
                    </div>
                </div>
            </div>
    </div>
@endsection

@section('js')
    <script>
        var chartPrice =  @json($total);
        var date = @json($dates);
        var priceLogs = @json($priceLogs);
        var lineDate = @json($lineDate);
    </script>
    <script src="{{asset('assets/dashboard/plugins/owlcarousel/owl.carousel.min.js')}}"></script>
    <script src="{{asset('assets/dashboard/js/dashboard/product/report.js')}}"></script>
@endsection
