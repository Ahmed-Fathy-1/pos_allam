@extends('Admin.layouts.master')
@section('main_head')
    <div class="page-title font-medium ">
        <h4> Customers List</h4>
    </div>
@endsection
@section('title') Customers @endsection
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
{{--            <div class="page-header">--}}
{{--                <div class="page-title">--}}
{{--                    <h4>Online Customers List</h4>--}}
{{--                    <h6>Manage your Customers</h6>--}}
{{--                </div>--}}

{{--                <div class="page-btn">--}}
{{--                    <a class="btn btn-added" data-bs-toggle="modal" data-bs-target="#create_online_customer">--}}
{{--                        <img src="{{asset('assets/dashboard/img/icons/plus.svg')}}"--}}
{{--                             class="me-2" alt="img">--}}
{{--                        online Customers--}}
{{--                    </a>--}}

{{--                    <div class="modal fade" id="create_online_customer" tabindex="-1" aria-labelledby="create_online_customer"--}}
{{--                         aria-hidden="true">--}}
{{--                        <div class="modal-dialog modal-lg modal-dialog-centered" role="document">--}}
{{--                            <div class="modal-content">--}}
{{--                                <div class="modal-header" style="background-color: #FF9F43;" >--}}
{{--                                    <h5 class="modal-title text-white" >New Customer</h5>--}}
{{--                                    <button type="button" class="close" data-bs-dismiss="modal" aria-label="Close">--}}
{{--                                        <span aria-hidden="true">×</span>--}}
{{--                                    </button>--}}
{{--                                </div>--}}
{{--                                <form method="POST" action="{{route('store-user')}}" >--}}
{{--                                    @csrf--}}
{{--                                    <div class="modal-body">--}}
{{--                                        <div class="row">--}}
{{--                                            <div class="col-lg-6  col-12">--}}
{{--                                                <div class="form-group">--}}
{{--                                                    <label>Name</label>--}}
{{--                                                    <input type="text" name="name" required  placeholder="Enter Customer Name" value="{{old('name')}}" >--}}
{{--                                                    @error('name')--}}
{{--                                                    <p class="text-danger">{{$message}}</p>--}}
{{--                                                    @enderror--}}
{{--                                                </div>--}}
{{--                                            </div>--}}
{{--                                            <div class="col-lg-6  col-12">--}}
{{--                                                <div class="form-group">--}}
{{--                                                    <label> Mobile</label>--}}
{{--                                                    <input type="text" class="form-control" required name="mobile"  value="{{old('mobile')}}"--}}
{{--                                                           placeholder="Enter Mobile Number">--}}
{{--                                                    @error('mobile')--}}
{{--                                                    <p class="text-danger">{{$message}}</p>--}}
{{--                                                    @enderror--}}
{{--                                                </div>--}}
{{--                                            </div>--}}
{{--                                            <div class="col-lg-6  col-12">--}}
{{--                                                <div class="form-group">--}}
{{--                                                    <label> Email</label>--}}
{{--                                                    <input type="email" class="form-control" required name="email" value="{{old('email')}}"--}}
{{--                                                           placeholder="Enter Customer Email">--}}
{{--                                                    @error('email')--}}
{{--                                                    <p class="text-danger">{{$message}}</p>--}}
{{--                                                    @enderror--}}
{{--                                                </div>--}}
{{--                                            </div>--}}
{{--                                        </div>--}}

