@extends('Admin.layouts.master')
@section('title') change - password @endsection
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
                <h4>Change Password</h4>
            </div>
        </div>
        <!-- /product list -->
        <div class="card">
            <div class="card-body">
                <form method="POST" action="{{route('admin-update-password')}}" enctype="multipart/form-data">
                    @csrf
                    @method('PUT')
                    <div class="row">
                        <div class="col-lg-4 col-sm-12">
                            <div class="form-group">
                                <label>Current Password</label>
                                <input type="password" placeholder="Your Current Password" name="old_password"required >
                                @error('old_password')
                                    <p class="text-danger">{{$message}}</p>
                                @enderror
                            </div>
                        </div>
                        <div class="col-lg-4 col-sm-12">
                            <div class="form-group">
                                <label>New Password</label>
                                <input type="password" class="form-control" name="new_password" required
                                       placeholder="Write New Password" >
                                @error('new_password')
                                <p class="text-danger">{{$message}}</p>
                                @enderror
                            </div>
                        </div>
                        <div class="col-lg-4 col-sm-12">
                            <div class="form-group">
                                <label>New Password Confirmation</label>
                                <input type="password"  placeholder="Confirm New Password" required
                                       name="new_password_confirmation">
                                @error('new_password_confirmation')
                                  <p class="text-danger">{{$message}}</p>
                                @enderror
                            </div>
                        </div>
                        <div class="col-12 d-flex justify-content-end">
                            <button class="btn btn-submit me-2" type="submit">Submit</button>
                        </div>
                    </div>
                </form>
            </div>
        </div>
        <!-- /product list -->
    </div>
@endsection

