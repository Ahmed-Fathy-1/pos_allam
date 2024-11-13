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
                <strong>DATE : </strong>{{ \Carbon\Carbon::parse($payment->created_at)->format('d M, Y ')}}<br>
            </td>
        </tr>
    </table>
    <table class="details">
        <tr>
            <td><strong>Customer</strong><br>{{$payment->customer?->name}}<br>{{$payment->customer?->mobile}}</td>
            <td><strong>Payment</strong><br> Total Due : ${{$payment->total_due}} <br>AmountPaid : ${{$payment->amount_paid}}<br> Remaining :  ${{$payment->remaining}}</td>
        </tr>
    </table>
    <div class="title">
        <strong style="text-align: center">General Payment Statement </strong>
    </div>
    <table class="items">
        <tr style="text-align: center">
            <th>#</th>
            <th>Invoice No</th>
            <th>Status</th>
            <th>Total Due</th>
            <th>Amount Paid</th>
            <th>Remaining</th>
        </tr>
        @foreach($payment->ordersTansfer as $transfer)
                <tr>
                    <td class="text-center">{{$loop->iteration}}</td>
                    <td class="text-center">
                        @if($transfer->serial !=null)
                            {{$transfer->serial}}
                        @else
                            {{$transfer->id}}-{{\Carbon\Carbon::parse($transfer->created_at)->format('ymd')}}
                        @endif
                    </td>
                    <td class="text-center">
                        @if($transfer->status == 0)
                            UnPaid
                        @elseif($transfer->status == 2)
                            P.Paid
                        @else
                            Paid
                        @endif
                    </td>
                    <td class="text-center">${{$transfer->total}}</td>
                    <td class="text-center">${{$transfer->amount_paid}}</td>
                    <td class="text-center">${{$transfer->remaining_amount}}</td>
                </tr>
        @endforeach
        <tr>
            <td colspan="4"  style="border: 0 !important;"></td>
            <td class="text-center fw-bold pl-0">Total  </td>
            <td class="text-center fw-bold">
                ${{$payment->total_due}}
            </td>
        </tr>
        <tr>
            <td colspan="4"  style="border: 0 !important;"></td>
            <td class="text-center fw-bold pl-0">Paid  </td>
            <td class="text-center fw-bold">
                ${{$payment->amount_paid}}
            </td>
        </tr>
        <tr>
            <td colspan="4"  style="border: 0 !important;"></td>
            <td class="text-center fw-bold pl-0">Total Due </td>
            <td class="text-center fw-bold">
                ${{$payment->remaining}}
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
