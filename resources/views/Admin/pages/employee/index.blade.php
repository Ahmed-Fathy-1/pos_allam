@extends('Admin.layouts.master')
@section('title') Employees @endsection
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
                <h4>Employee List</h4>
                <h6>Manage your employee</h6>
            </div>
            @can('create_employee')
            <div class="page-btn">
                <a class="btn btn-added" href="{{route('employee.create')}}">
                    <img src="{{asset('assets/dashboard/img/icons/plus.svg')}}"
                         class="me-2" alt="img">
                    Add New Employee
                </a>
            </div>
            @endcan
        </div>
        <!-- /product list -->
        <div class="card">
            <div class="card-body">
                <div class="table-responsive">
                    <table class="table  datanew">
                        <thead>
                        <tr>
                            <th>#</th>
                            <th>Name</th>
                            <th>Image</th>
                            <th>Email</th>
                            <th>Mobile </th>
                            <th>Role</th>
                            <th>Action</th>
                        </tr>
                        </thead>
                        <tbody>
                        @foreach($employees as $employee)
                            <tr>
                                <td>{{$loop->iteration}}</td>
                                <td>{{$employee->name}} </td>
                                <td>
                                    @if($employee->image != null)
                                        <img style="max-width: 50px" src="{{asset('storage/employee/'.$employee->image)}}">
                                    @else
                                        <img style="max-width: 50px" src="{{asset('storage/employee/100x100.png')}}">
                                    @endif
                                </td>
                                <td>{{$employee->email}}</td>
                                <td>{{$employee->mobile}}</td>
                                <td>{{$employee->role_name}}</td>
                                <td>
                                    @can('edit_employee')
                                    <a class="me-3" data-bs-toggle="modal" data-bs-target="#edit{{$employee->id}}" >
                                        <img src="{{asset('assets/dashboard/img/icons/edit.svg')}}" alt="img">
                                    </a>
                                    @endcan
                                    @can('delete_employee')
                                    <a  data-bs-toggle="modal" data-bs-target="#delete{{$employee->id}}">
                                        <img src="{{asset('assets/dashboard/img/icons/delete.svg')}}" alt="img">
                                    </a>
                                    @endcan
                                    {{-- Model Edit--}}
                                    <div class="modal fade" id="edit{{$employee->id}}" tabindex="-1" aria-labelledby="edit{{$employee->id}}"
                                         aria-hidden="true">
                                        <div class="modal-dialog modal-lg modal-dialog-centered" role="document">
                                            <div class="modal-content">
                                                <div class="modal-header" style="background-color: #FF9F43;">
                                                    <h5 class="modal-title text-white" >Edit Employee</h5>
                                                    <button type="button" class="close" data-bs-dismiss="modal" aria-label="Close">
                                                        <span aria-hidden="true">×</span>
                                                    </button>
                                                </div>
                                                <form method="POST" action="{{route('employee.update',$employee->id)}}" enctype="multipart/form-data">
                                                    @csrf
                                                    @method('PUT')
                                                    <input type="hidden" name="id" value="{{$employee->id}}">
                                                    <div class="modal-body">
                                                        <div class="row">
                                                            <div class="col-lg-6 col-sm-6 col-12">
                                                                <div class="form-group">
                                                                    <label>Customer Name</label>
                                                                    <input type="text" name="name" value="{{$employee->name}}"
                                                                           required placeholder="Enter Employee Name">
                                                                    @error('name')
                                                                    <p class="text-danger">{{$message}}</p>
                                                                    @enderror
                                                                </div>
                                                            </div>

                                                            <div class="col-lg-6 col-sm-6 col-12">
                                                                <div class="form-group">
                                                                    <label>Email</label>
                                                                    <input type="email" name="email"   value="{{$employee->email}}"
                                                                           class="form-control" required placeholder="Enter Employee Email">
                                                                    @error('email')
                                                                    <p class="text-danger">{{$message}}</p>
                                                                    @enderror
                                                                </div>
                                                            </div>

                                                            <div class="col-lg-6 col-sm-6 col-12">
                                                                <div class="pass-group form-group">
                                                                    <label>Update Password</label>
                                                                    <input type="password" name="password"
                                                                            placeholder="Enter Password If you want To Changed">
                                                                    <span class="fas toggle-password fa-eye-slash mt-3"></span>
                                                                    @error('password')
                                                                    <p class="text-danger">{{$message}}</p>
                                                                    @enderror
                                                                </div>
                                                            </div>

                                                            <div class="col-lg-6 col-sm-6 col-12">
                                                                <div class="pass-group form-group">
                                                                    <label>Password Confirmation</label>
                                                                    <input type="password" name="password_confirmation"
                                                                           placeholder="Enter Password Confirmation">
                                                                    <span class="fas toggle-password fa-eye-slash  mt-3"></span>
                                                                    @error('password_confirmation')
                                                                    <p class="text-danger">{{$message}}</p>
                                                                    @enderror
                                                                </div>
                                                            </div>

                                                            <div class="col-lg-6 col-sm-6 col-12">
                                                                <div class="form-group">
                                                                    <label>Mobile</label>
                                                                    <input type="text" name="mobile" value="{{$employee->mobile}}" required placeholder="Enter Mobile Number">
                                                                    @error('mobile')
                                                                    <p class="text-danger">{{$message}}</p>
                                                                    @enderror
                                                                </div>
                                                            </div>
                                                            <div class="col-lg-6 col-sm-6 col-12">
                                                                <div class="form-group">
                                                                    <label>Choose Role</label>
                                                                    <select class="select" name="role_name" required>
                                                                        <option selected disabled>Choose Employee Role</option>
                                                                        @foreach($roles as $role)
                                                                            <option value="{{$role->name}}" @if($role->name == $employee->role_name) selected @endif>{{$role->name}}</option>
                                                                        @endforeach
                                                                    </select>
                                                                    @error('role_name')
                                                                    <p class="text-danger">{{$message}}</p>
                                                                    @enderror
                                                                </div>
                                                            </div>
                                                            <div class="col-lg-6 col-sm-6 col-12">
                                                                <div class="form-group">
                                                                    <label>Current Image</label>
                                                                    @if($employee->image != null)
                                                                        <img style="max-width: 100px" src="{{asset('storage/employee/'.$employee->image)}}">
                                                                    @else
                                                                        <img style="max-width: 100px" src="{{asset('storage/employee/100x100.png')}}">
                                                                    @endif
                                                                </div>
                                                            </div>
                                                            <div class="col-lg-12">
                                                                <div class="form-group">
                                                                    <label>	Update Image</label>
                                                                    <div class="image-upload">
                                                                        <input type="file" name="image" >
                                                                        <div class="image-uploads">
                                                                            <img src="{{asset('assets/dashboard/img/icons/upload.svg')}}" alt="img">
                                                                            <h4>Drag and drop a file to upload</h4>
                                                                        </div>
                                                                    </div>
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

                                    {{-- model Delete --}}
                                    <div class="modal fade" id="delete{{$employee->id}}" tabindex="-1"    aria-hidden="true">
                                        <div class="modal-dialog modal-dialog-centered" role="document">
                                            <div class="modal-content">
                                                <div class="modal-header" style="background-color: #FF9F43;" >
                                                    <h5 class="modal-title text-white" >Delete Employee</h5>
                                                    <button type="button" class="close" data-bs-dismiss="modal" aria-label="Close">
                                                        <span aria-hidden="true">×</span>
                                                    </button>
                                                </div>
                                                <form method="POST" action="{{route('employee.destroy',$employee->id)}}">
                                                    @csrf
                                                    @method('DELETE')
                                                    <div class="modal-body">
                                                        <div class="delete-order">
                                                            <img src="{{asset('assets/dashboard/img/icons/close-circle1.svg')}}" alt="img">
                                                        </div>
                                                        <div class="para-set text-center">
                                                            <p>Are You Sure Delete Employee</p>
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
        <!-- /product list -->
    </div>
@endsection

