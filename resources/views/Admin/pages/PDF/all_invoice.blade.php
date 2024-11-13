<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Tax Invoice</title>
    <style>
        body {
            font-family: Arial, sans-serif;
            margin: 0;
            padding: 0;
        }
        .container {
            margin: auto;
            border: 1px solid #000;
            padding: 20px;
        }
        .header {
            display: flex;
            justify-content: space-between;
            align-items: center;
        }
        .header div {
            flex: 1;
        }
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
            border: 1px solid #aaaaaa;
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
            margin-top:30px;
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
        .text-center {
            text-align: center;
            margin-top: 10px;
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
    <table class="details">
        <tr>
            <td><strong style="font-size: 25px">{{$setting['site_name']}}</strong><br>
                 Phone : {{$setting['mobile']}}<br>
                {{$setting['address']}}
            </td>
            <td>
                <strong>SALESMAN : </strong>{{auth()->user()->name}}<br>
                <strong>DATE : </strong>{{ \Carbon\Carbon::now()->format('d M, Y ')}}<br>
            </td>
        </tr>
    </table>
    @if($invoice->count() > 0)
    <table class="details">
        <tr>
            <td><strong>Invoice</strong><br>{{$invoice[0]->customer?->name}}<br>{{$invoice[0]->customer?->mobile}}</td>
            <td><strong>Deliver</strong><br>{{$invoice[0]->address?->address}}<br>{{$invoice[0]->address?->city}}, {{$invoice[0]->address?->state}} {{$invoice[0]->address?->post_code}}</td>
        </tr>
    </table>
    @endif
    @if(isset($date) && $date !=null)
        <div class="title">
            <strong style="text-align: center">Statement @if(isset($status) && $status!=null) {{\App\Enums\OrderStatusEnum::from($status)->name}}@endif
                    ({{\Carbon\Carbon::now()->startOfWeek(\Carbon\Carbon::MONDAY)->format('d-m-Y')}} to {{\Carbon\Carbon::now()->endOfWeek(\Carbon\Carbon::SUNDAY)->format('d-m-Y')}})</strong>
        </div>
    @elseif(isset($filterdate))
        <div class="title">
            <strong style="text-align: center">Statement @if(isset($status) && $status!=null) {{\App\Enums\OrderStatusEnum::from($status)->name}} @endif
                @if($invoice->count() > 0) ({{$filterdate['start_date']}} to {{$filterdate['end_date']}}) @endif</strong>
        </div>
    @else
        <div class="title">
            <strong style="text-align: center">Statement @if(isset($status) && $status!=null) {{\App\Enums\OrderStatusEnum::from($status)->name}} @endif
                @if($invoice->count() > 0) ({{$invoice->last()->created_at->format('d-m-Y')}} to {{$invoice->first()->created_at->format('d-m-Y')}}) @endif</strong>
        </div>
    @endif

    <table class="items">
        <tr style="text-align: center">
            <th>Invoice No</th>
            <th>Status</th>
            <th>QtY</th>
            <th>Unit</th>
            <th>DESCRIPTION</th>
            <th>PRICE</th>
            <th>GST</th>
            <th>TOTAL</th>
        </tr>
        @foreach($invoice as $invo)
            @foreach($invo->orderDetails as $detail)
                <tr>
                    <td class="text-center">
                        @if($invo->serial !=null)
                          {{$invo->serial}}
                        @else
                            {{$invo->id}}-{{\Carbon\Carbon::parse($invo->created_at)->format('ymd')}}
                        @endif
                    </td>
                    <td class="text-center">
                        @if($invo->status == 0)
                            UnPaid
                        @elseif($invo->status == 2)
                            P.Paid
                        @else
                            Paid
                        @endif
                    </td>
                    <td class="text-center">{{$detail->quantity}}</td>
                    <td class="text-center">{{$detail->unit->name}}</td>
                    <td>{{$detail->product->name}}</td>
                    <td class="text-center">${{$detail->price}}</td>
                    <td></td>
                    <td class="text-center">${{$detail->sub_total}}</td>
                </tr>
            @endforeach
        @endforeach
        <tr>
            <td colspan="6"  style="border: 0 !important;"></td>
            <td class="text-center fw-bold pl-0">Total </td>
            <td class="text-center fw-bold">
                ${{$invoice->sum('total')}}
            </td>
        </tr>
        <tr>
            <td colspan="6"  style="border: 0 !important;"></td>
            <td class="text-center fw-bold pl-0">Paid  </td>
            <td class="text-center fw-bold">
                ${{$invoice->where('status','!=',0)->sum('amount_paid')}}
            </td>
        </tr>
        @php
            $unpaid = $invoice->where('status',0)->sum('total') + $invoice->where('status','!=',0)->sum('remaining_amount');
        @endphp

        <tr>
            <td colspan="6"  style="border: 0 !important;"></td>
            <td class="text-center fw-bold pl-0">Total Due </td>
            <td class="text-center fw-bold">
                ${{$unpaid}}
            </td>
        </tr>
    </table>
    <div class="signature">
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
    </div>
</div>
<div class="text-center" style="font-size: 10px">
    <p style="padding-top: 3px; margin-bottom: 0 !important;">E-commerce System Developed By <strong>AiTech</strong></p>
    <div class="text-with-image">
        <img src="{{asset('assets/dashboard/img/aitech.png')}}" style="width: 20px; margin-top: 5px; vertical-align: middle;">
        <a href="https://aitech.net.au" style="vertical-align: middle; color: #0d6efd">https://aitech.net.au</a>
    </div>

</div>
</body>
</html>
