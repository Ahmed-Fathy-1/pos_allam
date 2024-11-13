<!DOCTYPE html>
<html lang="ar">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Tax Invoice</title>
    <style>
        #invoice_order{
            width: 240px;
        }
        @media print {
            @page  {
               width: 100%;
                padding: 0;
                margin: 0  10px;
            }
            body {
                font-family: Arial, sans-serif;
                margin: 0;
                padding: 0;
                width:240px;

            }
            .container {
                margin: 0 auto;
                /*border: 1px solid #000;*/
                /*padding: 24px;*/
            }
            .header {
                display: flex;
                justify-content: space-between;
                align-items: center;
            }
            .font .image{
                display: flex;
                justify-content: center;
                align-items: center;
                margin-top: 5px;
            }
            .image img{
                width: 50px;
                border-radius: 8px;

            }

            .font p{
                font-size: 10px;
                font-weight: 600;
            }
            .header div {
                flex: 1;
            }
            .head{
                display: flex;
                justify-content: space-between;
            }
            .title {
                text-align: center;
                margin: 5px 0;
            }
            .details, .items{
                width: 100%;
                border-collapse: collapse;
                margin-bottom: 10px;
                overflow-y: auto; /* Add vertical scrollbar if content overflows */
            }
            /* .content_table{
                 height: 800px;
             }*/
            .details td, .items td, .items th {
                border: 1px solid #aaaaaa;
                padding: 3px;
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
                padding: 3px;
                border: 1px solid #000;
            }

            .signature {
                margin-top: 30px;
                margin-bottom: 20px;
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

            .signature.overflow {
                margin-top: 170px;
            }

            .text-center {
                text-align: center;
                /* margin-top: 7px;*/
            }

            .text-with-image {
                display: inline-flex;
                justify-content: center;
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
            .font .site_name{
                margin-bottom: 5px;
            }
        }
        .m-0{
            margin: 0;
        }
        p{
            font-size: 10px;
        }
        .mb-1{
            margin-bottom: 10px;
        }
        .w-25{
            width: 25%;
            display: inline-block;
            float: left;
        }
        .p-0{
            padding: 0;
        }
        .bg-dark{
            background-colors: #000000;
        }

    </style>
</head>
<body>
<?php
$allSettings = \App\Models\Setting::get();
$setting = $allSettings->flatMap(function($allSettings) {
    return [$allSettings->key => $allSettings->value];
});

?>


<div class="container">
    <div class=" font">
        @if($setting['logo'] !=null)
            <div class="image">
                <img   src="{{asset('storage/'.$setting['logo'])}}">
            </div>
        @endif
        <h2 class=" m-0  text-center site_name">{{$setting['site_name']}}</h2>
        <div class="head ">
            <p class="m-0 mb-1">
                Phone : {{$setting['mobile']}}
            </p>
            <p class="m-0 mb-1">
                Data : {{ \Carbon\Carbon::parse($invoice->created_at)->format('d M, Y h:i A')}}
            </p>
        </div>
        <p class="m-0 mb-1">
            Address: {{$setting['address']}}
        </p>
    </div>
    <table class="details font">
        <tr class="">
            <td >
                @if($invoice->serial !=null)
                    <p class="m-0" ><span class="w-25 p-0 bg-dark"> Serial No : </span> {{$invoice->serial}}</p>
                @else
                    <p class="m-0"><span class="w-25 p-0 bg-dark">  Serial No : </span> {{$invoice->id}}-{{\Carbon\Carbon::parse($invoice->created_at)->format('ymd')}}</p>
                @endif
            </td>
        </tr>
    </table>
{{--    @if(isset($invoice->customer_id) && $invoice->customer_id !=null)
    <table class="details">
        <tr>
            <td><strong>Invoice To</strong><br>{{$invoice->customer?->name}}<br>{{$invoice->customer?->mobile}}</td>
            <td><strong>Deliver To</strong><br>{{$invoice->address?->address}}<br>{{$invoice->address?->city}}, {{$invoice->address?->state}} {{$invoice->address?->post_code}}</td>
        </tr>
    </table>
    @else
        <table class="details">
            <tr>
                <td><strong>Invoice To </strong><br> <br><br> <br> </td>
                <td><strong>Deliver To </strong><br> <br><br> <br> </td>
            </tr>
        </table>
    @endif--}}
    <div class="title">
        <p>TAX INVOICE @if($invoice->created_at != $invoice->updated_at) ( Amended at : {{$invoice->updated_at->format('d-m-Y')}} ) @endif
{{--            @if($invoice->payment_status == \App\Enums\PaymentStatusEnum::Balance->value){{\App\Enums\OrderStatusEnum::from($invoice->status)->name}} From Balance @endif--}}
        </p>
    </div>

    <table class="items content_table">
        <tr style="text-align: center">
            <th>الاجمالى</th>
            <th>السعر</th>
            <th>الكميه</th>
            <th>الوصف</th>
            <th>#</th>
        </tr>
        @foreach($invoice->orderDetails as $key=>$detail)
            <tr >
                <td class="text-center">{{$detail->sub_total}}</td>
                <td class="text-center">{{$detail->price}}</td>
                <td class="text-center">{{$detail->quantity}}</td>
                <td class="text-center"> {{$detail->product->name}}</td>
                <td class="text-center">{{ $key+1 }}</td>
                {{--  <td class="text-center">{{$detail->unit->name}}</td>--}}
                {{--<td ></td>--}}

            </tr>
        @endforeach
       {{-- @if($invoice->orderDetails->count() < 10)
            @for($i = 0; $i < 10 - $invoice->orderDetails->count(); $i++)
                <tr>
                    <td height="8px"></td>
                    <td class="text-center" height="12px"></td>
                    <td class="text-center" height="12px"></td>
                    <td class="text-center" height="12px"></td>
                    <td></td>
                    <td class="text-center" height="12px"></td>
                </tr>
            @endfor
        @endif--}}
        <tr>
            <td class="text-center fw-bold">
                {{$invoice->total}}
            </td>
            <td  colspan="1" class="text-center fw-bold pl-0" >الاجمالى</td>
            <td   style="border: 0 !important;"></td>
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
                <td class="text-center fw-bold">
                    ${{ $weeklyBalance + $weeklyRemainng }}
                </td>
                <td class="text-center fw-bold pl-0">الاسبوعى </td>
                <td colspan="1" style="border: 0 !important;" ></td>
            </tr>
        <tr>
            <td class="text-center fw-bold">
                ${{$prevBalance + $prevRemaing}}
            </td>
            <td class="text-center fw-bold pl-0">اجمالى السابق</td>
            <td colspan="1" style="border: 0 !important;" ></td>


        </tr>
        <tr>
            <td class="text-center fw-bold">
                @if($invoice->payment_status == \App\Enums\PaymentStatusEnum::Balance->value)
                    ${{($allPrevBalance + $allPrevRemain) - ($invoice->customer->balance)}}
                @else
                    ${{$allPrevBalance + $allPrevRemain}}
                @endif
            </td>
            <td class="text-center fw-bold pl-0">المبلغ المستحق</td>
            <td colspan="1" style="border: 0 !important;"></td>
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
</div>
<div class="text-center" style="font-size: 10px">
    <p style="padding-top: 3px; margin-bottom: 0 !important;">E-commerce System Developed By <strong>AiTech</strong></p>
    <div class="text-with-image">
        <img src="{{asset('assets/dashboard/img/aitech.png')}}" style="width: 20px; margin-top: 5px; vertical-align: middle;">
        <a href="https://aitech.net.au" style="vertical-align: middle; color: #000000">https://aitech.net.au</a>
    </div>
   {{-- <p>printed at : {{\Carbon\Carbon::now()->format('d-m-Y h:i A')}}</p>--}}
</div>
</body>
</html>
