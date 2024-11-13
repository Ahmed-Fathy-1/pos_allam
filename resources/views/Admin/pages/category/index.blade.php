@extends('Admin.layouts.master')
@section('main_head')
<div class="page-title font-medium ">
    <h4>Category List</h4>
</div>
@endsection
@section('title') Category @endsection
@section('css')

<style>
    .content {
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
                @can('create_category')
                    <a class="btn btn-added mt-2 mt-lg-0" href="{{route('category-create')}}">
                        <img src="{{asset('assets/dashboard/img/icons/plus.svg')}}" class="me-2" alt="img">
                        Add Category
                    </a>
                    <div></div>

                    {{-- create Banner--}}
                    <div class="modal fade" id="create" tabindex="-1" aria-labelledby="create" aria-hidden="true">
                        <div class="modal-dialog modal-lg modal-dialog-centered" role="document">
                            <div class="modal-content">
                                <div class="modal-header" style="background-color: #FF9F43;">
                                    <h5 class="modal-title text-white">New Category</h5>
                                    <button type="button" class="close" data-bs-dismiss="modal" aria-label="Close">
                                        <span aria-hidden="true">×</span>
                                    </button>
                                </div>
                                <form method="POST" action="{{route('category-store')}}" enctype="multipart/form-data">
                                    @csrf
                                    <div class="modal-body">
                                        <div class="row">
                                            <div class="col-lg-6 col-sm-12 col-12">
                                                <div class="form-group">
                                                    <label>Name</label>
                                                    <input type="text" name="name" value="{{old('name')}}" required
                                                        placeholder="Enter Category Name">
                                                    @error('name')
                                                        <p class="text-danger">{{$message}}</p>
                                                    @enderror
                                                </div>
                                            </div>
                                            <div class="col-lg-6 col-sm-12 col-12">
                                                <div class="form-group">
                                                    <label> Image ( you can add multi images )</label>
                                                    <input type="file" class="form-control" required name="file[]" multiple>
                                                    @error('file')
                                                        <p class="text-danger">{{$message}}</p>
                                                    @enderror
                                                </div>
                                            </div>

                                            <div class="col-lg-12 col-sm-12 col-12">
                                                <div class="form-group">
                                                    <label>Alt Images</label>
                                                    <textarea rows="5" cols="5" name="alts" required
                                                        placeholder="Enter Alt to each images as : fir "
                                                        class="form-control">{{old('alts')}}</textarea>
                                                    @error('alts')
                                                        <p class="text-danger">{{$message}}</p>
                                                    @enderror
                                                </div>
                                            </div>
                                            <div class="col-lg-12 col-sm-12 col-12">
                                                <div class="form-group">
                                                    <label>Description</label>
                                                    <textarea rows="5" cols="5" name="description" required
                                                        placeholder="Enter Banner Description"
                                                        class="form-control">{{old('description')}}</textarea>
                                                    @error('description')
                                                        <p class="text-danger">{{$message}}</p>
                                                    @enderror
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="modal-footer d-flex justify-content-between">
                                        <button class="btn btn-cancel" type="button" data-bs-dismiss="modal"
                                            aria-label="Close">Cancel</button>
                                        <button class="btn btn-submit" type="submit">Submit</button>
                                    </div>
                                </form>
                            </div>
                        </div>
                    </div>
                @endcan
            </div>

            <div class="row">
                <div class="table-responsive">
                    <table class="table  datanew">
                        <thead>
                            <tr class="text-center">
                                <th>#</th>
                                <th>name</th>
                                <th>description</th>
                                <th>images</th>
                                <th>Action</th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach($categories as $category)
                                <tr>
                                    <td>{{$loop->iteration}}</td>
                                    <td>{{$category->name}}</td>
                                    <td class="text-wrap">
                                        {{$category->description}}
                                    </td>
                                    <td>

                                        <div class="d-flex align-items-stretch gap-2">
                                            @foreach($category->images as $image)
                                                <img src="{{asset('storage/' . $image)}}"
                                                    style="max-height: 50px; max-width: 50px">
                                            @endforeach
                                        </div>
                                    </td>
                                    <td>
                                        @can('edit_category')
                                            <a class="me-3" href="{{route('category-edit', $category->id)}}">
                                                <img src="{{asset('assets/dashboard/img/icons/edit.svg')}}" alt="img">
                                            </a>
                                        @endcan
                                        @can('delete_category')
                                            <a class="me-3 " data-bs-toggle="modal" data-bs-target="#delete{{$category->id}}">
                                                <img src="{{asset('assets/dashboard/img/icons/delete.svg')}}" alt="img">
                                            </a>
                                        @endcan
                                        {{-- model Delete --}}
                                        <div class="modal fade" id="delete{{$category->id}}" tabindex="-1"
                                            aria-hidden="true">
                                            <div class="modal-dialog modal-dialog-centered" role="document">
                                                <div class="modal-content">
                                                    <div class="modal-header" style="background-color: #FF9F43;">
                                                        <h5 class="modal-title text-white">Delete Banner</h5>
                                                        <button type="button" class="close" data-bs-dismiss="modal"
                                                            aria-label="Close">
                                                            <span aria-hidden="true">×</span>
                                                        </button>
                                                    </div>
                                                    <form method="POST" action="{{route('category-delete', $category->id)}}">
                                                        @csrf
                                                        @method('DELETE')
                                                        <div class="modal-body">
                                                            <div class="delete-order">
                                                                <img src="{{asset('assets/dashboard/img/icons/close-circle1.svg')}}"
                                                                    alt="img">
                                                            </div>
                                                            <div class="para-set text-center">
                                                                <p>Are You Sure Delete Category</p>
                                                            </div>
                                                        </div>
                                                        <div class="modal-footer d-flex justify-content-between">
                                                            <button class="btn btn-cancel" type="button"
                                                                data-bs-dismiss="modal">No</button>
                                                            <button class="btn btn-danger" type="submit">Yes</button>
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