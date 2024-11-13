@extends('Admin.layouts.master')
@section('main_head')
    <div class="page-title font-medium ">
        <h4>Show - Invoice </h4>
    </div>
@endsection
@section('title') Show - Invoice @endsection
@section('css')
    <style>
        .content{
            padding: 10px !important;
        }
        .container {
            margin: auto;
            border: 1px solid #000;
            padding: 20px;
        }
       /* .header {
            display: flex;
            justify-content: space-between;
            align-items: center;
        }
        .header div {
            flex: 1;
        }*/
        .title {
            text-align: center;
            margin: 20px 0;
        }
        .details, .items {
            width: 100%;
            border-collapse: collapse;
            margin-bottom: 20px;
        }
        .details td, .items td, .items th {
            border: 1px solid #000;
            padding: 8px;
        }
        .items th {
            background-color: #f2f2f2;
        }
        .totals {
            float: right;
            width: 300px;
        }
        .totals table {
            width: 100%;
            border-collapse: collapse;
        }
        .totals td {
            padding: 8px;
            border: 1px solid #000;
        }
        .signature {
            margin-top: 30px;
        }
        .signature table {
            width: 100%;
            border-collapse: collapse;
        }
        .signature td {
            padding: 8px;
            border: 1px solid #000;
        }
        .signature .label {
            width: 70px;
        }
        .text-with-image {
            display: inline-flex;
            align-items: center;
            gap: 5px; /* Adjust spacing between items if needed */
        }
        .text-with-image img {
            margin-top: 5px;
            vertical-align: middle;
        }
        .text-with-image a {
            vertical-align: middle;
            text-decoration: none;
        }
    </style>
