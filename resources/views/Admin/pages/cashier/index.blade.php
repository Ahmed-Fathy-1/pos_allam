@extends('Admin.layouts.master')
@section('title') create - invoice @endsection
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
                <h4>Welcome To Create New Invoice Page.</h4>
                <h6>you can create new invoice for already exists or new  customers. </h6>
            </div>
            <div class="page-btn">
                <a class="btn btn-added" data-bs-toggle="modal" data-bs-target="#create">
                    <img src="{{asset('assets/dashboard/img/icons/plus.svg')}}"
                         class="me-2" alt="img">
                    Add New Customer
                </a>
                {{-- create Customer --}}
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
                </div>
            </div>
        </div>
        <!-- /add -->
        <div class="card">
            <div class="card-body">
                <form method="POST" action="{{route('cashier-store')}}">
                    @csrf
                    <div class="row">
                        <div class="col-lg-3 col-sm-6 col-12">
                            <div class="form-group">
                                <label>Customer</label>
                                <select class="js-example select2" name="customer_id" required>
                                    <option selected disabled>Choose recipient</option>
                                    @foreach($customers as $customer)
                                        <option value="{{$customer->mobile}}">{{$customer->name. '(' . $customer->mobile . ")"}}</option>
                                    @endforeach
                                </select>
                                @error('customer_id')
                                 <p class="text-danger">{{$message}}</p>
                                @enderror
                            </div>
                        </div>
                        <div class="col-lg-6 col-sm-6 col-12">
                            <div class="form-group">
                                <label>Address</label>
                                <select class="select form-select" name="address_id" >

                                </select>
                                @error('address')
                                    <p class="text-danger">{{$message}}</p>
                                @enderror
                            </div>
                        </div>

                        <div class="col-lg-3 col-sm-6 col-12">
                            <div class="form-group">
                                <label>Delivery</label>
                                <select class="select form-select" name="delivery_id" >
                                    <option selected disabled>Choose Delivery</option>
                                    @foreach($users as $user)
                                        <option value="{{$user->id}}">{{$user->name}}</option>
                                    @endforeach
                                </select>
                                @error('delivery_id')
                                   <p class="text-danger">{{$message}}</p>
                                @enderror
                            </div>
                        </div>
                    </div>
                    <div id="orders">
                        <div class="order-group ">
                            <div class="row">
                                <div class="col-lg-3 col-sm-6 col-12">
                                    <div class="form-group">
                                        <label for="products">Product</label>
                                        <select name="orders[0][product_id]" class="select2 form-select select-product" required>
                                            <option value="">Select Product</option>
                                            <!-- Populate this dropdown with product options -->
                                            @foreach ($products as $product)
                                                <option value="{{ $product->id }}">{{ $product->name }}</option>
                                            @endforeach
                                        </select>
                                    </div>
                                </div>
                                <div class="col-lg-3 col-sm-6 col-12">
                                    <div class="form-group">
                                        <label for="quantity">Unit</label>
                                        <select name="orders[0][unit]" class="select2 form-select unit-select" required>

                                        </select>
                                    </div>
                                </div>
                                <div class="col-lg-3 col-sm-6 col-12">
                                    <div class="form-group">
                                        <label for="quantity">Quantity</label>
                                        <input type="number" name="orders[0][quantity]" required
                                               class="form-control" min="1" step="0.01" placeholder="Quantity" >
                                    </div>
                                </div>
                                <div class="col-lg-3 col-sm-6 col-12">
                                    <div class="form-group">
                                        <label for="new_price">New Price (AUD)</label>
                                        <input type="number" name="orders[0][new_price]" class="form-control" min="1" step="0.01" id="totalAmt"
                                               placeholder="New Price if available" >
                                    </div>
                                </div>
                            </div>
                            <button type="button" class="btn btn-sm btn-danger remove-order mb-2"
                                    style="display: none ">Remove </button>
                        </div>
                    </div>
                    <div class="col-lg-12 d-flex justify-content-between">
                        <button class="btn btn-sm btn-primary me-2 " id="add-order"  type="button">Add Another</button>
                        <button class="btn btn-submit me-2" type="submit">Submit</button>
                    </div>
                </form>
            </div>
        </div>
        <!-- /add -->
    </div>
@endsection
@section('js')
    <script src="{{asset('assets/dashboard/js/dashboard/order.js')}}"></script>
    <script>
        $(".js-example").select2({
            tags: true,
        });
    </script>
    <script>
        // let inp = document.getElementById()
         var counter = 0

        document.getElementById('add-order').addEventListener("click", function () {
            counter ++
        })

        $(document).ready(function () {
            $('select[name="customer_id"]').on('change', function () {
                var Customer_id = $(this).val();
                const addressSelect = $('select[name="address_id"]');
                if (Customer_id){
                    $.ajax({
                        url: "{{ URL::to('admin/cashier/customer-address') }}/" + Customer_id, // THIS IS ROUTE
                        type: "GET",
                        dataType: "json",
                        success: function (data) {
                            console.log(data);
                            addressSelect.empty();
                            addressSelect.append('<option value="" selected disabled>Select Address Of Customer...</option>');
                            if (Array.isArray(data) && data.length > 0) {
                                const addressData = [];
                                for (let i = 0; i < data.length; i++) {
                                    const option = $('<option></option>').attr('value', data[i].id).text(data[i].address + ', ' + data[i].city + ', ' + data[i].state + ' ' + data[i].post_code);
                                    addressData.push(option)
                                }
                                addressSelect.append(addressData);
                            } else {
                                console.error("Invalid data format or empty data array");
                            }
                        },
                        error: function (xhr, status, error) {
                            console.error(xhr.responseText);
                        }
                    });
                }
                else {
                    console.log('AJAX load did not work');
                }
            });
            var products = $('.order-group').length;

            $('#orders').delegate('select.select-product','change', function () {
                var Product_id = $(this).val();
                // console.log(Product_id);
                let unitSelect = $(this).closest('.order-group').find('select.unit-select');
                $(unitSelect).find('option').remove();
                if (Product_id) {
                    $.ajax({
                        url: "{{ URL::to('admin/cashier/product-unit') }}/" + Product_id, // THIS IS ROUTE
                        type: "GET",
                        dataType: "json",
                        success: function (data) {
                            // console.log(data);
                            $(unitSelect).empty();
                            $(unitSelect).append('<option value="" selected disabled>Select Unit ...</option>');

                            if (Array.isArray(data) && data.length > 0) {
                                const unitData = [];

                                for (let i = 0; i < data.length; i++) {
                                    const option = $('<option></option>').attr('value', data[i].id).text(data[i].name);
                                    unitData.push(option)
                                }

                                unitSelect.append(unitData);
                            } else {
                                console.error("Invalid data format or empty data array");
                            }
                        },
                        error: function (xhr, status, error) {
                            console.error(xhr.responseText);
                        }
                    });
                }
                else {
                    console.log('AJAX load did not work');
                }
            });
        });
    </script>
@endsection
