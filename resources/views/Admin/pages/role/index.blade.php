@extends('Admin.layouts.master')
@section('title') role @endsection
@section('content')
    <div class="content">
        <div class="page-header">
            <div class="page-title">
                <h4>Role List</h4>
                <h6>Manage your roles to handle employee jobs</h6>
            </div>
            @can('create_role')
            <div class="page-btn">
                <a class="btn btn-added" href="{{route('product-create')}}" data-bs-toggle="modal" data-bs-target="#create">
                    <img src="{{asset('assets/dashboard/img/icons/plus.svg')}}"
                         class="me-2" alt="img">
                    Add New Role
                </a>
            </div>
            @endcan
            {{-- role addd Model --}}
            <div class="modal fade" id="create" tabindex="-1" aria-labelledby="create"
                 aria-hidden="true">
                <div class="modal-dialog modal-lg modal-dialog-centered" role="document">
                    <div class="modal-content" >
                        <div class="modal-header"  style="background-color: #FF9F43;">
                            <h5 class="modal-title text-white" >New Role With Permissions </h5>
                            <button type="button" class="close" data-bs-dismiss="modal" aria-label="Close">
                                <span aria-hidden="true">×</span>
                            </button>
                        </div>
                        <form method="POST" action="{{route('role.store')}}">
                            @csrf
                            <div class="modal-body">
                                <div class="row">
                                    <div class="col-lg-6 col-sm-12 col-12">
                                        <div class="form-group">
                                            <label>Name</label>
                                            <input type="text" name="name" required placeholder="Enter Role Name" >
                                            @error('name')
                                             <p class="text-danger">{{$message}}</p>
                                            @enderror
                                        </div>
                                    </div>
                                </div>
                                <div class="row">
                                    @foreach($permission as $key=>$p)
                                        <div class="col-md-3 col-sm-6  mb-1 form-check form-switch">
                                            <input class="form-check-input" name="permission[]"
                                                   type="checkbox" value="{{$p->name}}"
                                                   id="flexSwitchCheckChecked{{$key}}">
                                            <label class="form-check-label" for="flexSwitchCheckChecked{{$key}}">{{$p->name}}</label>
                                        </div>
                                    @endforeach
                                    @error('permission')
                                    <p class="text-danger">{{$message}}</p>
                                    @enderror
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
        <!-- /Roles list -->
        <div class="card">
            <div class="card-body">
                <div class="table-responsive">
                    <table class="table  datanew">
                        <thead>
                        <tr>
                            <th>#</th>
                            <th>Role Name</th>
                            <th>Action</th>
                        </tr>
                        </thead>
                        <tbody>
                        @foreach($roles as $role)
                            <tr>
                                <td>{{$loop->iteration}}</td>
                                <td>{{$role->name}} </td>
                                <td>

                                    <a class="me-3" data-bs-toggle="modal" data-bs-target="#show{{$role->id}}">
                                        <img src="{{asset('assets/dashboard/img/icons/eye.svg')}}" alt="img">
                                    </a>

                                        @if($role->name != 'cashier')
                                            @if($role->name != 'delivery')
                                            @can('edit_role')
                                        <a class="me-3" data-bs-toggle="modal" data-bs-target="#edit{{$role->id}}">
                                            <img src="{{asset('assets/dashboard/img/icons/edit.svg')}}" alt="img">
                                        </a>
                                            @endcan
                                        @can('delete_role')
                                        <a  data-bs-toggle="modal" data-bs-target="#delete{{$role->id}}">
                                            <img src="{{asset('assets/dashboard/img/icons/delete.svg')}}" alt="img">
                                        </a>
                                            @endcan
                                            @endif
                                        @endif

                                    @php
                                        $rolePermissions = Spatie\Permission\Models\Permission::join("role_has_permissions","role_has_permissions.permission_id","=","permissions.id")
                                                                                             ->where("role_has_permissions.role_id",$role->id)
                                                                                             ->get();
                                    @endphp
                                    {{-- model Show Role Permission--}}
                                    <div class="modal fade" id="show{{$role->id}}" tabindex="-1" aria-labelledby="show{{$role->id}}"
                                         aria-hidden="true">
                                        <div class="modal-dialog modal-lg modal-dialog-centered" role="document">
                                            <div class="modal-content" >
                                                <div class="modal-header"  style="background-color: #FF9F43;">
                                                    <h5 class="modal-title text-white" >Show Permissions</h5>
                                                    <button type="button" class="close" data-bs-dismiss="modal" aria-label="Close">
                                                        <span aria-hidden="true">×</span>
                                                    </button>
                                                </div>
                                                    <div class="modal-body">
                                                        <div class="row">
                                                            @foreach($rolePermissions as $r)
                                                                <div class="col-md-3 col-sm-6  mb-1 form-check form-switch">
                                                                    <input class="form-check-input" name="permission[]"
                                                                           type="checkbox" value="{{$r->name}}"
                                                                           id="flexSwitchCheckChecked"
                                                                           @if($r->permission_id == $r->id)
                                                                               checked
                                                                        @endif>
                                                                    <label class="form-check-label" for="flexSwitchCheckChecked">{{$r->name}}</label>
                                                                </div>
                                                            @endforeach
                                                        </div>
                                                    </div>
                                                    <div class="modal-footer d-flex justify-content-end">
                                                        <button class="btn btn-primary"  type="button" data-bs-dismiss="modal" aria-label="Close">Cancel</button>
                                                    </div>
                                            </div>
                                        </div>
                                    </div>
                                    {{-- model Edit Role Permission--}}
                                    <div class="modal fade" id="edit{{$role->id}}" tabindex="-1" aria-labelledby="edit{{$role->id}}"
                                         aria-hidden="true">
                                        <div class="modal-dialog modal-lg modal-dialog-centered" role="document">
                                            <div class="modal-content" >
                                                <div class="modal-header"  style="background-color: #FF9F43;">
                                                    <h5 class="modal-title text-white" >Edit Role With  Permissions</h5>
                                                    <button type="button" class="close" data-bs-dismiss="modal" aria-label="Close">
                                                        <span aria-hidden="true">×</span>
                                                    </button>
                                                </div>
                                                <form method="POST" action="{{route('role.update',$role->id)}}">
                                                    @csrf
                                                    @method('PUT')
                                                    <input type="hidden" name="id" value="{{$role->id}}">
                                                    <div class="modal-body">
                                                        <div class="row">
                                                            <div class="col-lg-6 col-sm-12 col-12">
                                                                <div class="form-group">
                                                                    <label>Name</label>
                                                                    <input type="text" name="name" value="{{$role->name}}" required placeholder="Enter Role Name" >
                                                                    @error('name')
                                                                        <p class="text-danger">{{$message}}</p>
                                                                    @enderror
                                                                </div>
                                                            </div>
                                                        </div>
                                                        <div class="row">
                                                        @php
                                                            $roleEditPermissions = \Illuminate\Support\Facades\DB::table("role_has_permissions")->where("role_has_permissions.role_id",$role->id) ->get();
                                                        @endphp
                                                            @foreach($permission as $key=>$p)
                                                                <div class="col-md-3 col-sm-6  mb-1 form-check form-switch">
                                                                    <input class="form-check-input" name="permission[]"
                                                                           type="checkbox" value="{{$p->id}}"
                                                                           id="flexSwitchCheckChecked{{$key}}"
                                                                           @foreach($roleEditPermissions as $rp)
                                                                               @if($p->id == $rp->permission_id)
                                                                                   checked
                                                                              @endif
                                                                        @endforeach>
                                                                    <label class="form-check-label" for="flexSwitchCheckChecked{{$key}}">{{$p->name}}</label>
                                                                </div>
                                                            @endforeach
                                                            @error('permission')
                                                            <p class="text-danger">{{$message}}</p>
                                                            @enderror
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
                                    <div class="modal fade" id="delete{{$role->id}}" tabindex="-1"  aria-hidden="true">
                                        <div class="modal-dialog modal-dialog-centered" role="document">
                                            <div class="modal-content">
                                                <div class="modal-header" style="background-color: #FF9F43;" >
                                                    <h5 class="modal-title text-white" >Delete Role</h5>
                                                    <button type="button" class="close" data-bs-dismiss="modal" aria-label="Close">
                                                        <span aria-hidden="true">×</span>
                                                    </button>
                                                </div>
                                                <form method="POST" action="{{route('role.destroy',$role->id)}}">
                                                    @csrf
                                                    @method('DELETE')
                                                    <div class="modal-body">
                                                        <div class="delete-order">
                                                            <img src="{{asset('assets/dashboard/img/icons/close-circle1.svg')}}" alt="img">
                                                        </div>
                                                        <div class="para-set text-center">
                                                            <p>Are You Sure Delete Role</p>
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