@endsection
@section('content')
    <div class="content">
        <div class="row">
            <div class="col-lg-6 col-8">

            </div>

            <div class="col-lg-6 col-12 " >
                <div class="d-flex justify-content-end gap-3">
                    <div class="d-flex justify-content-between gap-3" style="margin-top: 5px">
                        <a data-bs-toggle="tooltip" data-bs-placement="top" href="{{route('invoice.pdf',$invoice->id)}}" download
                           title="pdf"><img src="{{asset('assets/dashboard/img/icons/pdf.svg')}}" style="width: 25px; margin-top: 0;"   alt="img">
                        </a>
                        <a id="printButton" type="button" data-bs-placement="top" title="Print">
                            <img src="{{ asset('assets/dashboard/img/icons/printer.svg') }}" style="width: 25px; margin-top: 5px;"  alt="Print">
                        </a>
                       <script>
                            document.getElementById('printButton').addEventListener('click', function() {
                                var pdfUrl = "{{ route('invoice.print', $invoice->id) }}";
                                var iframe = document.createElement('iframe');
                                iframe.style.display = 'none';
                                iframe.src = pdfUrl;
                                document.body.appendChild(iframe);
                                iframe.onload = function() {
                                    iframe.contentWindow.print();
                                    setTimeout(function() {
                                        document.body.removeChild(iframe);
                                    }, 1000);
                                };
                            });
                        </script>
                    </div>
                    <div style="margin-top: 5px " class="d-flex gap-3">
                        <a style="margin: 2px" href="{{route('edit-invoice',$invoice->id)}}" >
                            <img src="{{asset('assets/dashboard/img/icons/edit.svg')}}" style="width: 25px; margin-top: 0;" alt="img">
                        </a>

                        <a  data-bs-toggle="modal" data-bs-target="#delete{{$invoice->id}}">
                            <img src="{{asset('assets/dashboard/img/icons/delete.svg')}}" style="width: 34px; margin-top: 0;" alt="img">
                        </a>
                        <div class="modal fade" id="delete{{$invoice->id}}" tabindex="-1"  aria-hidden="true">
                            <div class="modal-dialog modal-dialog-centered" role="document">
                                <div class="modal-content">
                                    <div class="modal-header" style="background-color: #FF9F43;">
                                        <h5 class="modal-title text-white" >Delete Order</h5>
                                        <button type="button" class="close" data-bs-dismiss="modal" aria-label="Close">
                                            <span aria-hidden="true">×</span>
                                        </button>
                                    </div>
                                    <form method="POST" action="{{route('cashier-delete',$invoice->id)}}">
                                        @csrf
                                        @method('DELETE')
                                        <div class="modal-body">
                                            <div class="delete-order">
                                                <img src="{{asset('assets/dashboard/img/icons/close-circle1.svg')}}" alt="img">
                                            </div>
                                            <div class="para-set text-center">
                                                <p>Are You Sure Delete Order</p>
                                            </div>
                                        </div>
                                        <div class="modal-footer d-flex justify-content-between">
                                            <button class="btn btn-cancel" type="button" data-bs-dismiss="modal">No</button>
                                            <button class="btn btn-danger" type="submit" >Yes</button>
                                        </div>
                                    </form>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div>
                        <a href="{{route('newIndex')}}" class="btn btn-primary">Cashier</a>
                    </div>

                </div>
            </div>
        </div>
        <?php
        $allSettings = \App\Models\Setting::get();
        $setting = $allSettings->flatMap(function($allSettings) {
            return [$allSettings->key => $allSettings->value];
        });
        ?>
        <div class="card mb-5" id="invoice_order" >
            <div class="card-body mb-5">
                <table class="details">
                    <tr>
                        <td><strong style="font-size: 25px">{{$setting['site_name']}}</strong><br>
                           Phone : {{$setting['mobile']}}<br>
                            {{$setting['address']}}
                        </td>
                        <td>
                            <strong>SALESMAN : </strong>{{$invoice->cashier->name}}<br>
                            <strong>DATE : </strong>{{ \Carbon\Carbon::parse($invoice->created_at)->format('d M, Y h:i A')}} <br>
                            <strong>No : </strong>{{$invoice->serial}}
                            <br>
                        </td>
                    </tr>
                </table>

              {{--  @if(isset($invoice->customer_id) && $invoice->customer_id !=null)
                    <table class="details">
                        <tr>
                            <td><strong>Invoice To</strong><br>{{$invoice->customer?->name}}<br>{{$invoice->customer?->mobile}}</td>
                            <td><strong>Deliver To</strong><br>{{$invoice->address?->address}}<br>{{$invoice->address?->city}}, {{$invoice->address?->state}} {{$invoice->address->post_code}}</td>
                        </tr>
                    </table>
                @else
                    <table class="details" style="height: 100px">
                        <tr>
                            <td><strong>Invoice To</strong><br> <br> </td>
                            <td><strong>Deliver To</strong><br> <br> </td>
                        </tr>
                    </table>
                @endif--}}
                <div class="title">
                    <strong>TAX INVOICE @if($invoice->created_at != $invoice->updated_at)( Amended at : {{$invoice->updated_at->format('d-m-Y ')}} )@endif
                        @if($invoice->payment_status == \App\Enums\PaymentStatusEnum::Balance->value){{\App\Enums\OrderStatusEnum::from($invoice->status)->name}} From Balance @endif
                    </strong>
                </div>
                <table class="items">
                    <tr style="text-align: center">
                        <th>الاجمالى</th>
                        <th>السعر</th>
                        <th>الكميه</th>
                        <th>الوصف</th>
                      {{--  <th>GST</th>--}}
                    </tr>
                    @foreach($invoice->orderDetails as $detail)
                        <tr>
                            <td class="text-center">{{$detail->sub_total}}</td>
                            <td class="text-center">{{$detail->price}}</td>
                            <td class="text-center">{{$detail->quantity}}</td>
                            <td class="text-center">{{$detail->product->name}}</td>


                          {{--  <td ></td>--}}

                        </tr>
                    @endforeach
                    <tr>
                        <td class="text-center fw-bold">
                            {{$invoice->total}}
                        </td>
                        <td colspan="1" class="text-center fw-bold pl-0">الاجمالى  </td>
                        <td  class="border-0"></td>
                    </tr>

                    @if($invoice->customer_id!=null)
                        @php
                            $startOfWeek =\Carbon\Carbon::parse($invoice->created_at)->startOfWeek(\Carbon\Carbon::MONDAY);
                            $endOfWeek = \Carbon\Carbon::parse($invoice->created_at)->endOfWeek(\Carbon\Carbon::SUNDAY);

                            $weeklyBalance = \App\Models\Order::where('customer_id', $invoice->customer_id)
                                ->where('status', 0)
                                ->whereDate('created_at', '>=', $startOfWeek)
                                ->whereDate('created_at', '<=', $endOfWeek)
                                ->sum('total');

                            $weeklyRemainng = \App\Models\Order::where('customer_id', $invoice->customer_id)
                                ->where('status', '!=',0)
                                ->whereDate('created_at', '>=', $startOfWeek)
                                ->whereDate('created_at', '<=', $endOfWeek)
                                ->sum('remaining_amount');

                            $prevBalance =  \App\Models\Order::whereCustomerId($invoice->customer_id)
                                  ->where('status',0)->where('id','!=',$invoice->id)
                                  ->whereDate('created_at','<=',$invoice->created_at)
                                  ->sum('total');

                            $prevRemaing =  \App\Models\Order::where('customer_id', $invoice->customer_id)
                                  ->where('status','!=', 0)->where('id','!=',$invoice->id)
                                  ->whereDate('created_at','<=',$invoice->created_at)
                                  ->sum('remaining_amount');

                            $allPrevBalance = \App\Models\Order::whereCustomerId($invoice->customer_id)
                                              ->where('status',0)
                                              ->whereDate('created_at','<=',$invoice->created_at)
                                              ->sum('total');
                            $allPrevRemain =  \App\Models\Order::where('customer_id', $invoice->customer_id)
                                                  ->where('status','!=', 0)
                                                  ->whereDate('created_at','<=',$invoice->created_at)
                                                  ->sum('remaining_amount');
                        @endphp

                        <tr>
                            <td colspan="3" class="border-0"></td>
                            <td class="text-center fw-bold pl-0">Weekly Balance  </td>
                            <td class="text-center fw-bold">
                                {{ $weeklyBalance + $weeklyRemainng }}
                            </td>
                        </tr>
                        <tr>
                            <td colspan="3" class="border-0"></td>
                            <td class="text-center fw-bold pl-0">Previous Balance  </td>
                            <td class="text-center fw-bold">
                                {{$prevBalance + $prevRemaing}}
                            </td>
                        </tr>
                        <tr>
                            <td colspan="3" class="border-0"></td>
                            <td class="text-center fw-bold pl-0">Total Due </td>
                            <td class="text-center fw-bold">
                                @if($invoice->payment_status == \App\Enums\PaymentStatusEnum::Balance->value)
                                    {{($allPrevBalance + $allPrevRemain) - ($invoice->customer->balance)}}
                                @else
                                    {{$allPrevBalance + $allPrevRemain}}
                                @endif

                            </td>
                        </tr>
                    @endif

                </table>
               {{-- <div class="signature">
                    <table>
                        <tr>
                            <td class="label"><strong>SIGNATURE HERE</strong></td>
                            <td></td>
                        </tr>
                        <tr>
                            <td class="label"><strong>NAME:</strong></td>
                            <td></td>
                        </tr>
                    </table>
                </div>--}}
                <div class="text-center">
                    <p style="padding-top: 15px ;margin-bottom: 0 !important;">E-commerce System Developed By <strong>AiTech</strong></p>
                    <div class="text-with-image" >
                        <img src="{{asset('assets/dashboard/img/aitech.png')}}" style="width: 30px; margin-top: 5px; vertical-align: middle;">
                        <a href="https://aitech.net.au" style="vertical-align: middle; color: #0d6efd">https://aitech.net.au</a>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection

@section('js')
<script>
    function printDiv(invoice_order) {
        var printContents = document.getElementById(invoice_order).innerHTML;
        var originalContents = document.body.innerHTML;
        document.body.innerHTML = printContents;
        window.print();
        document.body.innerHTML = originalContents;
    }
</script>
{{--<script>
    document.addEventListener('DOMContentLoaded', function() {
        var pdfUrl = "{{ route('invoice.print', $invoice->id) }}";

        // Create a new iframe element
        var iframe = document.createElement('iframe');
        iframe.style.position = 'absolute';
        iframe.style.width = '0';
        iframe.style.height = '0';
        iframe.style.border = 'none';
        iframe.src = pdfUrl;

        // Append iframe to the body
        document.body.appendChild(iframe);

        // Print the iframe content
        iframe.onload = function() {
            iframe.contentWindow.print();
        };
    });
</script>--}}

@endsection
