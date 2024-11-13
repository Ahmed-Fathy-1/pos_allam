@extends('Admin.layouts.master')
@section('title') reports @endsection
@section('css')
<!-- Color Picker Css -->
<link rel="stylesheet" href="{{asset('assets/dashboard/flatpickr/flatpickr.min.css')}}">
<link rel="stylesheet" href="{{asset('assets/dashboard/@simonwep/pickr/themes/nano.min.css')}}">
<style>
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
    <div class="page-header">
        <div class="page-title">
            <h4>Make Report.</h4>
            <h6>Here your Can statically of all purchase.</h6>
        </div>
        <div class="page-btn">
            <a class="btn btn-added" data-bs-toggle="modal" data-bs-target="#create">
                <img src="{{asset('assets/dashboard/img/icons/plus.svg')}}" class="me-2" alt="img">
                New Report
            </a>
            {{-- create Report --}}
            <div class="modal fade" id="create" tabindex="-1" aria-labelledby="create" aria-hidden="true">
                <div class="modal-dialog modal-lg modal-dialog-centered" role="document">
                    <div class="modal-content">
                        <div class="modal-header" style="background-color: #FF9F43;">
                            <h5 class="modal-title text-white">New Report</h5>
                            <button type="button" class="close" data-bs-dismiss="modal" aria-label="Close">
                                <span aria-hidden="true">×</span>
                            </button>
                        </div>
                        <form method="POST" action="{{route('report-store')}}">
                            @csrf
                            <div class="modal-body">
                                <div class="row">
                                    <div class="col-lg-6  col-12">
                                        <div class="form-group">
                                            <label>title</label>
                                            <input type="text" name="title" required value="{{old('title')}}"
                                                placeholder="Enter Report Title">
                                            @error('title')
                                                <p class="text-danger">{{$message}}</p>
                                            @enderror
                                        </div>
                                    </div>
                                    <div class="col-xl-6">
                                        <label for="danger-level" class="form-label">
                                            Report Type <i class="bi bi-asterisk text-danger fs-7 ms-1"></i></label>
                                        <div id="danger-level" class="d-flex align-items-center gap-4 min-hight-radio">
                                            <div class="w-100">
                                                <input type="radio" class="btn-check w-100 type-general"
                                                    value="{{\App\Enums\ReportTypeEnum::GENERAL->value}}" name="type"
                                                    id="option7">
                                                <label class="btn btn-outline-primary w-100"
                                                    for="option7">General</label>
                                            </div>
                                            <div class="w-100">
                                                <input type="radio" class="btn-check w-100 type-personal" id="option8"
                                                    value="{{\App\Enums\ReportTypeEnum::PERSONAL->value}}" name="type">
                                                <label class="btn btn-outline-primary w-100"
                                                    for="option8">Customers</label>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="col-lg-6 col-12 none" id="customer">
                                        <div class="form-group">
                                            <label>Customers</label>
                                            <select class="select form-select" name="customer_id">
                                                <option selected disabled>Choose Customer Name</option>
                                                @foreach($users as $user)
                                                    <option value="{{$user->id}}">
                                                        {{$user->name . " ( " . $user->mobile . " ) "}}</option>
                                                @endforeach
                                            </select>
                                            @error('customer_id')
                                                <p class="text-danger">{{$message}}</p>
                                            @enderror
                                        </div>
                                    </div>
                                </div>
                                <div class="row">
                                    <div class="col-lg-6  col-12">
                                        <div class="form-group">
                                            <label>Start At </label>
                                            <input type="text" class="form-control" id="humanfrienndlydate"
                                                name="start_date" required value="{{old('start_date')}}"
                                                placeholder="Choose Start Date Report">
                                            @error('start_date')
                                                <p class="text-danger">{{$message}}</p>
                                            @enderror
                                        </div>
                                    </div>

                                    <div class="col-lg-6 col-sm-12 col-12">
                                        <div class="form-group">
                                            <label>End At </label>
                                            <input type="text" class="form-control" id="humanfrienndlydate"
                                                name="end_date" required value="{{old('end_date')}}"
                                                placeholder="Choose end Date Report">
                                            @error('end_date')
                                                <p class="text-danger">{{$message}}</p>
                                            @enderror
                                        </div>
                                    </div>
                                    <div class="col-lg-12 col-sm-12 col-12">
                                        <div class="form-group">
                                            <label>Description</label>
                                            <textarea rows="5" cols="5" name="description"
                                                placeholder="Enter Report Description"
                                                class="form-control">{{old('description')}}</textarea>
                                            @error('description')
                                                <p class="text-danger">{{$message}}</p>
                                            @enderror
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <div class="modal-footer d-flex justify-content-between">
                                <button class="btn btn-cancel" type="button" data-bs-dismiss="modal"
                                    aria-label="Close">Cancel</button>
                                <button class="btn btn-submit" type="submit">Submit</button>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <div class="row">
        <div class="card mb-0">
            <div class="card-body">
                <div class="table-top flex-row">
                    <div class="search-set">
                        <div class="search-path">
                            <h4>Reports List</h4>
                        </div>
                    </div>
                </div>
                <div class="table-responsive">
                    <table class="table  datanew">
                        <thead>
                            <tr>
                                <th>#</th>
                                <th>Title</th>
                                <th>Type</th>
                                <th>Start Date</th>
                                <th>End Date</th>
                                <th>Created By</th>
                                <th class="text-center">Details</th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach($reports as $report)
                                <tr>
                                    <td data-bs-toggle="modal" data-bs-target="#details-order{{$report->id}}">
                                        {{$loop->iteration}}
                                    </td>
                                    <td data-bs-toggle="modal" data-bs-target="#details-order{{$report->id}}">
                                        {{$report->title}}
                                    </td>
                                    <td data-bs-toggle="modal" data-bs-target="#details-order{{$report->id}}">
                                        @if($report->type = \App\Enums\ReportTypeEnum::GENERAL->value)
                                            General
                                        @else
                                            Personal
                                        @endif
                                    </td>
                                    <td data-bs-toggle="modal" data-bs-target="#details-order{{$report->id}}">
                                        {{\Carbon\Carbon::parse($report->start_date)->format('d F, Y')}}
                                    </td>
                                    <td data-bs-toggle="modal" data-bs-target="#details-order{{$report->id}}">
                                        {{\Carbon\Carbon::parse($report->end_date)->format('d F, Y')}}
                                    </td>
                                    <td data-bs-toggle="modal" data-bs-target="#details-order{{$report->id}}">
                                        {{$report->user->name}}
                                    </td>
                                    <td>
                                        <div class="d-flex justify-content-center gap-2">
                                            <div>
                                                <a href="{{route('report-show',$report->id)}}"
                                                   class="btn btn-sm btn-primary text-white hover:none">
                                                    Details</a>
                                            </div>
                                            <div>
                                                <a href="{{route('report.pdf',$report->id)}}"
                                                    class="btn btn-sm btn-danger text-uppercase text-white hover:none"
                                                    >
                                                    pdf
                                                </a>
                                            </div>
                                            <div>
                                                <a data-bs-toggle="modal" data-bs-target="#delete{{$report->id}}">
                                                    <img src="{{asset('assets/dashboard/img/icons/delete.svg')}}" alt="img">
                                                </a>
                                            </div>
                                        </div>
                                        {{-- model Delete --}}
                                        <div class="modal fade" id="delete{{$report->id}}" tabindex="-1" aria-hidden="true">
                                            <div class="modal-dialog modal-dialog-centered" role="document">
                                                <div class="modal-content">
                                                    <div class="modal-header" style="background-color: #FF9F43;">
                                                        <h5 class="modal-title text-white">Delete Report</h5>
                                                        <button type="button" class="close" data-bs-dismiss="modal"
                                                            aria-label="Close">
                                                            <span aria-hidden="true">×</span>
                                                        </button>
                                                    </div>
                                                    <form method="POST" action="{{route('report-delete')}}">
                                                        @csrf
                                                        @method('DELETE')
                                                        <input type="hidden" value="{{$report->id}}" name="id">
                                                        <div class="modal-body">
                                                            <div class="delete-order">
                                                                <img src="{{asset('assets/dashboard/img/icons/close-circle1.svg')}}"
                                                                    alt="img">
                                                            </div>
                                                            <div class="para-set text-center">
                                                                <p>Are You Sure Delete Report</p>
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
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
@section('js')
<script src="{{asset('assets/dashboard/flatpickr/flatpickr.min.js')}}"></script>
<script src="{{asset('assets/dashboard/js/date&time_pickers.js')}}"></script>
<script>
    document.addEventListener("DOMContentLoaded", function () {
        const typeGeneralInput = document.querySelector('.type-general');
        const typePersonalInput = document.querySelector('.type-personal');
        const customerDiv = document.getElementById('customer');
        typeGeneralInput.addEventListener('click', function () {
            customerDiv.classList.add('none');
        });
        typePersonalInput.addEventListener('click', function () {
            customerDiv.classList.remove('none');
        });
    });
</script>
@endsection
