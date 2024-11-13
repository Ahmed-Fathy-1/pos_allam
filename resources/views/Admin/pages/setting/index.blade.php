@extends('Admin.layouts.master')
@section('main_head')
    <div class="page-title font-medium ">
        <h4> Settings </h4>
    </div>
@endsection
@section('title') setting @endsection
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
                <form method="POST" action="{{route('setting-update')}}" enctype="multipart/form-data">
                    @csrf
                    @method('PUT')
                    <div class="row">
                        <div class="col-lg-6 col-sm-12 col-12">
                            <div class="form-group">
                                <label> Site Name</label>
                                <input type="text" name="site_name" value="{{$setting['site_name']}}"
                                       placeholder="Enter Time That Site name" required >
                                @error('site_name')
                                <p class="text-danger">{{$message}}</p>
                                @enderror
                            </div>
                        </div>
                        <div class="col-lg-6 col-sm-12 col-12">
                            <div class="form-group">
                                <label> Open - Today ( hourly )</label>
                                <input type="text" name="open_today" value="{{$setting['open_today']}}"
                                       placeholder="Enter Time That available For customers  (8 AM -  9 PM)" required >
                                @error('open_today')
                                <p class="text-danger">{{$message}}</p>
                                @enderror
                            </div>
                        </div>
                        <div class="col-lg-6 col-sm-12 col-12">
                            <div class="form-group">
                                <label> Phone </label>
                                <input type="text" name="mobile" value="{{$setting['mobile']}}"
                                       placeholder="Enter Time That available mobile" required >
                                @error('mobile')
                                <p class="text-danger">{{$message}}</p>
                                @enderror
                            </div>
                        </div>
                        <div class="col-lg-6 col-sm-12 col-12">
                            <div class="form-group">
                                <label> A.B.N </label>
                                <input type="text" name="abn" value="{{$setting['abn']}}"
                                       placeholder="Enter valued A.B.N" required >
                                @error('abn')
                                <p class="text-danger">{{$message}}</p>
                                @enderror
                            </div>
                        </div>
                        <div class="col-lg-6 col-sm-12 col-12">
                            <div class="form-group">
                                <label> Email </label>
                                <input type="email" class="form-control" name="email" value="{{$setting['email']}}"
                                       placeholder="Enter valued email" required >
                                @error('email')
                                <p class="text-danger">{{$message}}</p>
                                @enderror
                            </div>
                        </div>

                        <div class="col-lg-6 col-sm-12 col-12">
                            <div class="form-group">
                                <label> Amount Removing $</label>
                                <input type="number" class="form-control" name="amount_remove" value="{{$setting['amount_remove']}}" min="0" step="0.1"
                                       placeholder="Enter Shipping if you want to added  Range That That Delivery Will Take">
                                @error('amount_remove')
                                <p class="text-danger">{{$message}}</p>
                                @enderror
                            </div>
                        </div>
                        <div class="col-lg-6 col-sm-12 col-12">
                            <div class="form-group">
                                <label> Shipping Delivery (A.U.D)</label>
                                <input type="number" class="form-control" name="shipping" value="{{$setting['shipping']}}"
                                       placeholder="Enter Shipping if you want to added  Range That That Delivery Will Take">
                                @error('shipping')
                                <p class="text-danger">{{$message}}</p>
                                @enderror
                            </div>
                        </div>
                        <div class="col-lg-6 col-sm-12 col-12">
                            <div class="form-group">
                                <label> facebook link </label>
                                <input type="text" name="facebook_link" value="{{$setting['facebook_link']}}"
                                       placeholder="Enter Social facebook link if available"  >
                                @error('facebook_link')
                                <p class="text-danger">{{$message}}</p>
                                @enderror
                            </div>
                        </div>
                        <div class="col-lg-6 col-sm-12 col-12">
                            <div class="form-group">
                                <label> Instagram link </label>
                                <input type="text" name="instagram_link" value="{{$setting['instagram_link']}}"
                                       placeholder="Enter Social Instagram link if available"  >
                                @error('instagram_link')
                                <p class="text-danger">{{$message}}</p>
                                @enderror
                            </div>
                        </div>
                        <div class="col-lg-6 col-sm-12 col-12">
                            <div class="form-group">
                                <label> Twitter link </label>
                                <input type="text"  name="twitter_link" value="{{$setting['twitter_link']}}"
                                       placeholder="Enter Social Twitter link if available"  >
                                @error('twitter_link')
                                <p class="text-danger">{{$message}}</p>
                                @enderror
                            </div>
                        </div>
                        @if($setting['logo'] !=null)
                            <div class="col-lg-6 col-sm-12 col-12">
                                <div class="form-group">
                                    <label> Old logo</label>
                                    <img width="50" src="{{asset('storage/'.$setting['logo'])}}" >
                                </div>
                            </div>
                        @endif
                        <div class="col-lg-6 col-sm-12 col-12">
                            <div class="form-group">
                                <label> Logo </label>
                                <input type="file"  class="form-group" name="logo"
                                       placeholder="Enter Logo if available " >
                                @error('logo')
                                <p class="text-danger">{{$message}}</p>
                                @enderror
                            </div>
                        </div>
                        <div class="col-lg-12">
                            <div class="form-group">
                                <label>Address </label>
                                <textarea class="form-control" name="address" maxlength="250"
                                          required placeholder="Enter Current  address ">{{$setting['address']}}</textarea>
                                @error('address')
                                <p class="text-danger">{{$message}}</p>
                                @enderror
                            </div>
                        </div>

                        <div class="col-lg-12 d-flex justify-content-end">
                            <button class="btn btn-submit me-2" type="submit">Submit</button>
                        </div>
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
                        <form method="POST" action="{{route('meta-update')}}">
                            @csrf
                            <input type="hidden" name="page_id" value="{{$meta->page_id}}">
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
                                        <input type="text" name="canonical_url" value="{{$meta->canonical_url}}" placeholder="Enter Canonical Url"/>
                                        @error('canonical_url')
                                        <p class="text-danger">{{$message}}</p>
                                        @enderror
                                    </div>
                                </div>
                                <div class="col-lg-6">
                                    <div class="form-group">
                                        <label> Keyword Content tags </label>
                                        <select class="form-control tagging home-tags"  multiple="multiple" name="keyword[]">
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
        $(".home-tags").select2({
            tags: true
        });
    </script>
@endsection

