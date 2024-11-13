@extends('Admin.layouts.master')
@section('title') employee - create @endsection
@section('content')
    <div class="content">
        <div class="page-header">
            <div class="page-title">
                <h4>Customer Management</h4>
                <h6>Add Customer with Role of Work .</h6>
            </div>
        </div>
        <!-- /add -->
        <div class="card">
            <div class="card-body">
                <form method="POST" action="{{route('employee.store')}}" enctype="multipart/form-data">
                    @csrf
                    <div class="row">
                        <div class="col-lg-6 col-sm-6 col-12">
                            <div class="form-group">
                                <label>Customer Name</label>
                                <input type="text" value="{{old('name')}}" name="name" required placeholder="Enter Employee Name">
                                @error('name')
                                <p class="text-danger">{{$message}}</p>
                                @enderror
                            </div>
                        </div>

                        <div class="col-lg-6 col-sm-6 col-12">
                            <div class="form-group">
                                <label>Email</label>
                                <input type="email" value="{{old('email')}}" name="email"  class="form-control" required placeholder="Enter Employee Email">
                                @error('email')
                                <p class="text-danger">{{$message}}</p>
                                @enderror
                            </div>
                        </div>

                        <div class="col-lg-6 col-sm-6 col-12">
                            <div class="pass-group form-group">
                                <label>Password</label>
                                <input type="password" name="password" required placeholder="Enter Password Name">
                                <span class="fas toggle-password fa-eye-slash mt-3"></span>
                                @error('password')
                                <p class="text-danger">{{$message}}</p>
                                @enderror
                            </div>
                        </div>

                        <div class="col-lg-6 col-sm-6 col-12">
                            <div class="pass-group form-group">
                                <label>Password Confirmation</label>
                                <input type="password" name="password_confirmation" required placeholder="Enter Password Confirmation">
                                <span class="fas toggle-password fa-eye-slash  mt-3"></span>
                                @error('password_confirmation')
                                <p class="text-danger">{{$message}}</p>
                                @enderror
                            </div>
                        </div>

                        <div class="col-lg-6 col-sm-6 col-12">
                            <div class="form-group">
                                <label>mobile</label>
                                <input type="text" name="mobile"  value="{{old('mobile')}}" required placeholder="Enter Mobile Number">
                                @error('mobile')
                                <p class="text-danger">{{$message}}</p>
                                @enderror
                            </div>
                        </div>
                        <div class="col-lg-6 col-sm-6 col-12">
                            <div class="form-group">
                                <label>Choose Role</label>
                                <select class="select" name="role_name">
                                    <option selected disabled>Choose Employee Role</option>
                                    @foreach($roles as $role)
                                        <option value="{{$role->name}}">{{$role->name}}</option>
                                    @endforeach
                                </select>
                                @error('role_name')
                                <p class="text-danger">{{$message}}</p>
                                @enderror
                            </div>
                        </div>
                        <div class="col-lg-12">
                            <div class="form-group">
                                <label>	Employee Image</label>
                                <div class="image-upload">
                                    <input type="file" name="image" >
                                    <div class="image-uploads">
                                        <img src="{{asset('assets/dashboard/img/icons/upload.svg')}}" alt="img">
                                        <h4>Drag and drop a file to upload</h4>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="col-lg-12 d-flex justify-content-end">
                            <button class="btn btn-submit" type="submit">Submit</button>
                        </div>
                    </div>
                </form>
            </div>
        </div>
        <!-- /add -->
    </div>
@endsection