{{--                                        <div class="row">--}}
{{--                                            <div class="col-lg-6  col-12">--}}
{{--                                                <div class="form-group">--}}
{{--                                                    <label>password</label>--}}
{{--                                                    <input type="password" name="password" required value="{{old('password')}}"  placeholder="Enter Customer  Password" >--}}
{{--                                                    @error('state')--}}
{{--                                                    <p class="text-danger">{{$message}}</p>--}}
{{--                                                    @enderror--}}
{{--                                                </div>--}}
{{--                                            </div>--}}
{{--                                            <div class="col-lg-6 col-12">--}}
{{--                                                <div class="form-group">--}}
{{--                                                    <label> password Confirmation</label>--}}
{{--                                                    <input type="password" class="form-control" required value="{{old('password_confirmation')}}" name="password_confirmation"--}}
{{--                                                           placeholder="Confirm Customer Password ">--}}
{{--                                                    @error('password_confirmation')--}}
{{--                                                    <p class="text-danger">{{$message}}</p>--}}
{{--                                                    @enderror--}}
{{--                                                </div>--}}
{{--                                            </div>--}}
{{--                                        </div>--}}
{{--                                    </div>--}}
{{--                                    <div class="modal-footer d-flex justify-content-between">--}}
{{--                                        <button class="btn btn-cancel"  type="button" data-bs-dismiss="modal" aria-label="Close">Cancel</button>--}}
{{--                                        <button class="btn btn-submit" type="submit">Submit</button>--}}
{{--                                    </div>--}}
{{--                                </form>--}}
{{--                            </div>--}}
{{--                        </div>--}}
{{--                    </div>--}}
{{--                </div>--}}
{{--            </div>--}}
{{--            <!-- /product list -->--}}
{{--            <div class="card">--}}
{{--                <div class="card-body">--}}
{{--                    <div class="table-responsive">--}}
{{--                        <table class="table  datanew">--}}
{{--                            <thead>--}}
{{--                            <tr>--}}
{{--                                <th>#</th>--}}
{{--                                <th>Data</th>--}}
{{--                                <th>Name</th>--}}
{{--                                <th>Mobile</th>--}}
{{--                                <th>email</th>--}}
{{--                                <th>Action</th>--}}
{{--                            </tr>--}}
{{--                            </thead>--}}
{{--                            <tbody>--}}
{{--                            @foreach($users as $user)--}}
{{--                                <tr>--}}
{{--                                    <td>{{$loop->iteration}}</td>--}}
{{--                                    <td>{{$user->created_at->format('Y-m-d')}} </td>--}}
{{--                                    <td>{{$user->name}}</td>--}}
{{--                                    <td>{{$user->mobile}}</td>--}}
{{--                                    <td>{{$user->email}}</td>--}}
{{--                                    <td>--}}
{{--                                        <a class="me-3" data-bs-toggle="modal" data-bs-target="#edit_user{{$user->id}}">--}}
{{--                                            <img src="{{asset('assets/dashboard/img/icons/edit.svg')}}" alt="img">--}}
{{--                                        </a>--}}

{{--                                        <a class="me-3" data-bs-toggle="modal" data-bs-target="#show_address_user{{$user->id}}" >--}}
{{--                                            <img src="{{asset('assets/dashboard/img/icons/eye.svg')}}" alt="img">--}}
{{--                                        </a>--}}

{{--                                        --}}{{-- Model Edit--}}
{{--                                        <div class="modal fade" id="edit_user{{$user->id}}" tabindex="-1" aria-labelledby="edit_user{{$user->id}}"--}}
{{--                                             aria-hidden="true">--}}
{{--                                            <div class="modal-dialog modal-lg modal-dialog-centered" role="document">--}}
{{--                                                <div class="modal-content">--}}
{{--                                                    <div class="modal-header" style="background-color: #FF9F43;">--}}
{{--                                                        <h5 class="modal-title text-white" >Edit User</h5>--}}
{{--                                                        <button type="button" class="close" data-bs-dismiss="modal" aria-label="Close">--}}
{{--                                                            <span aria-hidden="true">×</span>--}}
{{--                                                        </button>--}}
{{--                                                    </div>--}}
{{--                                                    <form method="POST" action="{{route('update-user',$user->id)}}" enctype="multipart/form-data">--}}
{{--                                                        @csrf--}}
{{--                                                        @method('PUT')--}}
{{--                                                        <input type="hidden" name="id" value="{{$user->id}}">--}}
{{--                                                        <div class="modal-body">--}}
{{--                                                            <div class="row">--}}
{{--                                                                <div class="col-lg-6 col-sm-6 col-12">--}}
{{--                                                                    <div class="form-group">--}}
{{--                                                                        <label>user Name</label>--}}
{{--                                                                        <input type="text" name="name" value="{{$user->name}}"--}}
{{--                                                                               required placeholder="Enter User Name">--}}
{{--                                                                        @error('name')--}}
{{--                                                                        <p class="text-danger">{{$message}}</p>--}}
{{--                                                                        @enderror--}}
{{--                                                                    </div>--}}
{{--                                                                </div>--}}
{{--                                                                <div class="col-lg-6 col-sm-6 col-12">--}}
{{--                                                                    <div class="form-group">--}}
{{--                                                                        <label>Email</label>--}}
{{--                                                                        <input type="email"  name="email"  value="{{$user->email}}"--}}
{{--                                                                               class="form-control" required placeholder="Enter User Email">--}}
{{--                                                                        @error('email')--}}
{{--                                                                        <p class="text-danger">{{$message}}</p>--}}
{{--                                                                        @enderror--}}
{{--                                                                    </div>--}}
{{--                                                                </div>--}}

{{--                                                                <div class="col-lg-6 col-sm-6 col-12">--}}
{{--                                                                    <div class="form-group">--}}
{{--                                                                        <label>Mobile</label>--}}
{{--                                                                        <input type="text" name="mobile" value="{{$user->mobile}}" required placeholder="Enter Mobile Number">--}}
{{--                                                                        @error('mobile')--}}
{{--                                                                        <p class="text-danger">{{$message}}</p>--}}
{{--                                                                        @enderror--}}
{{--                                                                    </div>--}}
{{--                                                                </div>--}}
{{--                                                            </div>--}}
{{--                                                        </div>--}}
{{--                                                        <div class="modal-footer d-flex justify-content-between">--}}
{{--                                                            <button class="btn btn-cancel" type="button" data-bs-dismiss="modal">Cancel</button>--}}
{{--                                                            <button class="btn btn-submit" type="submit">Submit</button>--}}
{{--                                                        </div>--}}
{{--                                                    </form>--}}
{{--                                                </div>--}}
{{--                                            </div>--}}
{{--                                        </div>--}}
{{--                                        --}}{{-- Model Show Address--}}
{{--                                        <div class="modal fade" id="show_address_user{{$user->id}}" tabindex="-1" aria-labelledby="show_address_user{{$user->id}}"--}}
{{--                                             aria-hidden="true">--}}
{{--                                            <div class="modal-dialog modal-lg modal-dialog-centered" role="document">--}}
{{--                                                <div class="modal-content">--}}
{{--                                                    <div class="modal-header" style="background-color: #FF9F43;">--}}
{{--                                                        <h5 class="modal-title text-white" >Address Customer</h5>--}}
{{--                                                        <button type="button" class="close" data-bs-dismiss="modal" aria-label="Close">--}}
{{--                                                            <span aria-hidden="true">×</span>--}}
{{--                                                        </button>--}}
{{--                                                    </div>--}}

{{--                                                        <div class="modal-body">--}}
{{--                                                            <div class="row">--}}
{{--                                                                @foreach($user->addresses as $address)--}}
{{--                                                                <div class="col-lg-12  col-12 mb-3">--}}
{{--                                                                   <p> {{$loop->iteration}} - {{$address->address .",". $address->city .",".$address->state. ",".$address->post_code}}</p>--}}
{{--                                                                </div>--}}
{{--                                                                @endforeach--}}
{{--                                                            </div>--}}
{{--                                                        </div>--}}
{{--                                                        <div class="modal-footer d-flex justify-content-end">--}}
{{--                                                            <button class="btn btn-cancel" type="button" data-bs-dismiss="modal">Cancel</button>--}}
{{--                                                        </div>--}}
{{--                                                </div>--}}
{{--                                            </div>--}}
{{--                                        </div>--}}

{{--                                    </td>--}}
{{--                                </tr>--}}
{{--                            @endforeach--}}
{{--                            </tbody>--}}
{{--                        </table>--}}
{{--                    </div>--}}
{{--                </div>--}}
{{--            </div>--}}




        <!-- /product list -->
        <div class="card">
            <div class="card-body">
                <div class="page-header d-flex justify-content-start">

                    <a class="btn btn-added" data-bs-toggle="modal" data-bs-target="#create">
                        <img src="{{asset('assets/dashboard/img/icons/plus.svg')}}"
                             class="me-2" alt="img">
                        Add New Customer
                    </a>
                    {{-- create Customer --}}
                    <div class="modal fade" id="create" tabindex="-1" aria-labelledby="create"
                         aria-hidden="true">
                        <div class="modal-dialog modal-lg modal-dialog-centered" role="document">
                            <div class="modal-content">
                                <div class="modal-header" style="background-color: #FF9F43;" >
                                    <h5 class="modal-title text-white" >New Customer</h5>
                                    <button type="button" class="close" data-bs-dismiss="modal" aria-label="Close">
                                        <span aria-hidden="true">×</span>
                                    </button>
                                </div>
                                <form method="POST" action="{{route('store-customer')}}" >
                                    @csrf
                                    <div class="modal-body">
                                        <div class="row">
                                            <div class="col-lg-6 col-12">
                                                <div class="form-group">
                                                    <label>Name</label>
                                                    <input type="text" name="name" required value="{{old('name')}}"
                                                           placeholder="Enter Customer Name" >
                                                    @error('name')
                                                    <p class="text-danger">{{$message}}</p>
                                                    @enderror
                                                </div>
                                            </div>
                                            <div class="col-lg-6 col-12">
                                                <div class="form-group">
                                                    <label> A.B.N</label>
                                                    <input type="text" class="form-control"  name="abn" value="{{old('abn')}}"
                                                           placeholder="Enter  A.B.N Number of Business">
                                                    @error('abn')
                                                    <p class="text-danger">{{$message}}</p>
                                                    @enderror
                                                </div>
                                            </div>
                                            <div class="col-lg-6 col-12">
                                                <div class="form-group">
                                                    <label> Phone</label>
                                                    <input type="text" class="form-control" required name="mobile" value="{{old('mobile')}}"
                                                           placeholder="Enter Mobile Number">
                                                    @error('mobile')
                                                    <p class="text-danger">{{$message}}</p>
                                                    @enderror
                                                </div>
                                            </div>
                                        </div>

                                        <div class="row">
                                            <div class="col-lg-6  col-12">
                                                <div class="form-group">
                                                    <label>State</label>
                                                    <input type="text" name="state" required  value="{{old('state')}}"
                                                           placeholder="Enter Customer  Address State" >
                                                    @error('state')
                                                    <p class="text-danger">{{$message}}</p>
                                                    @enderror
                                                </div>
                                            </div>
                                            <div class="col-lg-6 col-12">
                                                <div class="form-group">
                                                    <label> City</label>
                                                    <input type="text" class="form-control" required name="city" value="{{old('city')}}"
                                                           placeholder="Enter Customer Address City ">
                                                    @error('city')
                                                    <p class="text-danger">{{$message}}</p>
                                                    @enderror
                                                </div>
                                            </div>
                                            <div class="col-lg-6 col-12">
                                                <div class="form-group">
                                                    <label>Post Code</label>
                                                    <input type="text" name="post_code" required value="{{old('post_code')}}"
                                                           placeholder="Enter Customer valued Address Post Code " >
                                                    @error('post_code')
                                                    <p class="text-danger">{{$message}}</p>
                                                    @enderror
                                                </div>
                                            </div>
                                            <div class="col-lg-6 col-12">
                                                <div class="form-group">
                                                    <label>Address Details</label>
                                                    <input type="text" class="form-control" required name="address"  value="{{old('address')}}"
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
                </div>
                <div class="table-responsive">
                    <table class="table  datanew">
                        <thead>
                        <tr>
                            <th>#</th>
                            <th>Data</th>
                            <th>Name</th>
                            <th>Mobile</th>
                            <th>A.B.N </th>
                            <th>Balance</th>
                            <th>Action</th>
                        </tr>
                        </thead>
                        <tbody>
                        @foreach($customers as $customer)
                            <tr>
                                <td>{{$loop->iteration}}</td>
                                <td>{{$customer->created_at->format('d-m-Y')}} </td>
                                <td>{{$customer->name}}</td>
                                <td>{{$customer->mobile}}</td>
                                <td>{{$customer->abn}}</td>
                                <td>${{$customer->balance}}</td>

                                <td>
                                    <a  class="btn btn-sm btn-primary text-white hover:none"
                                        href="{{route('customer-profile',$customer->id)}}">
                                       Profile
                                    </a>
                                    <a class="me-3" data-bs-toggle="modal" data-bs-target="#edit_customer{{$customer->id}}">
                                        <img src="{{asset('assets/dashboard/img/icons/edit.svg')}}" alt="img">
                                    </a>

                                 {{--   <a class="me-3" data-bs-toggle="modal" data-bs-target="#show_address_customer{{$customer->id}}" >
                                        <img src="{{asset('assets/dashboard/img/icons/eye.svg')}}" alt="img">
                                    </a>--}}
                                    <a class="me-3" data-bs-toggle="modal" data-bs-target="#delete_customer{{$customer->id}}">
                                        <img src="{{asset('assets/dashboard/img/icons/delete.svg')}}" alt="img">
                                    </a>



                                    {{-- delete customer--}}
                                    <div class="modal fade" id="delete_customer{{$customer->id}}" tabindex="-1"  aria-hidden="true">
                                        <div class="modal-dialog modal-dialog-centered" role="document">
                                            <div class="modal-content">
                                                <div class="modal-header" style="background-color: #FF9F43;" >
                                                    <h5 class="modal-title text-white" >Delete Customer</h5>
                                                    <button type="button" class="close" data-bs-dismiss="modal" aria-label="Close">
                                                        <span aria-hidden="true">×</span>
                                                    </button>
                                                </div>
                                                <form method="POST" action="{{route('delete-customer',$customer->id)}}">
                                                    @csrf
                                                    @method('DELETE')
                                                    <div class="modal-body">
                                                        <div class="delete-order">
                                                            <img src="{{asset('assets/dashboard/img/icons/close-circle1.svg')}}" alt="img">
                                                        </div>
                                                        <div class="para-set text-center">
                                                            <p>Delete Customer With Related Information</p>
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

                                    {{-- Model Edit--}}
                                    <div class="modal fade" id="edit_customer{{$customer->id}}" tabindex="-1" aria-labelledby="edit_customer{{$customer->id}}"
                                         aria-hidden="true">
                                        <div class="modal-dialog modal-lg modal-dialog-centered" role="document">
                                            <div class="modal-content">
                                                <div class="modal-header" style="background-color: #FF9F43;">
                                                    <h5 class="modal-title text-white" >Edit Customer</h5>
                                                    <button type="button" class="close" data-bs-dismiss="modal" aria-label="Close">
                                                        <span aria-hidden="true">×</span>
                                                    </button>
                                                </div>
                                                <form method="POST" action="{{route('update-customer',$customer->id)}}" enctype="multipart/form-data">
                                                    @csrf
                                                    @method('PUT')
                                                    <input type="hidden" name="id" value="{{$customer->id}}">
                                                    <div class="modal-body">
                                                        <div class="row">
                                                            <div class="col-lg-6 col-sm-6 col-12">
                                                                <div class="form-group">
                                                                    <label> Name</label>
                                                                    <input type="text" name="name" value="{{$customer->name}}"
                                                                           required placeholder="Enter User Name">
                                                                    @error('name')
                                                                    <p class="text-danger">{{$message}}</p>
                                                                    @enderror
                                                                </div>
                                                            </div>

                                                            <div class="col-lg-6 col-12">
                                                                <div class="form-group">
                                                                    <label> A.B.N</label>
                                                                    <input type="text" class="form-control"  name="abn" value="{{$customer->abn}}"
                                                                           placeholder="Enter  A.B.N Number of Business">
                                                                    @error('abn')
                                                                    <p class="text-danger">{{$message}}</p>
                                                                    @enderror
                                                                </div>
                                                            </div>

                                                            <div class="col-lg-6 col-sm-6 col-12">
                                                                <div class="form-group">
                                                                    <label>Mobile</label>
                                                                    <input type="text" name="mobile" value="{{$customer->mobile}}" required placeholder="Enter Mobile Number">
                                                                    @error('mobile')
                                                                    <p class="text-danger">{{$message}}</p>
                                                                    @enderror
                                                                </div>
                                                            </div>
                                                            <div class="row">
                                                                <div class="col-lg-6 col-sm-12 col-12">
                                                                    <div class="form-group">
                                                                        <label>State</label>
                                                                        <input type="text" name="state" required value="{{$customer->addresses()->latest('id')->value('state')}}"
                                                                               placeholder="Enter Customer  Address State" >
                                                                        @error('state')
                                                                        <p class="text-danger">{{$message}}</p>
                                                                        @enderror
                                                                    </div>
                                                                </div>
                                                                <div class="col-lg-6 col-sm-12 col-12">
                                                                    <div class="form-group">
                                                                        <label> City</label>
                                                                        <input type="text" class="form-control" required name="city"  value="{{$customer->addresses()->latest('id')->value('city')}}"
                                                                               placeholder="Enter Customer Address City ">
                                                                        @error('city')
                                                                        <p class="text-danger">{{$message}}</p>
                                                                        @enderror
                                                                    </div>
                                                                </div>
                                                                <div class="col-lg-6 col-sm-12 col-12">
                                                                    <div class="form-group">
                                                                        <label>Post Code</label>
                                                                        <input type="text" name="post_code" required  value="{{$customer->addresses()->latest('id')->value('post_code')}}"
                                                                               placeholder="Enter Customer valued Address Post Code " >
                                                                        @error('post_code')
                                                                        <p class="text-danger">{{$message}}</p>
                                                                        @enderror
                                                                    </div>
                                                                </div>
                                                                <div class="col-lg-6 col-sm-12 col-12">
                                                                    <div class="form-group">
                                                                        <label>Address Details</label>
                                                                        <input type="text" class="form-control" required name="address"  value="{{$customer->addresses()->latest('id')->value('address')}}"
                                                                               placeholder="Enter customer Address Details">
                                                                        @error('address')
                                                                        <p class="text-danger">{{$message}}</p>
                                                                        @enderror
                                                                    </div>
                                                                </div>
                                                        </div>
                                                    </div>
                                                    <div class="modal-footer d-flex justify-content-between">
                                                        <button class="btn btn-cancel" type="button" data-bs-dismiss="modal">Cancel</button>
                                                        <button class="btn btn-submit" type="submit">Submit</button>
                                                    </div>
                                                </form>
                                            </div>
                                        </div>
                                    </div>

                                  {{--  --}}{{-- Model Show Address--}}{{--
                                    <div class="modal fade" id="show_address_customer{{$customer->id}}" tabindex="-1"
                                         aria-labelledby="show_address_customer{{$customer->id}}"
                                         aria-hidden="true">
                                        <div class="modal-dialog modal-lg modal-dialog-centered" role="document">
                                            <div class="modal-content">
                                                <div class="modal-header" style="background-color: #FF9F43;">
                                                    <h5 class="modal-title text-white" >Address Customer</h5>
                                                    <button type="button" class="close" data-bs-dismiss="modal" aria-label="Close">
                                                        <span aria-hidden="true">×</span>
                                                    </button>
                                                </div>

                                                <div class="modal-body">
                                                    <div class="row">
                                                        @foreach($customer->addresses as $address)
                                                            <div class="col-lg-12  col-12 mb-3">
                                                                <p> {{$loop->iteration}} - {{$address->address .",". $address->city .",".$address->state. ",".$address->post_code}}</p>
                                                            </div>
                                                        @endforeach
                                                    </div>
                                                </div>
                                                <div class="modal-footer d-flex justify-content-end">
                                                    <button class="btn btn-cancel" type="button" data-bs-dismiss="modal">Cancel</button>
                                                </div>
                                            </div>
                                        </div>
                                    </div>--}}

                                    {{-- New Address--}}
{{--
                                    <div class="modal fade" id="create_customer_address{{$customer->id}}" tabindex="-1" aria-labelledby="create_customer_address{{$customer->id}}"
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
                                                    <input type="hidden" name="type" value="customer">
                                                    <div class="modal-body">
                                                        <div class="row">
                                                            <div class="col-lg-6 col-sm-12 col-12">
                                                                <div class="form-group">
                                                                    <label>State</label>
                                                                    <input type="text" name="state" required   value="{{old('state')}}"
                                                                           placeholder="Enter Customer  Address State" >
                                                                    @error('state')
                                                                    <p class="text-danger">{{$message}}</p>
                                                                    @enderror
                                                                </div>
                                                            </div>
                                                            <div class="col-lg-6 col-sm-12 col-12">
                                                                <div class="form-group">
                                                                    <label> City</label>
                                                                    <input type="text" class="form-control" required name="city" value="{{old('city')}}"
                                                                           placeholder="Enter Customer Address City ">
                                                                    @error('city')
                                                                    <p class="text-danger">{{$message}}</p>
                                                                    @enderror
                                                                </div>
                                                            </div>
                                                            <div class="col-lg-6 col-sm-12 col-12">
                                                                <div class="form-group">
                                                                    <label>Post Code</label>
                                                                    <input type="text" name="post_code" required value="{{old('post_code')}}"
                                                                           placeholder="Enter Customer valued Address Post Code " >
                                                                    @error('post_code')
                                                                    <p class="text-danger">{{$message}}</p>
                                                                    @enderror
                                                                </div>
                                                            </div>
                                                            <div class="col-lg-6 col-sm-12 col-12">
                                                                <div class="form-group">
                                                                    <label>Address Details</label>
                                                                    <input type="text" class="form-control" required name="address" value="{{old('address')}}"
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
        <!-- /product list -->
    </div>
@endsection

