@extends('Admin.layouts.master')
@section('title') Banners @endsection
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
                <h4>Banners List</h4>
                <h6>Manage your banners</h6>
            </div>
            @can('create_banner')
            <div class="page-btn">
                <a href="" class="btn btn-added" data-bs-toggle="modal" data-bs-target="#create">
                    <i data-feather="flag"></i><span>Add New Banner</span></a>
                {{-- create Banner--}}
                <div class="modal fade" id="create" tabindex="-1" aria-labelledby="create"
                     aria-hidden="true">
                    <div class="modal-dialog modal-lg modal-dialog-centered" role="document">
                        <div class="modal-content">
                            <div class="modal-header">
                                <h5 class="modal-title" >Edit Banner</h5>
                                <button type="button" class="close" data-bs-dismiss="modal" aria-label="Close">
                                    <span aria-hidden="true">×</span>
                                </button>
                            </div>
                            <div class="modal-body">
                                <form method="POST" action="{{route('banner-store')}}" enctype="multipart/form-data">
                                    @csrf
                                    <div class="row">
                                        <div class="col-lg-6  col-12">
                                            <div class="form-group">
                                                <label>Title</label>
                                                <input type="text" name="title" required placeholder="Enter Title of banner">
                                                @error('title')
                                                <p class="text-danger">{{$message}}</p>
                                                @enderror
                                            </div>
                                        </div>
                                        <div class="col-lg-6  col-12">
                                            <label> Category</label>
                                            <select class="form-control form-small" required name="category_id">
                                                <option disabled selected> Choose Category</option>
                                                @foreach($categories as $category)
                                                    <option value="{{$category->id}}">{{$category->name}}</option>
                                                @endforeach
                                            </select>
                                            @error('category_id')
                                            <p class="text-danger">{{$message}}</p>
                                            @enderror
                                        </div>
                                        <div class="col-lg-6 col-sm-12 col-12">
                                            <div class="form-group">
                                                <label> Image</label>
                                                <input type="file" class="form-control" required name="image" placeholder="Enter Title of banner">
                                                @error('image')
                                                <p class="text-danger">{{$message}}</p>
                                                @enderror
                                            </div>
                                        </div>
                                        <div class="col-lg-6 col-sm-12 col-12">
                                            <div class="form-group">
                                                <label> Alt Image </label>
                                                <input type="text" class="form-control" required name="alt" placeholder="Enter Alt Of Image ">
                                                @error('alt')
                                                <p class="text-danger">{{$message}}</p>
                                                @enderror
                                            </div>
                                        </div>
                                        <div class="col-lg-12 col-sm-12 col-12">
                                            <div class="form-group">
                                                <label>Description</label>
                                                <textarea rows="5" cols="5" name="description" required
                                                          placeholder="Enter Banner Description"
                                                          class="form-control"></textarea>
                                                @error('description')
                                                <p class="text-danger">{{$message}}</p>
                                                @enderror
                                            </div>
                                        </div>
                                        <div class="col-lg-6 col-sm-12 col-12">
                                            <div class="form-group">
                                                <label>text Color</label>
                                                <input type="color" name="text_color" required>
                                                @error('text_color')
                                                <p class="text-danger">{{$message}}</p>
                                                @enderror
                                            </div>
                                        </div>
                                    </div>
                                    <div class="col-lg-12 d-flex justify-content-between">
                                        <button class="btn btn-cancel"  type="button" data-bs-dismiss="modal" aria-label="Close">Cancel</button>
                                        <button class="btn btn-submit" type="submit">Submit</button>
                                    </div>
                                </form>
                            </div>
                        </div>
                    </div>
                </div>

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
                            <th>Title</th>
                            <th>Description</th>
                            <th>Status </th>
                            <th>Category</th>
                            <th>Color</th>
                            <th>image</th>
                            <th>Action</th>
                        </tr>
                        </thead>
                        <tbody>
                        @foreach($banners as $banner)
                            <tr>
                                <td> {{$loop->iteration}}</td>
                                <td >
                                    {{$banner->title}}
                                </td>
                                <td class="text-wrap">{{$banner->description}}</td>
                                <td>{{$banner->status}}</td>
                                <td>{{$banner->category->name}}</td>
                                <td>
                                    <input type="color" value="{{$banner->text_color}}">
                                </td>
                                <td>
                                    <img src="{{asset('storage/banners/'.$banner->image)}}" style="max-width: 250px; max-height: 50px">
                                </td>
                                <td>
                                    @can('edit_banner')
                                    <a class="me-3" data-bs-toggle="modal" data-bs-target="#edit{{$banner->id}}" >
                                        <img src="{{asset('assets/dashboard/img/icons/edit.svg')}}" alt="img">
                                    </a>
                                    @endcan
                                    @can('delete_banner')
                                    <a  data-bs-toggle="modal" data-bs-target="#delete{{$banner->id}}" >
                                        <img src="{{asset('assets/dashboard/img/icons/delete.svg')}}" alt="img">
                                    </a>
                                    @endcan
                                    {{-- model Edit Banners--}}
                                    <div class="modal fade" id="edit{{$banner->id}}" tabindex="-1" aria-labelledby="edit{{$banner->id}}"
                                         aria-hidden="true">
                                        <div class="modal-dialog modal-lg modal-dialog-centered" role="document">
                                            <div class="modal-content">
                                                <div class="modal-header" style="background-color: #FF9F43;">
                                                    <h5 class="modal-title text-white" >Edit Banner</h5>
                                                    <button type="button" class="close" data-bs-dismiss="modal" aria-label="Close">
                                                        <span aria-hidden="true">×</span>
                                                    </button>
                                                </div>
                                                <form method="POST" action="{{route('banner-update')}}" enctype="multipart/form-data">
                                                    @csrf
                                                    @method('PUT')
                                                    <div class="modal-body">
                                                        <input type="hidden" name="id" value="{{$banner->id}}">
                                                        <div class="row">
                                                            <div class="col-lg-6 col-sm-12 col-12">
                                                                <div class="form-group">
                                                                    <label>Title</label>
                                                                    <input type="text" value="{{$banner->title}}" required name="title" placeholder="Enter Title of banner">
                                                                    @error('title')
                                                                    <p class="text-danger">{{$message}}</p>
                                                                    @enderror
                                                                </div>
                                                            </div>
                                                            <div class="col-lg-6 col-sm-12 col-12">
                                                                <label> Category</label>
                                                                <select class="form-control form-small  mt-2" name="category_id" required>
                                                                    <option disabled> Category List</option>
                                                                    @foreach($categories as $category)
                                                                        <option value="{{$category->id}}"
                                                                                @if($category->id == $banner->category_id) selected @endif>
                                                                            {{$category->name}}</option>
                                                                    @endforeach
                                                                </select>
                                                                @error('category_id')
                                                                <p class="text-danger">{{$message}}</p>
                                                                @enderror
                                                            </div>
                                                            <div class="col-lg-6 col-sm-12 col-12">
                                                                <div class="form-group">
                                                                    <label>new Image</label>
                                                                    <input type="file" class="form-control" name="image" placeholder="Enter Title of banner">
                                                                    @error('image')
                                                                    <p class="text-danger">{{$message}}</p>
                                                                    @enderror
                                                                </div>
                                                            </div>
                                                            <div class="col-lg-6 col-sm-12 col-12">
                                                                <div class="form-group">
                                                                    <label>current Banner</label>
                                                                    <img src="{{asset('storage/banners/'.$banner->image)}}" style="max-width: 350px; max-height: 100px">
                                                                </div>
                                                            </div>
                                                            <div class="col-lg-6 col-sm-12 col-12">
                                                                <div class="form-group">
                                                                    <label> Alt Image </label>
                                                                    <input type="text" class="form-control" value="{{$banner->alt}}" required name="alt" placeholder="Enter Alt Of Image ">
                                                                    @error('alt')
                                                                    <p class="text-danger">{{$message}}</p>
                                                                    @enderror
                                                                </div>
                                                            </div>
                                                            <div class="col-lg-12 col-sm-12 col-12">
                                                                <div class="form-group">
                                                                    <label>Description</label>
                                                                    <textarea rows="5" cols="5" name="description" required
                                                                              placeholder="Enter Banner Description"
                                                                              class="form-control">{{$banner->description}}</textarea>
                                                                    @error('description')
                                                                    <p class="text-danger">{{$message}}</p>
                                                                    @enderror
                                                                </div>
                                                            </div>
                                                            <div class="col-lg-6 col-sm-12 col-12">
                                                                <div class="form-check form-switch">
                                                                    <input class="form-check-input" type="checkbox" id="flexSwitchCheckDefault" name="status"
                                                                           value="1"  @if($banner->status == 1) checked @endif>
                                                                    <label class="form-check-label" for="flexSwitchCheckDefault">Status</label>
                                                                </div>
                                                            </div>
                                                            <div class="col-lg-6 col-sm-12 col-12">
                                                                <div class="form-group">
                                                                    <label>text Color</label>
                                                                    <input type="color" value="{{$banner->text_color}}" name="text_color" required>
                                                                    @error('text_color')
                                                                    <p class="text-danger">{{$message}}</p>
                                                                    @enderror
                                                                </div>
                                                            </div>
                                                        </div>
                                                    </div>
                                                    <div class="modal-footer d-flex justify-content-between">
                                                        <button class="btn btn-cancel" type="button" data-bs-dismiss="modal">Cancel</button>
                                                        <button class="btn btn-submit " type="submit">Submit</button>
                                                    </div>
                                                </form>
                                            </div>
                                        </div>
                                    </div>
                                    {{-- model Delete --}}
                                    <div class="modal fade" id="delete{{$banner->id}}" tabindex="-1"    aria-hidden="true">
                                        <div class="modal-dialog modal-dialog-centered" role="document">
                                            <div class="modal-content">
                                                <div class="modal-header" style="background-color: #FF9F43;">
                                                    <h5 class="modal-title text-white">Delete Banner</h5>
                                                    <button type="button" class="close" data-bs-dismiss="modal" aria-label="Close">
                                                        <span aria-hidden="true">×</span>
                                                    </button>
                                                </div>
                                                <div class="modal-body">
                                                    <form method="POST" action="{{route('banner-destroy',$banner->id)}}">
                                                        @csrf
                                                        @method('DELETE')
                                                        <div class="delete-order">
                                                            <img src="{{asset('assets/dashboard/img/icons/close-circle1.svg')}}" alt="img">
                                                        </div>
                                                        <div class="para-set text-center">
                                                            <p>Are You Sure Delete Banner</p>
                                                        </div>
                                                        <div class="col-lg-12 d-flex justify-content-between">
                                                            <button class="btn btn-cancel" data-bs-dismiss="modal">No</button>
                                                            <button class="btn btn-danger" type="submit" >Yes</button>
                                                        </div>
                                                    </form>
                                                </div>
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

