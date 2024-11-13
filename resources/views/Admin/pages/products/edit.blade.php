@extends('Admin.layouts.master')
@section('main_head')
    <div class="page-title font-medium ">
        <h4>Product - Edit</h4>
    </div>
@endsection
@section('title') Product - Edit @endsection
@section('css')
    <style>
        .content{
            padding: 10px !important;
        }
        div.dataTables_wrapper div.dataTables_filter {
            width: 200px;
            float: right;
            margin-top: -65px;
            margin-right: 100px;
            z-index: 100;
            /* display: flex; */
            position: absolute;
            right: 0%;
            top: 87px;
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
                <form method="POST" action="{{route('product-update',$product->id)}}" enctype="multipart/form-data">
                    @csrf
                    @method('PUT')
                    <input type="hidden" name="id" value="{{$product->id}}">
                    <div class="row">
                        <div class="col-lg-6  col-12">
                            <div class="form-group">
                                <label>Product Name</label>
                                <input type="text" name="name" value="{{$product->name}}" placeholder="Enter Product Name" required >
                                @error('name')
                                <p class="text-danger">{{$message}}</p>
                                @enderror
                            </div>
                        </div>
                        <div class="col-lg-3  col-12">
                            <div class="form-group">
                                <label>Category</label>
                                <select class="select form-select" name="category_id" required>
                                    <option selected disabled>Choose Category</option>
                                    @foreach($categories as $category)
                                        <option value="{{$category->id}}"
                                        @if($category->id == $product->category_id) selected @endif>{{$category->name}}</option>
                                    @endforeach
                                </select>
                                @error('category_id')
                                <p class="text-danger">{{$message}}</p>
                                @enderror
                            </div>
                        </div>
                        <div class="col-lg-3  col-12">
                            <div class="form-group">
                                <label>Status</label>
                                <select class="select form-select" name="status" required>
                                    <option selected disabled>Choose Status</option>
                                        <option value="1" @if($product->status == 1) selected @endif>Active</option>
                                        <option value="0" @if($product->status == 0) selected @endif>InActive</option>
                                </select>
                                @error('status')
                                    <p class="text-danger">{{$message}}</p>
                                @enderror
                            </div>
                        </div>
                        <div class="col-lg-12">
                            <div class="form-group">
                                <label>Description </label>
                                <textarea class="form-control" name="description" required>{{$product->description}}</textarea>
                                @error('description')
                                <p class="text-danger">{{$message}}</p>
                                @enderror
                            </div>
                        </div>
                        <div class="col-lg-12">
                            <label>Current Images </label>
                            <div class="d-flex justify-content-center  gap-3 items-stretch">
                                @foreach($product->images as $image)
                                    <img src="{{asset('storage/'.$image)}}" alt="product" title="product"
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
                                        <h4>Drag and drop a file or Multi to Updated</h4>
                                    </div>
                                    @error('file')
                                    <p class="text-danger">{{$message}}</p>
                                    @enderror
                                </div>
                            </div>
                        </div>
                        <div class="col-lg-12 col-sm-12 col-12">
                            <div class="form-group">
                                <label>Alt Images name (first image, second image , ....)</label>
                                <textarea rows="5" cols="5" name="alts"
                                          placeholder="Enter Alt to each images as : first Alt , Second Alt , Third Alt ..... "
                                          class="form-control">@if($product->alts != null) @foreach($product->alts as $index => $alt){{ $alt }} @if($index < count($category->alts ?? []) - 1) , @endif @endforeach @endif</textarea>
                                @error('alts')
                                <p class="text-danger">{{$message}}</p>
                                @enderror
                            </div>
                        </div>
                        {{-- product prices --}}
                        <div id="prices" style="max-height: 450px; overflow: scroll">
                            @foreach($product->prices as $index => $price)
                                <div class="price-group">
                                    <div class="row">
                                        <div class="col-lg-3 col-12">
                                            <div class="form-group">
                                                <label for="products">Unit </label>
                                                <select name="prices[{{$index}}][unit_id]" class="select2 form-select" required>
                                                    <option value="">Select Unit</option>
                                                    @foreach ($units as $unit)
                                                        <option value="{{ $unit->id }}" {{ $price->unit_id == $unit->id ? 'selected' : '' }}>{{ $unit->name }}</option>
                                                    @endforeach
                                                </select>
                                            </div>
                                        </div>
                                        <div class="col-lg-3  col-12">
                                            <div class="form-group">
                                                <label for="products">Stock </label>
                                                <input type="number" name="prices[{{$index}}][stock]" step="0.01" id="totalAmt"
                                                       class="form-control"  value="{{$price->stock}}"
                                                       placeholder="Enter Stock available of Unit {{$unit->name}}">
                                            </div>
                                        </div>
                                        <div class="col-lg-2 col-12">
                                            <div class="form-group">
                                                <label for="quantity">Price</label>
                                                <input type="number" name="prices[{{$index}}][price]" step="0.01" min="1" id="totalAmt"
                                                       class="form-control" required value="@if($price->price > 0){{$price->price}}@endif"
                                                       placeholder="Enter Price of Unit {{$unit->name}}">
                                            </div>
                                        </div>
                                        <div class="col-lg-2  col-12">
                                            <div class="form-group">
                                                <label>G.S.T ( Enter It If Available )</label>
                                                <input type="number" class="form-control" name ="prices[{{$index}}][gst]"
                                                       min="1" step="0.01" id="totalAmt" value="@if($price->gst > 0){{$price->gst}}@endif"
                                                       placeholder="Enter G.S.T of Product If Available">
                                                @error('gst')
                                                <p class="text-danger">{{$message}}</p>
                                                @enderror
                                            </div>
                                        </div>
                                        <div class="col-lg-2  col-12">
                                            <div class="form-group">
                                                <label>Discount(if available) </label>
                                                <input type="number" class="form-control" name="prices[{{$index}}][discount]"
                                                       min="1" step="0.01" id="totalAmt" value="@if($price->discount >0){{$price->discount}}@endif"
                                                       placeholder="Enter Discount If You Want With ">
                                                @error('discount')
                                                    <p class="text-danger">{{$message}}</p>
                                                @enderror
                                            </div>
                                        </div>
                                    </div>
                                        <button type="button" class="btn btn-sm btn-danger remove-order mb-2" style="display: none ">Remove</button>
                                </div>
                            @endforeach
                        </div >
                        <div>
                            <button class="btn btn-sm btn-primary me-2 " id="add-order"  type="button">Add Another</button>
                        </div>
                        {{-- special prices --}}
                        <h5 class="text-start mb-3 mt-3"> Customers Prices</h5>
                        @if($product->specialPrices->count() > 0)
                            <div id="special_prices_edit" style="max-height: 450px; overflow: scroll">
                                @foreach($product->specialPrices as $key => $special_price)
                                    <div class="price-special_edit">
                                        <div class="row">
                                            <div class="col-lg-4  col-12">
                                                <div class="form-group">
                                                    <label for="products">Customer </label>
                                                    <select name="special_prices[{{$key}}][customer_id]" class="select2 form-select customer-select" required>
                                                        <option value="">Select Customer</option>
                                                        <!-- Populate this dropdown with product options -->
                                                        @foreach ($customers as $customer)
                                                            <option value="{{ $customer->id }}" {{ $special_price->customer_id == $customer->id ? 'selected' : '' }}>{{ $customer->name ." ".$customer->mobile }}</option>
                                                        @endforeach
                                                    </select>
                                                </div>
                                            </div>
                                            <div class="col-lg-4  col-12">
                                                <div class="form-group">
                                                    <label for="products">Unit </label>
                                                    <select name="special_prices[{{$key}}][unit_id]" class="select2 form-select unit-select" required>
                                                        <option value="">Select Unit</option>
                                                        <!-- Populate this dropdown with product options -->
                                                        @foreach ($units as $unit)
                                                            <option value="{{ $unit->id }}" {{ $special_price->unit_id == $unit->id ? 'selected' : '' }}>{{ $unit->name }}</option>
                                                        @endforeach
                                                    </select>
                                                </div>
                                            </div>

                                            <div class="col-lg-4 col-12">
                                                <div class="form-group">
                                                    <label for="quantity">Price</label>
                                                    <input type="number" name="special_prices[{{$key}}][price]" step="0.01" min="1" id="totalAmt2"
                                                           class="form-control" required value="@if($special_price->price > 0){{$special_price->price}}@endif"
                                                           placeholder="Enter Price of Unit {{$unit->name}}">
                                                </div>
                                            </div>
                                        </div>
                                        <button type="button" class="btn btn-sm btn-danger remove-special-price-edit mb-2"
                                                style="display: none "> Remove </button>
                                    </div>
                                @endforeach
                            </div>
                            <div>
                                <button class="btn btn-sm btn-primary me-2 " id="add-special-price"   type="button">Add Another</button>
                            </div>
                        @else
                            <div id="special_prices" style="max-height: 450px; overflow: scroll">
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
                                                       placeholder="Enter Price of Unit {{$unit->name}}">
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
                        <div class="row">
                            <div class="col-lg-12 d-flex justify-content-end">
                                <button class="btn btn-submit me-2" type="submit">Submit</button>
                            </div>
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
                            <form method="POST" action="{{route('update-meta-product',$product->id)}}">
                                @csrf
                                @method('PUT')
                                <div class="row">
                                    <div class="col-lg-6 col-sm-6 col-12">
                                        <div class="form-group">
                                            <label>Title</label>
                                            <input type="text" name="title" value="{{$meta->title}}" placeholder="Enter Page Title "  />
                                            @error('title')
                                            <p class="text-danger">{{$message}}</p>
                                            @enderror
                                        </div>
                                    </div>
                                    <div class="col-lg-6 col-sm-6 col-12">
                                        <div class="form-group">
                                            <label>Canonical Url after (https://aitech.net.au/butcher/products/) </label>
                                            <input type="text" name="canonical_url" value="{{$meta->canonical_url}}"
                                                   placeholder="Enter Canonical Url"  />
                                            @error('canonical_url')
                                            <p class="text-danger">{{$message}}</p>
                                            @enderror
                                        </div>
                                    </div>
                                    <div class="col-lg-6 col-sm-6 col-12">
                                        <div class="form-group">
                                            <label> Slug Url after ( https://Butchers.com.au/products/ )</label>
                                            <input type="text" name="slug_url" value="{{$product->slug_url}}"
                                                   placeholder="Enter Slug Url to this product as (Product meat example)"  />
                                            @error('slug_url')
                                            <p class="text-danger">{{$message}}</p>
                                            @enderror
                                        </div>
                                    </div>
                                    <div class="col-lg-6 col-sm-6 col-12">
                                        <div class="form-group">
                                            <label>New Redirection after (https://Butchers.com.au/products/ )</label>
                                            <input type="text" name="new_redirection" value="{{$product->new_redirection}}"
                                                   placeholder="Enter new_redirection to this product (if available)" />
                                            @error('new_redirection')
                                            <p class="text-danger">{{$message}}</p>
                                            @enderror
                                        </div>
                                    </div>
                                    <div class="col-lg-6">
                                        <div class="form-group">
                                            <label> Keyword Content ( write keywords tags ) </label>
                                            <select class="form-control product-tags"  multiple="multiple" name="keyword[]">
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
                                            <textarea class="form-control" name="description"  >{{$meta->description}}</textarea>
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
        $(".product-tags").select2({
            tags: true
        });
        let productPrice = @json($product->prices->count());
        let productSpecialPrice = @json($product->specialPrices->count())
    </script>

    <script src="{{asset('assets/dashboard/js/dashboard/edit_special_price.js')}}"></script>
@endsection

