@extends('Admin.layouts.master')
@section('main_head')
<div class="page-title font-medium ">
    <h4> Products List </h4>
</div>
@endsection
@section('title') Products @endsection
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
                @can('create_product')
                    <div class="page-btn">
                        <a class="btn btn-added mt-2 mt-lg-0" href="{{route('product-create')}}">
                            <img src="{{asset('assets/dashboard/img/icons/plus.svg')}}" class="me-2" alt="img">
                            Add Product
                        </a>
                    </div>
                @endcan
            </div>
            <div class="table-responsive">
                <table class="table  datanew">
                    <thead>
                        <tr>
                            <th>#</th>
                            {{--<th>Product images</th>--}}
                            <th>Product Name</th>
                            <th>Category</th>
                            <th>Status</th>
                            <th>Action</th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach($products as $product)
                            <tr>
                                <td>{{$loop->iteration}}</td>
                                {{-- <td>
                                    <div class="gap-3 items-stretch">
                                        @foreach($product->images as $image)
                                            <img width="50px" height="50px" src="{{asset('storage/' . $image)}}" alt="image"
                                                title="image">
                                        @endforeach
                                    </div>
                                </td>--}}
                                <td>{{$product->name}}</td>
                                <td>{{$product->category->name}}</td>
                                <td class="text-capitalize">
                                    @if($product->status == 1)
                                        <span class="badge bg-success">Active</span>
                                    @else
                                        <span class="badge bg-danger">Inactive</span>
                                    @endif
                                </td>
                                <td>
                                    <a class="me-3" href="{{route('product-show', $product->id)}}">
                                        <img src="{{asset('assets/dashboard/img/icons/eye.svg')}}" alt="img">
                                    </a>
                                    @can('edit_product')
                                        <a class="me-3" href="{{route('product-edit', $product->id)}}">
                                            <img src="{{asset('assets/dashboard/img/icons/edit.svg')}}" alt="img">
                                        </a>
                                    @endcan
                                    @can('delete_product')
                                        <a data-bs-toggle="modal" data-bs-target="#delete{{$product->id}}">
                                            <img src="{{asset('assets/dashboard/img/icons/delete.svg')}}" alt="img">
                                        </a>
                                    @endcan
                                    {{-- model Delete --}}
                                    <div class="modal fade" id="delete{{$product->id}}" tabindex="-1" aria-hidden="true">
                                        <div class="modal-dialog modal-dialog-centered" role="document">
                                            <div class="modal-content">
                                                <div class="modal-header" style="background-color: #FF9F43;">
                                                    <h5 class="modal-title text-white">Delete Product</h5>
                                                    <button type="button" class="close" data-bs-dismiss="modal"
                                                        aria-label="Close">
                                                        <span aria-hidden="true">×</span>
                                                    </button>
                                                </div>
                                                <form method="POST" action="{{route('product-delete', $product->id)}}">
                                                    @csrf
                                                    @method('DELETE')
                                                    <div class="modal-body">
                                                        <div class="delete-order">
                                                            <img src="{{asset('assets/dashboard/img/icons/close-circle1.svg')}}"
                                                                alt="img">
                                                        </div>
                                                        <div class="para-set text-center">
                                                            <p>Are You Sure Delete Product</p>
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
{{--                {{$products->links()}}--}}
            </div>
        </div>
    </div>
    <!-- /product list -->
</div>
@endsection
