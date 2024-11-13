@extends('Admin.layouts.master')
@section('title') Product - create @endsection
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
                <h4>Product Add</h4>
                <h6>Create new product</h6>
            </div>
        </div>
        <!-- /add -->
        <div class="card">
            <div class="card-body">
                <form method="POST" action="{{route('product-store')}}" enctype="multipart/form-data">
                    @csrf
                    <div class="row">
                        <div class="col-lg-6 col-sm-6 col-12">
                            <div class="form-group">
                                <label>Product Name</label>
                                <input type="text" name="name" value="{{old('name')}}" placeholder="Enter Product Name" required >
                                @error('name')
                                <p class="text-danger">{{$message}}</p>
                                @enderror
                            </div>
                        </div>
                        <div class="col-lg-6 col-sm-6 col-12">
                            <div class="form-group">
                                <label>Category</label>
                                <select class="select form-select" name="category_id" required>
                                    <option selected disabled>Choose Category</option>
                                    @foreach($categories as $category)
                                        <option value="{{$category->id}}">{{$category->name}}</option>
                                    @endforeach
                                </select>
                                @error('category_id')
                                <p class="text-danger">{{$message}}</p>
                                @enderror
                            </div>
                        </div>
{{--                        <div class="col-lg-6 col-sm-6 col-12">--}}
{{--                            <div class="form-group">--}}
{{--                                <label>Slug Url after ( https://Butchers.com.au/products/ )</label>--}}
{{--                                <input type="text" name="slug_url" value="{{old('slug_url')}}" required--}}
{{--                                       placeholder="Enter Slug Url to this product as (Product meat example)"  />--}}
{{--                                @error('slug_url')--}}
{{--                                <p class="text-danger">{{$message}}</p>--}}
{{--                                @enderror--}}
{{--                            </div>--}}
{{--                        </div>--}}
{{--                        <div class="col-lg-6 col-sm-6 col-12">--}}
{{--                            <div class="form-group">--}}
{{--                                <label>New Redirection after (https://Butchers.com.au/products/ )</label>--}}
{{--                                <input type="text" name="new_redirection" value="{{old('canonical_url')}}"--}}
{{--                                       placeholder="Enter new_redirection to this product (if available)"  />--}}
{{--                                @error('new_redirection')--}}
{{--                                <p class="text-danger">{{$message}}</p>--}}
{{--                                @enderror--}}
{{--                            </div>--}}
{{--                        </div>--}}
                        <div class="col-lg-12">
                            <div class="form-group">
                                <label>Product Description </label>
                                <textarea class="form-control" name="description" required></textarea>
                                @error('description')
                                <p class="text-danger">{{$message}}</p>
                                @enderror
                            </div>
                        </div>
                        <div class="col-lg-12">
                            <div class="form-group">
                                <label>	Product Image</label>
                                <div class="image-upload">
                                    <input type="file" name="file[]" multiple accept="image/*" required >
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
                      {{--  <div class="col-lg-12 col-sm-12 col-12">
                            <div class="form-group">
                                <label>Alt Images name (first image, second image , ....)</label>
                                <textarea rows="5" cols="5" name="alts"
                                          placeholder="Enter Alt to each images as : first Alt , Second Alt , Third Alt ..... "
                                          class="form-control">{{old('alts')}}</textarea>
                                @error('alts')
                                <p class="text-danger">{{$message}}</p>
                                @enderror
                            </div>
                        </div>--}}
                    </div>
                    {{-- start main price --}}
                    <h5 class="text-start mb-3">Main Price With Units </h5>
                    <div id="prices" {{--style="max-height: 450px; overflow: scroll"--}}>
                        <div class="price-group">
                                <div class="row">
                                    <div class="col-lg-3  col-12">
                                        <div class="form-group">
                                            <label for="products">Unit </label>
                                            <select name="prices[0][unit_id]" class="select2 form-select unit-select" required>
                                                <option value="">Select Unit</option>
                                                <!-- Populate this dropdown with product options -->
                                                @foreach ($units as $unit)
                                                    <option value="{{ $unit->id }}">{{ $unit->name }}</option>
                                                @endforeach
                                            </select>
                                        </div>
                                    </div>
                                    <div class="col-lg-3  col-12">
                                        <div class="form-group">
                                            <label for="products">Stock </label>
                                            <input type="number" name="prices[0][stock]" step="0.01" min="1" id="totalAmt"
                                                   class="form-control" required
                                                   placeholder="Enter Stock available of Unit {{ isset($unit->name) ? $unit->name : '' }}">
                                        </div>
                                    </div>
                                    <div class="col-lg-2 col-12">
                                        <div class="form-group">
                                            <label for="quantity">Price</label>
                                            <input type="number" name="prices[0][price]" step="0.01" min="1" id="totalAmt"
                                                   class="form-control" required
                                                   placeholder="Enter Price of Unit {{ isset($unit->name) ? $unit->name : '' }}">
                                        </div>
                                    </div>
                                    <div class="col-lg-2  col-12">
                                        <div class="form-group">
                                            <label>G.S.T ( Enter It If Available )</label>
                                            <input type="number" class="form-control" name ="prices[0][gst]"
                                                   min="1" step="0.01" id="totalAmt"
                                                   placeholder="Enter G.S.T of Product If Available">
                                            @error('gst')
                                            <p class="text-danger">{{$message}}</p>
                                            @enderror
                                        </div>
                                    </div>
                                    <div class="col-lg-2  col-12">
                                        <div class="form-group">
                                            <label>Discount(if available) </label>
                                            <input type="number" class="form-control" name="prices[0][discount]"
                                                   min="1" step="0.01" id="totalAmt"
                                                   placeholder="Enter Discount If You Want With ">
                                            @error('discount')
                                                <p class="text-danger">{{$message}}</p>
                                            @enderror
                                        </div>
                                    </div>
                                </div>
                            <button type="button" class="btn btn-sm btn-danger remove-order mb-2"
                                    style="display: none "> Remove </button>
                        </div>
                    </div>
                    <div>
                        <button class="btn btn-sm btn-primary me-2 " id="add-order"   type="button">Add Another</button>
                    </div>

                    {{-- start special price --}}
                    @if($customers)
                    <h5 class="text-start mb-3 mt-3"> Customers Prices</h5>
                    <div id="special_prices" {{--style="max-height: 450px; overflow: auto"--}}>
                        <div class="price-special">
                            <div class="row">
                                <div class="col-lg-4  col-12">
                                    <div class="form-group">
                                        <label for="products">Customer </label>
                                        <select name="special_prices[0][customer_id]" class="select2 form-select customer-select" >
                                            <option value="">Select Customer</option>
                                            <!-- Populate this dropdown with product options -->
                                            @foreach ($customers as $customer)
                                                <option value="{{ $customer->id }}">{{ $customer->name ." ".$customer->mobile }}</option>
                                            @endforeach
                                        </select>
                                    </div>
                                </div>
                                <div class="col-lg-4  col-12">
                                    <div class="form-group">
                                        <label for="products">Unit </label>
                                        <select name="special_prices[0][unit_id]" class="select2 form-select unit-select" >
                                            <option value="">Select Unit</option>
                                            <!-- Populate this dropdown with product options -->
                                            @foreach ($units as $unit)
                                                <option value="{{ $unit->id }}">{{ $unit->name }}</option>
                                            @endforeach
                                        </select>
                                    </div>
                                </div>

                                <div class="col-lg-4 col-12">
                                    <div class="form-group">
                                        <label for="quantity">Price</label>
                                        <input type="number" name="special_prices[0][price]" step="0.01" min="1" id="totalAmt"
                                               class="form-control"
                                               placeholder="Enter Price of Unit {{ isset($unit->name) ? $unit->name : '' }}">
                                    </div>
                                </div>
                            </div>
                            <button type="button" class="btn btn-sm btn-danger remove-special-price mb-2"
                                    style="display: none "> Remove </button>
                        </div>
                    </div>
                    <div>
                        <button class="btn btn-sm btn-primary me-2 " id="add-special-price"   type="button">Add Another</button>
                    </div>
                    @endif

                    <h4 class="text-center mb-3"> Meta Tags to this product ( Write if available )</h4>
                {{--    <div class="row">
                      --}}{{--  <div class="col-lg-6 col-sm-6 col-12">
                            <div class="form-group">
                                <label>Title</label>
                                <input type="text" name="title" value="{{old('title')}}" placeholder="Enter Page Title"/>
                                @error('title')
                                <p class="text-danger">{{$message}}</p>
                                @enderror
                            </div>
                        </div>--}}{{--
                       --}}{{-- <div class="col-lg-6 col-sm-6 col-12">
                            <div class="form-group">
                                <label>Canonical Url after (https://aitech.net.au/butcher/products/)</label>
                                <input type="text" name="canonical_url"  value="https://aitech.net.au/butcher/products/"
                                       placeholder="Enter Canonical Url"  />
                                @error('canonical_url')
                                <p class="text-danger">{{$message}}</p>
                                @enderror
                            </div>
                        </div>--}}{{--
                        <div class="col-lg-6">
                            <div class="form-group">
                                <label> Keyword Content ( write keywords tags )  </label>
                                <select class="form-control tagging product-tags"  multiple="multiple" name="keyword[]">

                                </select>
                                @error('keyword')
                                <p class="text-danger">{{$message}}</p>
                                @enderror
                            </div>
                        </div>
                        <div class="col-lg-6">
                            <div class="form-group">
                                <label> Description Content </label>
                                <textarea class="form-control" name="description_meta" >{{old('description')}}</textarea>
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
    <script>
        $(".product-tags").select2({
            tags: true
        });
    </script>
    <script src="{{asset('assets/dashboard/js/dashboard/price.js')}}"></script>

@endsection
