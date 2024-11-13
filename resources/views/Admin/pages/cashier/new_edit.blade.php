@extends('Admin.layouts.master')
@section('main_head')
    <div class="page-title font-medium ">
        <h4>Edit - Order</h4>
    </div>
@endsection
@section('title') Edit - Invoice @endsection
@section('css')
    <!-- Owl Carousel CSS -->
    <link rel="stylesheet" href="{{asset('assets/dashboard/plugins/owlcarousel/owl.carousel.min.css')}}">
    <link rel="stylesheet" href="{{asset('assets/dashboard/plugins/owlcarousel/owl.theme.default.min.css')}}">
    <link rel="stylesheet" href="{{asset('assets/dashboard/flatpickr/flatpickr.min.css')}}">
    <link rel="stylesheet" href="{{asset('assets/dashboard/@simonwep/pickr/themes/nano.min.css')}}">
    <style>
        .content{
            padding: 10px !important;
        }
        .card-image{
            height: 80px;
            object-fit: cover;
            width: 100%;
        }
        .tabs_wrapper ul.tabs {
            margin-bottom: 10px;
        }
        .product-details {
            height: auto;
            min-height: 120px;
        }
        .product-details img{
            max-height: 60px;
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
        <div class="d-flex flex-column flex-column-reverse flex-lg-row mt-1">
            <div class="col-lg-8 col-sm-12 tabs_wrapper">
                <div class="page-header" style="margin-bottom: 0">
                    <div class="page-title">
                        <h4>Cashier Page</h4>
                        <h6>Manage your purchases</h6>
                    </div>
                </div>

                <ul class="tabs owl-carousel owl-theme owl-product border-0">
                    @if(isset($products) && count($products) > 0)
                        <li id="recommended" class="active" style="background-color: #fe9f43 !important;">
                            <div class="product-details"  style="background-color: #fe9f43 !important;" >
                                {{--  <img src="{{ asset('storage/category/recommended.jpg') }}" alt="img">--}}
                                <h6 style="color: #ffffff;font-weight: 700; font-size: 1em">{{ Illuminate\Support\Str::limit($mobile->name, 7) }}</h6>
                            </div>
                        </li>
                    @endif
                    {{-- categories--}}
                    @foreach($categories as $category)
                        <li id="{{$category->name.$category->id}}">
                            <div class="product-details" style="background-color: whitesmoke">
                                @foreach($category->images as $image)
                                    @if($loop->first)
                                        <img src="{{ asset('storage/' . $image) }}" alt="img">
                                    @endif
                                @endforeach
                                <h6 style="color: #1a1e21">{{$category->name}}</h6>
                            </div>
                        </li>
                    @endforeach
                </ul>

                <!-- products -->
                <div class="tabs_container" style="height: 71vh;overflow-y:auto;overflow-x: hidden "  id="page_content">
                    @foreach($categories as $category)
                        <div  class="tab_content @if($loop->first) @if(isset($products) && count($products) > 0 ) @else active @endif  @endif"
                              data-tab="{{$category->name.$category->id}}">
                            <div class="row">
                                @if($category->products->isNotEmpty())
                                    @foreach($category->products as $product)
                                        <div class="col-xl-3 col-md-4 col-sm-6 col-12 mb-0">
                                            <div class="productset flex-fill active">
                                                <div class="productsetimg">
                                                    @foreach($product->images as $image)
                                                        @if($loop->first)
                                                            <img src="{{asset('storage/'.$image)}}"  class="card-image img-fluid" alt="img">
                                                        @endif
                                                    @endforeach
                                                    @foreach($product->prices as $price)
                                                        @if($loop->first)
                                                            <h6>Qty: {{$price->stock}} </h6>
                                                        @endif
                                                    @endforeach
                                                </div>
                                                <div class="productsetcontent">
                                                    <div class="d-flex align-items-center justify-content-between my-2">
                                                        <div class="text-start">
                                                            <h5> {{ $category->name }}</h5>
                                                            <h4 class="m-0">{{$product->name}}</h4>
                                                        </div>
                                                        <div class="price">
                                                            <h4 class="selectedPrice fs-5 m-0 text-danger fw-bold">${{ $product->prices[0]->price }}</h4>
                                                        </div>
                                                    </div>
                                                    <div class="d-flex justify-content-between gap-2 flex-nowrap add-to-cart-button">
                                                        <div class="unit w-100">
                                                            <select class="form-select select-product">
                                                                @foreach($product->prices as $price)
                                                                    <option value="{{ $price->unit_id }}" data-price="{{ $price->price }}">{{ $price->unit->name }}</option>
                                                                @endforeach
                                                            </select>
                                                        </div>
                                                        <input type="text" class="form-control quantity text-center" value="{{$order->orderDetails()->whereProductId($product->id)->value('quantity')}}"  placeholder="weight">
                                                        <input type="hidden" name="order_id" id="order_id" value="{{$order->id}}">
                                                    </div>
                                                    <div style="margin-top:10px; width: 100%">
                                                        <button class="btn btn-primary addToCart d-block w-100" data-product="{{$product->id}}">Add</button>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                    @endforeach
                                @endif
                            </div>
                        </div>
                    @endforeach

                    @if(isset($products) && count($products) > 0 )
                        <div  class="tab_content active" style="height: 71vh;overflow-y:auto;overflow-x: hidden "  data-tab="recommended">
                            <div class="row">
                                @foreach($products as $product)
                                    <div class="col-xl-3 col-md-4 col-sm-6 col-12 mb-0">
                                        <div class="productset flex-fill active">
                                            <div class="productsetimg">
                                                @foreach($product->images as $image)
                                                    @if($loop->first)
                                                        <img src="{{asset('storage/'.$image)}}"   class="card-image img-fluid" alt="img">
                                                    @endif
                                                @endforeach
                                                @foreach($product->prices as $price)
                                                    @if($loop->first)
                                                        <h6>Stock: {{$price->stock}} </h6>
                                                    @endif
                                                @endforeach
                                            </div>
                                            <div class="productsetcontent">
                                                <div class="d-flex align-items-center justify-content-between my-2">
                                                    <div class="text-start">
                                                        <h5> {{ $category->name }}</h5>
                                                        <h4 class="m-0">{{$product->name}}</h4>
                                                    </div>
                                                    <div class="price">
                                                        <h4 class="selectedPrice fs-5 m-0 text-danger fw-bold">${{ $product->specialPrices[0]->price }}</h4>
                                                    </div>
                                                </div>
                                                <div class="d-flex justify-content-between gap-2 flex-nowrap add-to-cart-button">
                                                   <div class="unit w-100">
                                                        <select class="form-select select-product">
                                                            @foreach($product->specialPrices  as $special_price)
                                                                <option value="{{ $special_price->unit_id }}" data-price="{{ $special_price->price }}">{{ $special_price->unit->name }}</option>
                                                            @endforeach
                                                        </select>
                                                    </div>
                                                    <input type="text" class="form-control quantity text-center" value="{{$order->orderDetails()->whereProductId($product->id)->value('quantity')}}"   placeholder="weight" required>
                                                </div>
                                                <input type="hidden" name="order_id" id="order_id" value="{{$order->id}}">
                                                <div style="margin-top:10px; width: 100%">
                                                    <button class="btn btn-primary addToCart d-block w-100" data-product="{{$product->id}}">Add</button>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                @endforeach
                            </div>
                        </div>
                    @endif
                </div>
            </div>

            <div class="col-lg-4 col-sm-12 ">
                <div class="card card-order">
                    <div class="card-body" style="padding: 0">
                        {{-- add customers --}}
                        <div class="row">
                            <div class="col-12 page-btn">
                               {{-- <a class="btn btn-added" style="float: right" data-bs-toggle="modal" data-bs-target="#create">
                                    <img src="{{asset('assets/dashboard/img/icons/plus.svg')}}"
                                         alt="img">
                                    Add New Customer
                                </a>
                                --}}{{-- create Customer --}}{{--
                                <div class="modal fade" id="create" tabindex="-1" aria-labelledby="create"
                                     aria-hidden="true">
                                    <div class="modal-dialog modal-lg modal-dialog-centered" role="document">
                                        <div class="modal-content">
                                            <div class="modal-header" style="background-color: #FF9F43;" >
                                                <h5 class="modal-title text-white" >New Customer</h5>
                                                <button type="button" class="close" data-bs-dismiss="modal" aria-label="Close">
                                                    <span aria-hidden="true">×</span>
                                                </button>
                                            </div>
                                            <form method="POST" action="{{route('store-customer')}}" >
                                                @csrf
                                                <div class="modal-body">
                                                    <div class="row">
                                                        <div class="col-lg-6 col-sm-12 col-12">
                                                            <div class="form-group">
                                                                <label>Name</label>
                                                                <input type="text" name="name" required  placeholder="Enter Customer Name" >
                                                                @error('name')
                                                                <p class="text-danger">{{$message}}</p>
                                                                @enderror
                                                            </div>
                                                        </div>
                                                        <div class="col-lg-6 col-sm-12 col-12">
                                                            <div class="form-group">
                                                                <label> A.B.N</label>
                                                                <input type="text" class="form-control"  name="abn"
                                                                       placeholder="Enter  A.B.N Number of Business">
                                                                @error('abn')
                                                                <p class="text-danger">{{$message}}</p>
                                                                @enderror
                                                            </div>
                                                        </div>
                                                        <div class="col-lg-6 col-sm-12 col-12">
                                                            <div class="form-group">
                                                                <label> Mobile</label>
                                                                <input type="text" class="form-control" required name="mobile"
                                                                       placeholder="Enter Mobile Number">
                                                                @error('mobile')
                                                                <p class="text-danger">{{$message}}</p>
                                                                @enderror
                                                            </div>
                                                        </div>
                                                    </div>

                                                    <div class="row">
                                                        <div class="col-lg-6 col-sm-12 col-12">
                                                            <div class="form-group">
                                                                <label>State</label>
                                                                <input type="text" name="state" required  placeholder="Enter Customer  Address State" >
                                                                @error('state')
                                                                <p class="text-danger">{{$message}}</p>
                                                                @enderror
                                                            </div>
                                                        </div>
                                                        <div class="col-lg-6 col-sm-12 col-12">
                                                            <div class="form-group">
                                                                <label> City</label>
                                                                <input type="text" class="form-control" required name="city"
                                                                       placeholder="Enter Customer Address City ">
                                                                @error('city')
                                                                <p class="text-danger">{{$message}}</p>
                                                                @enderror
                                                            </div>
                                                        </div>
                                                        <div class="col-lg-6 col-sm-12 col-12">
                                                            <div class="form-group">
                                                                <label>Post Code</label>
                                                                <input type="text" name="post_code" required
                                                                       placeholder="Enter Customer valued Address Post Code " >
                                                                @error('post_code')
                                                                <p class="text-danger">{{$message}}</p>
                                                                @enderror
                                                            </div>
                                                        </div>
                                                        <div class="col-lg-6 col-sm-12 col-12">
                                                            <div class="form-group">
                                                                <label>Address Details</label>
                                                                <input type="text" class="form-control" required name="address"
                                                                       placeholder="Enter customer Address Details">
                                                                @error('address')
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
                                </div>--}}
                            </div>


                                {{-- customer --}}
                                <div class="col-lg-12">
                                    <div class="mb-3">
                                        <div class="select-group w-100">
                                            <form id="customerForm" action="{{ route('newIndex') }}" method="GET">
                                                <select  class="js-example select2" name="customer" required  id="customerSelect">
                                                    <option selected disabled>Choose Customer</option>
                                                    @foreach($customers as $customer)
                                                        <option value="{{$customer->mobile}}" @if($order->mobile == $customer->mobile) selected @endif @if(isset($mobile) && $mobile !=null) @if($mobile->mobile ==$customer->mobile ) selected @endif @endif >{{$customer->name. '(' . $customer->mobile . ")"}}</option>
                                                    @endforeach
                                                </select>
                                            </form>
                                        </div>
                                    </div>
                                </div>

                            {{-- Address --}}
                            <input type="hidden" name="customer_id" id="customer_id" value="" form="submit_form">
                            <div class="col-lg-12">
                                <div class="mb-3">
                                    <div class="select-group w-100">
                                        <select class="select form-select" name="address_id" id="address_id" form="submit_form">
                                           {{-- <option  disabled>Choose Address</option>--}}
                                            @if(isset($addresses) && $addresses !=null)
                                                @foreach($addresses as $address)
                                                    <option value="{{$address->id}}">{{$address->address. ', ' . $address->city . ', ' . $address->state . ' ' . $address->post_code}}</option>
                                                @endforeach
                                            @else
                                                @if(isset($order->address) && $order->address !=null)
                                                <option value="{{$order->address_id}}" >{{$order->address->address. ', ' . $order->address->city . ', ' . $order->address->state . ' ' . $order->address->post_code}}</option>
                                                @endif
                                            @endif
                                        </select>
                                    </div>
                                </div>
                            </div>

                            {{-- Delivery --}}
                            <div class="col-lg-12" >
                                <div class="mb-3">
                                    <div class="select-group w-100">
                                        <select class="select form-select" form="submit_form"  name="delivery_id" >
                                            <option selected disabled>Choose Delivery</option>
                                            @foreach($deliveries as $delivery)
                                                <option value="{{$delivery->id}}" @if($order->delivery_id == $delivery->id) selected @endif>{{$delivery->name}}</option>
                                            @endforeach
                                        </select>
                                    </div>
                                </div>
                            </div>
                            <div class="col-lg-12">
                                <div class="mb-3">
                                    <div class="form-group">
                                        <input type="text" class="form-control" id="datetime_paid" form="submit_form"
                                               name="created_at"  value="{{$order->created_at}}"
                                               placeholder="Invoice Date ">
                                    </div>
                                </div>

                        </div>
                    </div>

                    <div class="order-3" id="cartdetails">
                    @php
                        $id = $order->id;
                        $orderData = \App\Models\Order::findOrFail($id);
                    @endphp
                        @if($orderData)
                            <div class="card-body pt-0">
                                <div class="totalitem">
                                    <h4>Total items :{{$orderData->orderDetails->count()}} </h4>
                                    {{-- <a href="javascript:void(0);">Clear all</a>--}}
                                </div>
                                <div class="product-table cart-products ">
                                    {{-- products on cart added from response ajax--}}
                                    @foreach($orderData->orderDetails()->latest('id')->get() as $data)
                                        <ul class="product-lists" style="padding: 0">
                                            <li>
                                                <div class="productimg">
                                                    @foreach($data->product->images as $image)
                                                        @if($loop->first)
                                                            <div class="productimgs">
                                                                <img src="{{asset('storage/'.$image)}}" alt="img">
                                                            </div>
                                                        @endif
                                                    @endforeach
                                                    <div class="productcontet">
                                                        <h4>{{$data->product->name}}
                                                            <a href="javascript:void(0);" class="ms-2" data-bs-toggle="modal" data-bs-target="#edit"><img src="assets/img/icons/edit-5.svg" alt="img"></a>
                                                        </h4>
                                                        <div class="productlinkset">
                                                            <h5>{{$data->unit->name}}</h5>
                                                        </div>
                                                        <div class="increment-decrement">
                                                            <div class="input-groups">
                                                                <p> Price : {{$data->price}}</p>
                                                            </div>
                                                        </div>
                                                    </div>
                                                </div>
                                            </li>

                                            {{--<li><strong>WT : </strong>{{$data->quantity}} </li>--}}
                                            <li class="d-flex align-items-center gap-2 me-2">
                                                <span><strong>WT : </strong>{{$data->quantity}}</span>
                                                <a class="deleteproduct" data-detail="{{$data->id}}" ><img src="{{asset('assets/dashboard/img/icons/delete-2.svg')}}" alt="img"></a>
                                            </li>
                                        </ul>
                                    @endforeach
                                </div>
                            </div>

                            <div class="split-card">
                            </div>
                            <div class="card-body pt-0 pb-2 checkout_cart">
                                <div class="setvalue" id="total-cart">
                                    <ul>
                                        <li class="total-value border-bottom pb-2">
                                            <h5>Total items </h5>
                                            <h6>{{$orderData->orderDetails->count()}}</h6>
                                        </li>
                                        <li class="total-value">
                                            <h5>Total price  </h5>
                                            <h5 class="text-danger">{{$orderData->total}}$</h5>
                                        </li>
                                    </ul>
                                </div>
                                <form method="POST" action="{{route('confirm-update-checkout',$orderData->id)}}" id="submit_form">
                                    @csrf
                                    <button class="bt btn-primary w-100 text-center" style="padding: 10px;border: 10px; border-radius: 10px" type="submit"><strong>Confirm CheckOut</strong></button>
                                </form>
                            </div>
                        @endif
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
@section('js')
    <!-- Owl JS -->
    <script src="{{asset('assets/dashboard/plugins/owlcarousel/owl.carousel.min.js')}}"></script>
    <script src="{{asset('assets/dashboard/flatpickr/flatpickr.min.js')}}"></script>
    <script src="{{asset('assets/dashboard/js/date&time_pickers.js')}}"></script>
    <script>
        $(".js-example").select2({
            tags: true,
        });

        var url = window.location.href;

        // Function to extract phone number starting with +2B from URL
        function extractPhoneNumberFromUrl(url) {
            // Find the index of '%' character
            var percentIndex = url.indexOf('=');
            // If '%' character exists
            if (percentIndex !== -1) {
                // Extract the substring after '%'
                var phoneNumberSubstring = url.substring(percentIndex + 1);

                // Find the index of '&' character (or end of string)
                var ampersandIndex = phoneNumberSubstring.indexOf('&');

                // If '&' character exists, extract substring before '&'
                if (ampersandIndex !== -1) {
                    return phoneNumberSubstring.substring(0, ampersandIndex);
                } else {
                    // If '&' character doesn't exist, return the whole substring
                    return phoneNumberSubstring;
                }
            } else {
                // If '%' character doesn't exist, return null
                return null;
            }
        }

        // Get the phone number from the URL
        var phoneNumber = decodeURIComponent(extractPhoneNumberFromUrl(url));

        document.getElementById('customer_id').value=phoneNumber



        $(document).ready(function() {
            /* price show depend on unit selected*/
            $(document).on('change', '.select-product', function () {
                var selectedPrice = $(this).find('option:selected').data('price');
                $(this).closest('.productsetcontent').find('.selectedPrice').text(selectedPrice + '$');
            });

            $('.addToCart').on('click', function () {
                var productId = $(this).data('product');
                var unitId = $(this).closest('.productsetcontent').find('.select-product').val();
                console.log("Product ID:", productId);
                console.log("Selected Unit ID:", unitId);
            });

            $('#customerSelect').on('change', function () {
                $('#customerForm').submit();
            });
            $('#address_id').change(function() {
                // Get the selected value
                var selectedAddressId = $(this).val();

                // Set the value of the hidden input field to the selected value
                $('#customer_id').val(selectedAddressId);
            });


        });
    </script>
    @include('Admin.pages.cashier.scripts.address_customer')
    @include('Admin.pages.cashier.scripts.add_to_order')
@endsection
