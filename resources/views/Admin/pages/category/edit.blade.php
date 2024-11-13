@extends('Admin.layouts.master')
@section('main_head')
    <div class="page-title font-medium ">
        <h4>Category Edit</h4>
    </div>
@endsection
@section('title') Category - Edit @endsection
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
        <div class="card">
            <div class="card-body">
                <form method="POST" action="{{route('category-update',$category->id)}}" enctype="multipart/form-data">
                    @csrf
                    @method('PUT')
                    <input type="hidden" name="id" value="{{$category->id}}">
                    <div class="row">
                        <div class="col-lg-6 col-sm-12 col-12">
                            <div class="form-group">
                                <label>Name</label>
                                <input type="text" value="{{$category->name}}" required name="name" placeholder="Enter Title of banner">
                                @error('name')
                                <p class="text-danger">{{$message}}</p>
                                @enderror
                            </div>
                        </div>

                        <div class="col-lg-12">
                            <label>Current Images </label>
                            <div class="d-flex justify-content-center  gap-3 items-stretch">
                                @foreach($category->images as $image)
                                    <img src="{{asset('storage/'.$image)}}" alt="category" title="category"
                                         style="max-width: 100px">
                                @endforeach
                            </div>
                        </div>
                        <div class="col-lg-12">
                            <div class="form-group">
                                <label>	Update Image</label>
                                <div class="image-upload">
                                    <input type="file" name="file[]" multiple accept="image/*"  >
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

                        <div class="col-lg-12 col-sm-12 col-12">
                            <div class="form-group">
                                <label>Alt Images</label>
                                <textarea rows="5" cols="5" name="alts" required
                                          placeholder="Enter Alt to each images as : fir "
                                          class="form-control">@if($category->alts != null) @foreach($category->alts as $index => $alt){{ $alt }} @if ($index < count($category->alts) - 1) , @endif @endforeach @endif</textarea>
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
                                          class="form-control">{{$category->description}}</textarea>
                                @error('description')
                                <p class="text-danger">{{$message}}</p>
                                @enderror
                            </div>
                        </div>
                    </div>
                    <div class="modal-footer d-flex justify-content-end">
                        <button class="btn btn-submit" type="submit">Submit</button>
                    </div>
                </form>
            </div>
        </div>
        <!-- /add -->

            {{-- Seo Meta--}}
            <div class="row">
                <div class="col-xl-12 d-flex">
                    <div class="card flex-fill">
                        <div class="card-header">
                            <h5 class="card-title">Meta Tags</h5>
                        </div>
                        <div class="card-body">
                            <form method="POST" action="{{route('update-meta-category',$category->id)}}">
                                @csrf
                                @method('PUT')
                                <div class="row">
                                    <div class="col-lg-6 col-sm-6 col-12">
                                        <div class="form-group">
                                            <label>Title</label>
                                            <input type="text" name="title" value="{{$meta->title}}" placeholder="Enter Page Title " required />
                                            @error('title')
                                            <p class="text-danger">{{$message}}</p>
                                            @enderror
                                        </div>
                                    </div>
                                    <div class="col-lg-6 col-sm-6 col-12">
                                        <div class="form-group">
                                            <label>Canonical Url </label>
                                            <input type="text" name="canonical_url" value="{{$meta->canonical_url}}" placeholder="Enter Canonical Url"  />
                                            @error('canonical_url')
                                            <p class="text-danger">{{$message}}</p>
                                            @enderror
                                        </div>
                                    </div>
                                    <div class="col-lg-6 col-sm-6 col-12">
                                        <div class="form-group">
                                            <label> Slug Url after ( https://Butchers.com.au/category/ )</label>
                                            <input type="text" name="slug_url" value="{{$category->slug_url}}" required
                                                   placeholder="Enter Slug Url to this product as (Product meat example)"  />
                                            @error('slug_url')
                                            <p class="text-danger">{{$message}}</p>
                                            @enderror
                                        </div>
                                    </div>
                                    <div class="col-lg-6 col-sm-6 col-12">
                                        <div class="form-group">
                                            <label>New Redirection after (https://Butchers.com.au/category/ )</label>
                                            <input type="text" name="new_redirection" value="{{$category->new_redirection}}"
                                                   placeholder="Enter new_redirection to this product (if available)" />
                                            @error('new_redirection')
                                            <p class="text-danger">{{$message}}</p>
                                            @enderror
                                        </div>
                                    </div>

                                    <div class="col-lg-6">
                                        <div class="form-group">
                                            <label> Keyword Content </label>
                                            <select class="form-control tagging js-example-tags"  multiple="multiple" name="keyword[]">
                                                @if($meta->keyword != null)
                                                    @foreach($meta->keyword as  $value)
                                                        <option value="{{$value}}" selected>{{$value}}</option>
                                                    @endforeach
                                                @endif
                                            </select>
                                            @error('keyword')
                                            <p class="text-danger">{{$message}}</p>
                                            @enderror
                                        </div>
                                    </div>
                                    <div class="col-lg-6">
                                        <div class="form-group">
                                            <label> Description Content </label>
                                            <textarea class="form-control" name="description" >{{$meta->description}}</textarea>
                                            @error('description')
                                            <p class="text-danger">{{$message}}</p>
                                            @enderror
                                        </div>
                                    </div>
                                    <div class="col-lg-12">
                                        <div class="form-group">
                                            <label>Add Schema Markup Data </label>
                                            <textarea class="form-control" name="schema_data"  style="height: 200px"
                                                      placeholder="Enter Schema Markup Data to home page" >{{$meta->schema_markup}}</textarea>
                                            @error('schema_data')
                                            <p class="text-danger">{{$message}}</p>
                                            @enderror
                                        </div>
                                    </div>
                                </div>
                                <div class="text-end">
                                    <button type="submit" class="btn btn-primary">Submit</button>
                                </div>
                            </form>
                        </div>
                    </div>
                </div>
            </div>
            {{-- End Seo Section Mata--}}
    </div>
@endsection
@section('js')
    <script>
        $(".js-example-tags").select2({
            tags: true
        });
    </script>
@endsection

