@extends('Admin.layouts.master')
@section('main_head')
    <div class="page-title font-medium ">
        <h4>Unit Oage</h4>
    </div>
@endsection
@section('title') Unit @endsection
@section('css')

    <style>
        .content{
            padding: 10px !important;
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
        <!-- /product list -->
        <div class="card">
            <div class="card-body">
                <div class="page-header d-flex justify-content-start align-items-start flex-sm-row">

                        <a class="btn btn-added mt-2 mt-lg-0" data-bs-toggle="modal" data-bs-target="#create">
                            <img src="{{asset('assets/dashboard/img/icons/plus.svg')}}"
                                 class="me-2" alt="img">
                            Add Unit
                        </a>
                        {{-- create Banner--}}
                        <div class="modal fade" id="create" tabindex="-1" aria-labelledby="create"
                             aria-hidden="true">
                            <div class="modal-dialog modal-lg modal-dialog-centered" role="document">
                                <div class="modal-content">
                                    <div class="modal-header"  style="background-color: #FF9F43;">
                                        <h5 class="modal-title text-white" >New Unit</h5>
                                        <button type="button" class="close" data-bs-dismiss="modal" aria-label="Close">
                                            <span aria-hidden="true">×</span>
                                        </button>
                                    </div>
                                    <form method="POST" action="{{route('unit.store')}}" enctype="multipart/form-data">
                                        @csrf
                                        <div class="modal-body">
                                            <div class="row">
                                                <div class="col-lg-6 col-sm-12 col-12">
                                                    <div class="form-group">
                                                        <label>Name</label>
                                                        <input type="text" name="name" required placeholder="Enter Unit Name" >
                                                        @error('name')
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
                <!-- /Filter -->
                <div class="row">
                    <div class="table-responsive">
                        <table class="table  datanew">
                            <thead>
                            <tr class="text-center">
                                <th>#</th>
                                <th>name</th>
                                <th>created By</th>
                                <th>Status</th>
                                <th>Action</th>
                            </tr>
                            </thead>
                            <tbody>
                            @foreach($units as $unit)
                                <tr class="text-center">
                                    <td>{{$loop->iteration}}</td>
                                    <td>{{$unit->name}}</td>
                                    <td >{{$unit->user->name}}</td>
                                    <td class="text-capitalize">
                                        @if($unit->status == 1)
                                            <span class="badge bg-success">Active</span>
                                        @else
                                            <span class="badge bg-danger">Inactive</span>
                                        @endif
                                    </td>
                                    <td>
                                        <a class="me-3" data-bs-toggle="modal" data-bs-target="#edit{{$unit->id}}" >
                                            <img src="{{asset('assets/dashboard/img/icons/edit.svg')}}" alt="img">
                                        </a>
                                        <a class="me-3 " data-bs-toggle="modal" data-bs-target="#delete{{$unit->id}}">
                                            <img src="{{asset('assets/dashboard/img/icons/delete.svg')}}" alt="img">
                                        </a>

                                        {{-- model Edit Banners--}}
                                        <div class="modal fade" id="edit{{$unit->id}}" tabindex="-1" aria-labelledby="edit{{$unit->id}}"
                                             aria-hidden="true">
                                            <div class="modal-dialog modal-lg modal-dialog-centered" role="document">
                                                <div class="modal-content">
                                                    <div class="modal-header" style="background-color: #FF9F43;">
                                                        <h5 class="modal-title text-white" >Edit Unit</h5>
                                                        <button type="button" class="close" data-bs-dismiss="modal" aria-label="Close">
                                                            <span aria-hidden="true">×</span>
                                                        </button>
                                                    </div>
                                                    <form method="POST" action="{{route('unit.update',$unit->id)}}" enctype="multipart/form-data">
                                                        @csrf
                                                        @method('PUT')
                                                        <input type="hidden" name="id" value="{{$unit->id}}">
                                                        <div class="modal-body">
                                                            <div class="row">
                                                                <div class="col-lg-6  col-12">
                                                                    <div class="form-group">
                                                                        <label>Name</label>
                                                                        <input type="text" name="name" value="{{$unit->name}}" required placeholder="Enter Unit Name" >
                                                                        @error('name')
                                                                           <p class="text-danger">{{$message}}</p>
                                                                        @enderror
                                                                    </div>
                                                                </div>
                                                                <div class="col-lg-6  col-12">
                                                                    <div class="form-group">
                                                                        <label>Status</label>
                                                                        <select class="select form-select" name="status" required>
                                                                            <option selected disabled>Choose Status</option>
                                                                            <option value="1" @if($unit->status == 1) selected @endif>Active</option>
                                                                            <option value="0" @if($unit->status == 0) selected @endif>InActive</option>
                                                                        </select>
                                                                        @error('status')
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

                                        {{-- model Delete --}}
                                        <div class="modal fade" id="delete{{$unit->id}}" tabindex="-1"    aria-hidden="true">
                                            <div class="modal-dialog modal-dialog-centered" role="document">
                                                <div class="modal-content">
                                                    <div class="modal-header" style="background-color: #FF9F43;">
                                                        <h5 class="modal-title text-white" >Delete Banner</h5>
                                                        <button type="button" class="close" data-bs-dismiss="modal" aria-label="Close">
                                                            <span aria-hidden="true">×</span>
                                                        </button>
                                                    </div>
                                                    <form method="POST" action="{{route('unit.destroy',$unit->id)}}">
                                                        @csrf
                                                        @method('DELETE')
                                                        <div class="modal-body">
                                                            <div class="delete-order">
                                                                <img src="{{asset('assets/dashboard/img/icons/close-circle1.svg')}}" alt="img">
                                                            </div>
                                                            <div class="para-set text-center">
                                                                <p>Are You Sure Delete This Unit</p>
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

