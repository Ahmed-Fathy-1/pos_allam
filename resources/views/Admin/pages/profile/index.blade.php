@extends('Admin.layouts.master')
@section('title') Profile @endsection
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
                <h4>Profile</h4>
                <h6>User Profile</h6>
            </div>
        </div>
        <!-- /product list -->
        <div class="card">
            <div class="card-body">
                <form method="POST" action="{{route('admin-data-update')}}" enctype="multipart/form-data">
                    @csrf
                    <div class="profile-set">
                        <div class="profile-head">

                        </div>
                        <div class="profile-top">
                            <div class="profile-content">
                                <div class="profile-contentimg">
                                    @if($user->image != null)

                                        <img src="{{asset('storage/employee/'.$user->image)}}" alt="img" id="blah">
                                    @else
                                        <img src="{{asset('storage/employee/100x100.png')}}" alt="img" id="blah">
                                    @endif
                                    <div class="profileupload">
                                        <input type="file" id="imgInp" name="image">
                                        <a href="javascript:void(0);" ><img src="{{asset('assets/dashboard/img/icons/edit-set.svg')}}"  alt="img"></a>
                                    </div>
                                </div>
                                <div class="profile-contentname">
                                    <h2>{{auth()->user()->name}}</h2>
                                    <h4>Updates Your Photo and Personal Details.</h4>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="row">
                        <div class="col-lg-6 col-sm-12">
                            <div class="form-group">
                                <label>First Name</label>
                                <input type="text" placeholder="Your Name" name="name" value="{{$user->name}}">
                            </div>
                        </div>
                        <div class="col-lg-6 col-sm-12">
                            <div class="form-group">
                                <label>Email</label>
                                <input type="email" class="form-control" name="email" placeholder="Your Email Address" value="{{$user->email}}">
                            </div>
                        </div>
                        <div class="col-lg-6 col-sm-12">
                            <div class="form-group">
                                <label>Mobile</label>
                                <input type="text"  placeholder="Your Mobile Number" name="mobile" value="{{$user->mobile}}">
                            </div>
                        </div>
                        <div class="col-12">
                            <button class="btn btn-submit me-2" type="submit">Submit</button>
                        </div>
                    </div>
                </form>
            </div>
        </div>
        <!-- /product list -->
    </div>
@endsection

