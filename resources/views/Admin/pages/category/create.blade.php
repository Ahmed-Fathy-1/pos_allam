@extends('Admin.layouts.master')
@section('main_head')
    <div class="page-title font-medium ">
        <h4>Add Category </h4>
    </div>
@endsection
@section('title') Category - create @endsection
@section('css')
    <style>
        .content{
            padding: 10px !important;
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
        <!-- /add -->
        <div class="card">
            <div class="card-body">
                <form method="POST" action="{{route('category-store')}}" enctype="multipart/form-data">
                    @csrf
                    <div class="row">
                        <div class="col-lg-6 col-sm-12 col-12">
                            <div class="form-group">
                                <label>Name</label>
                                <input type="text" name="name" value="{{old('name')}}" required placeholder="Enter Category Name" >
                                @error('name')
                                <p class="text-danger">{{$message}}</p>
                                @enderror
                            </div>
                        </div>
                        <div class="col-lg-12">
                            <div class="form-group">
                                <label>Image</label>
                                <div class="image-upload">
                                    <input type="file" name="file[]" multiple accept="image/*"  required >
                                    <div class="image-uploads">
                                        <img src="{{asset('assets/dashboard/img/icons/upload.svg')}}" alt="img">
                                        <h4>Drag and drop a file or Multi to upload</h4>
                                    </div>
                                    @error('file')
                                    <p class="text-danger">{{$message}}</p>
                                    @enderror
                                </div>
                            </div>
                        </div>
                       {{-- <div class="col-lg-12 col-sm-12 col-12">
                            <div class="form-group">
                                <label>Alt Images ( first_alt,second_alt,... )</label>
                                <textarea rows="5" cols="5" name="alts"
                                          placeholder="Enter Alt to each images as : first_alt,second_alt,... "
                                          class="form-control">{{old('alts')}}</textarea>
                                @error('alts')
                                <p class="text-danger">{{$message}}</p>
                                @enderror
                            </div>
                        </div>--}}
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
                   {{--  <h4 class="text-center mb-3"> Meta Tags to this Category</h4>
                    <div class="row">
                       --}}{{-- <div class="col-lg-6 col-sm-6 col-12">
                            <div class="form-group">
                                <label>Title</label>
                                <input type="text" name="title" value="{{old('title')}}" placeholder="Enter Page Title"  />
                                @error('title')
                                <p class="text-danger">{{$message}}</p>
                                @enderror
                            </div>
                        </div>--}}{{--
                        --}}{{--<div class="col-lg-6 col-sm-6 col-12">
                            <div class="form-group">
                                <label>Canonical Url after (https://aitech.net.au/butcher/category/) </label>
                                <input type="text" id="canonical_url"  name="canonical_url" value="https://aitech.net.au/butcher/category/"
                                       placeholder="Enter Canonical Url"  />
                                @error('canonical_url')
                                <p class="text-danger">{{$message}}</p>
                                @enderror
                            </div>
                        </div>--}}{{--
                        <div class="col-lg-6 col-12">
                            <div class="form-group">
                                <label> Keyword Content </label>
                                <select class="form-control tagging js-example-tags"  multiple="multiple" name="keyword[]">

                                </select>
                                @error('keyword')
                                <p class="text-danger">{{$message}}</p>
                                @enderror
                            </div>
                        </div>
                        <div class="col-lg-6">
                            <div class="form-group">
                                <label> Description Content </label>
                                <textarea class="form-control" name="description_meta">{{old('description')}}</textarea>
                                @error('description')
                                    <p class="text-danger">{{$message}}</p>
                                @enderror
                            </div>
                        </div>
                        <div class="col-lg-12">
                            <div class="form-group">
                                <label>Add Schema Markup Data </label>
                                <textarea class="form-control" name="schema_data"  style="height: 200px"
                                          placeholder="Enter Schema Markup Data to home page" >{{old('schema_data')}}</textarea>
                                @error('schema_data')
                                <p class="text-danger">{{$message}}</p>
                                @enderror
                            </div>
                        </div>
                    </div>--}}
                    <div class="col-lg-12 d-flex justify-content-end">
                        <button class="btn btn-submit me-2" type="submit">Submit</button>
                    </div>
                </form>
            </div>
        </div>
        <!-- /add -->
    </div>
@endsection
@section('js')
    <script src="{{asset('assets/dashboard/js/dashboard/price.js')}}"></script>
    <script>
        $(".js-example-tags").select2({
            tags: true
        });
    </script>
@endsection
