@extends('Admin.layouts.master')
@section('main_head')
    <div class="page-title font-medium ">
        <h4> Statements </h4>
    </div>
@endsection
@section('title') Customer - Statement  @endsection
@section('content')
    <div class="content">
        @if ($errors->any())
            <div class="alert alert-info text-center" >
                <ul>
                    @foreach ($errors->all() as $error)
                        <li>{{ $error }}</li>
                    @endforeach
                </ul>
            </div>
        @endif
     {{--   <div class="row">
            <div class="col-lg-6 col-sm-6 col-12 d-flex">
                <div class="dash-count">
                    <div class="dash-counts">
                        <h4>{{count($online_customer)}}</h4>
                        <h5>Online Customer  </h5>
                    </div>
                    <div class="dash-imgs">
                        <i data-feather="user"></i>
                    </div>
                </div>
            </div>
            <div class="col-lg-6 col-sm-6 col-12 d-flex">
                <div class="dash-count das1">
                    <div class="dash-counts">
                        <h4>{{count($cashier_customer)}} </h4>
                        <h5>Cashier Customer </h5>
                    </div>
                    <div class="dash-imgs">
                        <i data-feather="user-check"></i>
                    </div>
                </div>
            </div>
        </div>--}}

       {{-- <div class="card mb-10">
            <div class="card-body">
                <div class="table-top">
                    <div class="search-set">
                        <div class="search-path">
                            <h4>Online  Customers Statement</h4>
                        </div>
                    </div>
                </div>
                <div class="table-responsive">
                    <table class="table  datanew">
                        <thead>
                        <tr>
                            <th>#</th>
                            <th>Date</th>
                            <th>Name</th>
                            <th>Mobile</th>
                            <th>Total Orders </th>
                            <th>Discount</th>
                            <th>Total</th>
                            <th class="text-center">Details</th>
                        </tr>
                        </thead>
                        <tbody>

                        @foreach($online_customer as $user)
                            <tr>
                                <td data-bs-toggle="modal" data-bs-target="#details-order{{$user->id}}">
                                    {{$loop->iteration}}
                                </td>
                                <td  data-bs-toggle="modal" data-bs-target="#details-order{{$user->id}}">
                                    @if($user->created_at !=null)
                                        {{$user->created_at->format('Y-m-d')}}
                                    @else {{now()->format('y-m-d')}}
                                    @endif</td>
                                <td data-bs-toggle="modal" data-bs-target="#details-order{{$user->id}}">
                                  {{$user->name}}
                                </td>
                                <td data-bs-toggle="modal" data-bs-target="#details-order{{$user->id}}">
                                    {{$user->mobile}}
                                </td>
                                @php
                                    $orderOnline = \App\Models\Order::whereMobile($user->mobile)->get();
                                @endphp
                                <td data-bs-toggle="modal" data-bs-target="#details-order{{$user->id}}">
                                    {{$orderOnline->count()}}
                                </td>
                                <td data-bs-toggle="modal" data-bs-target="#details-order{{$user->id}}">
                                    {{$orderOnline->sum('total_discount')}} $
                                </td>
                                <td data-bs-toggle="modal" data-bs-target="#details-order{{$user->id}}">
                                    {{$orderOnline->sum('total')}} $
                                </td>
                                <td>
                                    <div class="d-flex justify-content-center gap-2">
                                        <div>
                                            <a href="{{route('invoice-show',['id' => $user->mobile, 'type' => 'user'])}}"
                                               class="btn btn-sm btn-primary text-white hover:none">
                                                Report
                                            </a>
                                        </div>
                                    </div>
                                </td>
                            </tr>
                        @endforeach
                        </tbody>
                    </table>
                </div>
            </div>
        </div>--}}

        <div class="card mb-0">
            <div class="card-body">
                <div class="table-responsive">
                    <table class="table  datanew">
                        <thead>
                        <tr>
                            <th>#</th>
                            <th>Date</th>
                            <th>Name</th>
                            <th>Mobile</th>
                            <th>Balance</th>
                            <th>Total Orders </th>
                            <th>Total</th>
                            <th>Paid</th>
                            <th>UnPaid</th>
                            <th class="text-center">Details</th>
                        </tr>
                        </thead>
                        <tbody>
                        @foreach($cashier_customer as $customer)
                            <tr>
                                <td data-bs-toggle="modal" data-bs-target="#details-order{{$customer->id}}">
                                    {{$loop->iteration}}
                                </td>
                                <td  data-bs-toggle="modal" data-bs-target="#details-order{{$customer->id}}">
                                    {{$customer->created_at->format('Y-m-d')}}</td>
                                <td data-bs-toggle="modal" data-bs-target="#details-order{{$customer->id}}">
                                    {{$customer->name}}
                                </td>
                                <td data-bs-toggle="modal" data-bs-target="#details-order{{$customer->id}}">
                                    {{$customer->mobile}}
                                </td>
                                <td data-bs-toggle="modal" data-bs-target="#details-order{{$customer->id}}">
                                    ${{$customer->balance}}
                                </td>
                                <td data-bs-toggle="modal" data-bs-target="#details-order{{$customer->id}}">
                                    {{$customer->orders()->count()}}
                                </td>
                                <td data-bs-toggle="modal" data-bs-target="#details-order{{$customer->id}}">
                                    ${{$customer->orders()->sum('total')}}
                                </td>
                                <td data-bs-toggle="modal" data-bs-target="#details-order{{$customer->id}}">
                                    ${{$customer->orders()->sum('amount_paid')}}
                                </td>
                                <td data-bs-toggle="modal" data-bs-target="#details-order{{$customer->id}}">
                                    ${{$customer->orders()->where('status',0)->sum('total') + $customer->orders()->where('status','!=',0)->sum('remaining_amount')}}
                                </td>
                                <td>
                                    <div class="d-flex justify-content-center gap-2">
                                      {{--  <div>
                                            <a class="btn btn-sm btn-info text-white hover:none"
                                               data-bs-toggle="modal" data-bs-target="#create{{$customer->id}}">
                                                Add Address
                                            </a>
                                        </div>--}}
                                        <div>
                                            <a href="{{route('invoice-show',['id' => $customer->id, 'type' => 'customer'])}}"
                                               class="btn btn-sm btn-primary text-white hover:none">
                                                Statement
                                            </a>
                                        </div>
                                    </div>
                                        {{-- New Address--}}
{{--
                                    <div class="modal fade" id="create{{$customer->id}}" tabindex="-1" aria-labelledby="create{{$customer->id}}"
                                         aria-hidden="true">
                                        <div class="modal-dialog modal-lg modal-dialog-centered" role="document">
                                            <div class="modal-content">
                                                <div class="modal-header" style="background-color: #FF9F43;" >
                                                    <h5 class="modal-title text-white" >New Address To {{$customer->name}}</h5>
                                                    <button type="button" class="close" data-bs-dismiss="modal" aria-label="Close">
                                                        <span aria-hidden="true">×</span>
                                                    </button>
                                                </div>
                                                <form method="POST" action="{{route('another-customer-address',$customer->id)}}" >
                                                    @csrf
                                                    <div class="modal-body">
                                                        <div class="row">
                                                            <div class="col-lg-6 col-sm-12 col-12">
                                                                <div class="form-group">
                                                                    <label>State</label>
                                                                    <input type="text" name="state" required  placeholder="Enter Customer  Address State" >
                                                                    @error('state')
                                                                    <p class="text-danger">{{$message}}</p>
                                                                    @enderror
                                                                </div>
                                                            </div>
                                                            <div class="col-lg-6 col-sm-12 col-12">
                                                                <div class="form-group">
                                                                    <label> City</label>
                                                                    <input type="text" class="form-control" required name="city"
                                                                           placeholder="Enter Customer Address City ">
                                                                    @error('city')
                                                                    <p class="text-danger">{{$message}}</p>
                                                                    @enderror
                                                                </div>
                                                            </div>
                                                            <div class="col-lg-6 col-sm-12 col-12">
                                                                <div class="form-group">
                                                                    <label>Post Code</label>
                                                                    <input type="text" name="post_code" required
                                                                           placeholder="Enter Customer valued Address Post Code " >
                                                                    @error('post_code')
                                                                    <p class="text-danger">{{$message}}</p>
                                                                    @enderror
                                                                </div>
                                                            </div>
                                                            <div class="col-lg-6 col-sm-12 col-12">
                                                                <div class="form-group">
                                                                    <label>Address Details</label>
                                                                    <input type="text" class="form-control" required name="address"
                                                                           placeholder="Enter customer Address Details">
                                                                    @error('address')
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
--}}

                                </td>
                            </tr>
                        @endforeach
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
    </div>
@endsection

