@extends('Admin.layouts.master')
@section('main_head')
    <div class="page-title font-medium ">
        <h4> Invoices Logs</h4>
    </div>
@endsection
@section('title') Invoices Logs @endsection
@section('css')
    <style>
        .content{
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
        .placehold {
            width: 177.6px;
        }
        .dataTables_length{
            display: none;
        }
        div.dataTables_wrapper div.dataTables_paginate{
            display: none;
        }
        div.dataTables_wrapper div.dataTables_info{
            display: none;
        }
        .pagination li a{
            background: #FF9F43;
            color: #fff
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
        <!--  cards -->
        <div class="card mb-0">
            <div class="card-body">
                <div class="table-top d-block">
                    <div class="d-flex flex-wrap justify-content-between">
                        <h4 class="text-nowrap  col-12 col-md-3">Invoices Logs</h4>

                    </div>
                </div>
                <div class="table-responsive">
                    <table class="table ">
                        <thead>
                        <tr>
                            <th>No</th>
                            <th>Date</th>
                            <th>Action</th>
                            <th>Invoice Serial</th>
                            <th>User</th>
                            <th class="text-center">Details</th>
                        </tr>
                        </thead>
                        <tbody>

                        @foreach($logs as $log)
                            <tr>
                                <td >{{$loop->iteration}}</td>
                                <td >{{$log->created_at->format('d-m-Y H:i A')}}</td>
                                <td >{{$log->action}}</td>
                                <td>{{ optional($log->order)->serial ?: "------" }}</td>
                                <td>{{$log->user->name}}</td>
                                <td>
                                    <div class="d-flex justify-content-center gap-2">
                                        <div>
                                            <a href="{{route('cashier-show',$log->order_id)}}"
                                               class="btn btn-sm btn-primary text-white hover:none">
                                                Details</a>
                                        </div>

                                    </div>
                                </td>
                            </tr>
                        @endforeach
                        </tbody>
                    </table>
                    <form method="GET" action="{{ route('order.logs') }}" class="pt-3">
                        <div class="d-flex justify-content-between">
                            <div class="ps-3">
                                <select name="number" class="ps-2 pe-2" onchange="this.form.submit()">
                                    <option disabled selected>...</option>
                                    <option value="10" @if($paginate == 10) selected @endif>10</option>
                                    <option value="20" @if($paginate == 20) selected @endif>20</option>
                                    <option value="30" @if($paginate == 30) selected @endif>30</option>
                                    <option value="50" @if($paginate == 50) selected @endif>50</option>
                                </select>
                            </div>
                            <div>
                                {{ $logs->appends(request()->except('page'))->links()}}
                            </div>
                        </div>
                    </form>
                </div>
            </div>
        </div>

        <!-- Button trigger modal -->

    </div>
@endsection
@section('js')

@endsection
