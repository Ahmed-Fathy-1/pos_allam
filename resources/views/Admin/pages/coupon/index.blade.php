@extends('Admin.layouts.master')
@section('title') Coupon @endsection
@section('css')
    <!-- Color Picker Css -->
    <link rel="stylesheet" href="{{asset('assets/dashboard/flatpickr/flatpickr.min.css')}}">
    <link rel="stylesheet" href="{{asset('assets/dashboard/@simonwep/pickr/themes/nano.min.css')}}">
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
        <div class="page-header">
            <div class="page-title">
                <h4>Coupons list</h4>
            </div>
            @can('create_coupon')
            <div class="page-btn">
                <a class="btn btn-added" data-bs-toggle="modal" data-bs-target="#create">
                    <img src="{{asset('assets/dashboard/img/icons/plus.svg')}}"
                      class="me-2" alt="img">
                    Add New Coupon
                </a>
                {{-- create Banner--}}
                <div class="modal fade" id="create" tabindex="-1" aria-labelledby="create"
                     aria-hidden="true">
                    <div class="modal-dialog modal-lg modal-dialog-centered" role="document">
                        <div class="modal-content">
                            <div class="modal-header">
                                <h5 class="modal-title" >New Coupon</h5>
                                <button type="button" class="close" data-bs-dismiss="modal" aria-label="Close">
                                    <span aria-hidden="true">×</span>
                                </button>
                            </div>
                            <form method="POST" action="{{route('coupon-store')}}">
                                @csrf
                                <div class="modal-body">
                                    <div class="row">
                                        <div class="col-lg-6 col-sm-12 col-12">
                                            <div class="form-group">
                                                <label>Code</label>
                                                <input type="text" name="code" required placeholder="Enter code of coupon" >
                                                @error('code')
                                                <p class="text-danger">{{$message}}</p>
                                                @enderror
                                            </div>
                                        </div>
                                        <div class="col-lg-6 col-sm-12 col-12">
                                            <div class="form-group">
                                                <label>Limit</label>
                                                <input type="number" class="form-control" name="limit" required
                                                       placeholder="Enter limit number of usage coupon" min="1" >
                                                @error('limit')
                                                <p class="text-danger">{{$message}}</p>
                                                @enderror
                                            </div>
                                        </div>

                                        <div class="col-lg-6 col-sm-12 col-12">
                                            <div class="form-group">
                                                <label>Start At </label>
                                                <input type="text" class="form-control" id="datetime" name="start_at" required
                                                       placeholder="Choose Coupon Start DateTime">
                                                @error('start_at')
                                                <p class="text-danger">{{$message}}</p>
                                                @enderror
                                            </div>
                                        </div>
                                        <div class="col-lg-6 col-sm-12 col-12">
                                            <div class="form-group">
                                                <label>End At </label>
                                                <input type="text" class="form-control" id="datetime" name="end_at" required
                                                       placeholder="Choose Coupon Start DateTime">
                                                @error('end_at')
                                                <p class="text-danger">{{$message}}</p>
                                                @enderror
                                            </div>
                                        </div>
                                        <div class="col-lg-6 col-sm-12 col-12">
                                            <div class="form-group">
                                                <label>Discount Percentage</label>
                                                <input type="number" name="discount" required class="form-control"
                                                       placeholder="Enter Discount Percentage of Coupon" min="1" >
                                                @error('discount')
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
            @endcan
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
                                <th>Code</th>
                                <th>Limit</th>
                                <th>N.Usage</th>
                                <th>Discount</th>
                                <th>Start</th>
                                <th>End</th>
                                <th>Status</th>
                                <th>Actions</th>
                            </tr>
                            </thead>
                            <tbody>
                            @foreach($coupons as $coupon)
                                <tr>
                                    <td>{{$loop->iteration}}</td>
                                    <td class="text-center">{{$coupon->code}}</td>
                                    <td>
                                        <div class="text-wrap text-center">
                                            {{$coupon->limit}}
                                        </div>
                                    </td>
                                    <td>
                                        <div class="text-wrap text-center">
                                            {{$coupon->n_usage}}
                                        </div>
                                    </td>
                                    <td>
                                        <div class="text-wrap text-center">
                                            {{$coupon->discount}} %
                                        </div>
                                    </td>
                                    <td>
                                        <div class="text-wrap text-center">
                                            {{\Carbon\Carbon::parse($coupon->start_at)->format('Y-m-d H:m')}}
                                        </div>
                                    </td>
                                    <td>
                                        <div class="text-wrap text-center">
                                            {{\Carbon\Carbon::parse($coupon->end_at)->format('Y-m-d H:m')}}
                                        </div>
                                    </td>
                                    <td class="text-capitalize text-center">
                                        @if($coupon->status == 1)
                                            <span class="badge bg-success">Active</span>
                                        @else
                                            <span class="badge bg-danger">Inactive</span>
                                        @endif
                                    </td>
                                    <td>
                                        @can('edit_coupon')
                                        <a class="me-3" data-bs-toggle="modal" data-bs-target="#edit{{$coupon->id}}" >
                                            <img src="{{asset('assets/dashboard/img/icons/edit.svg')}}" alt="img">
                                        </a>
                                        @endcan
                                        @can('delete_coupon')
                                        <a class="me-3" data-bs-toggle="modal" data-bs-target="#delete{{$coupon->id}}">
                                            <img src="{{asset('assets/dashboard/img/icons/delete.svg')}}" alt="img">
                                        </a>
                                        @endcan
                                        {{-- model Edit Banners--}}
                                        <div class="modal fade" id="edit{{$coupon->id}}" tabindex="-1" aria-labelledby="edit{{$coupon->id}}"
                                             aria-hidden="true">
                                            <div class="modal-dialog modal-lg modal-dialog-centered" role="document">
                                                <div class="modal-content">
                                                    <div class="modal-header" style="background-color: #FF9F43;">
                                                        <h5 class="modal-title text-white" >Edit Category</h5>
                                                        <button type="button" class="close" data-bs-dismiss="modal" aria-label="Close">
                                                            <span aria-hidden="true">×</span>
                                                        </button>
                                                    </div>
                                                    <form method="POST" action="{{route('coupon-update',$coupon->id)}}" enctype="multipart/form-data">
                                                        @csrf
                                                        @method('PUT')
                                                        <div class="modal-body">
                                                            <div class="row">
                                                                <div class="col-lg-6 col-sm-12 col-12">
                                                                    <div class="form-group">
                                                                        <label>Code</label>
                                                                        <input type="text" name="code" value="{{$coupon->code}}" required placeholder="Enter code of coupon" >
                                                                        @error('code')
                                                                        <p class="text-danger">{{$message}}</p>
                                                                        @enderror
                                                                    </div>
                                                                </div>
                                                                <div class="col-lg-6 col-sm-12 col-12">
                                                                    <div class="form-group">
                                                                        <label>Limit</label>
                                                                        <input type="number" class="form-control" name="limit" required
                                                                               placeholder="Enter limit number of usage coupon" min="1" value="{{$coupon->limit}}" >
                                                                        @error('limit')
                                                                        <p class="text-danger">{{$message}}</p>
                                                                        @enderror
                                                                    </div>
                                                                </div>

                                                                <div class="col-lg-6 col-sm-12 col-12">
                                                                    <div class="form-group">
                                                                        <label>Start At </label>
                                                                        <input type="text" class="form-control" id="datetime" value="{{$coupon->start_at}}"
                                                                               name="start_at" required
                                                                               placeholder="Choose Coupon Start DateTime">
                                                                        @error('start_at')
                                                                        <p class="text-danger">{{$message}}</p>
                                                                        @enderror
                                                                    </div>
                                                                </div>
                                                                <div class="col-lg-6 col-sm-12 col-12">
                                                                    <div class="form-group">
                                                                        <label>End At </label>
                                                                        <input type="text" class="form-control" id="datetime"  value="{{$coupon->end_at}}"
                                                                               name="end_at" required
                                                                               placeholder="Choose Coupon Start DateTime">
                                                                        @error('end_at')
                                                                        <p class="text-danger">{{$message}}</p>
                                                                        @enderror
                                                                    </div>
                                                                </div>
                                                                <div class="col-lg-6 col-12">
                                                                    <div class="form-group">
                                                                        <label>Discount Percentage</label>
                                                                        <input type="number" name="discount" required class="form-control"
                                                                               placeholder="Enter Discount Percentage of Coupon" value="{{$coupon->discount}}"
                                                                               min="1" >
                                                                        @error('discount')
                                                                        <p class="text-danger">{{$message}}</p>
                                                                        @enderror
                                                                    </div>
                                                                </div>
                                                                <div class="col-lg-6  col-12">
                                                                    <div class="form-group">
                                                                        <label>Status</label>
                                                                        <select class="select form-select" name="status" required>
                                                                            <option selected disabled>Choose Status</option>
                                                                            <option value="1" @if($coupon->status == 1) selected @endif>Active</option>
                                                                            <option value="0" @if($coupon->status == 0) selected @endif>InActive</option>
                                                                        </select>
                                                                        @error('status')
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

                                        {{-- model Delete --}}
                                        <div class="modal fade" id="delete{{$coupon->id}}" tabindex="-1"    aria-hidden="true">
                                            <div class="modal-dialog modal-dialog-centered" role="document">
                                                <div class="modal-content">
                                                    <div class="modal-header" style="background-color: #FF9F43;">
                                                        <h5 class="modal-title text-white" >Delete Banner</h5>
                                                        <button type="button" class="close" data-bs-dismiss="modal" aria-label="Close">
                                                            <span aria-hidden="true">×</span>
                                                        </button>
                                                    </div>
                                                    <form method="POST" action="{{route('category-delete',$coupon->id)}}">
                                                        @csrf
                                                        @method('DELETE')
                                                        <div class="modal-body">
                                                            <div class="delete-order">
                                                                <img src="{{asset('assets/dashboard/img/icons/close-circle1.svg')}}" alt="img">
                                                            </div>
                                                            <div class="para-set text-center">
                                                                <p>Are You Sure Delete Category</p>
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
            </div>
        </div>
        <!-- /product list -->
    </div>
@endsection
@section('js')
    <!-- Date & Time Picker JS -->
    <script src="{{asset('assets/dashboard/flatpickr/flatpickr.min.js')}}"></script>
    <script src="{{asset('assets/dashboard/js/date&time_pickers.js')}}"></script>
@endsection
