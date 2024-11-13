@extends('Admin.layouts.master')
@section('title') Edit - invoice @endsection
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
                <h4>Welcome To Edit Invoice Page.</h4>
                <h6>you can edit  invoice for that you are maked. </h6>
            </div>
        </div>
        <!-- /add -->
        <div class="card">
            <div class="card-body">
                <form method="POST" action="{{route('cashier-updated')}}">
                    @csrf
                    @method('PUT')
                    <input type="hidden" name="id" value="{{$order->id}}">
                    <div class="row">
                        <div class="col-lg-3 col-sm-6 col-12">
                            <div class="form-group">
                                <label>Recipient</label>
                                <select class="select form-select" name="customer_id" required>
                                    <option selected disabled>Choose recipient</option>
                                    @foreach($customers as $customer)
                                        <option value="{{$customer->id}}" @if($customer->id == $order->customer_id) selected @endif>{{$customer->name}}</option>
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
                                <select class="select form-select" name="address_id" required>

                                </select>
                                @error('address')
                                    <p class="text-danger">{{$message}}</p>
                                @enderror
                            </div>
                        </div>
                        <div class="col-lg-3 col-sm-6 col-12">
                            <div class="form-group">
                                <label>Delivery</label>
                                <select class="select form-select" name="delivery_id" required>
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
