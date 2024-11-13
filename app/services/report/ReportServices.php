<?php

namespace App\services\report;

use App\Models\Customer;
use App\Models\Order;
use App\Models\Setting;
use App\Models\User;
use LaravelDaily\Invoices\Classes\InvoiceItem;
use LaravelDaily\Invoices\Classes\Party;
use LaravelDaily\Invoices\Invoice;

class ReportServices
{
    public function invoice($orders,$data,$id){
        $client = new Party([
            'name'          => auth()->user()->name . " (" .Setting::where('key','mobile')->value('value') ." )",
        ]);
        $customer = new Party([
            'name'          =>'report',
        ]);
        $items = [];
        foreach ($orders as $order) {
            foreach ( $order->orderDetails as $orderInvoce ){
                $items [] =
                    InvoiceItem::make($orderInvoce->product->name)
                        ->description($orderInvoce->unit->name)
                        ->pricePerUnit($orderInvoce->price)
                        ->quantity($orderInvoce->quantity)
                        ->discount($orderInvoce->discount)
                        ->tax($orderInvoce->gst);
            }
        }

        $notes = [$data['title']];
        $notes = implode("<br>", $notes);
        $invoice = Invoice::make('Butcher')
            // ->sequence($order->total)
            ->seller($client)
            ->buyer($customer)
            ->date(now())
            ->shipping($orders->sum('shipping'))
            ->dateFormat('s:m:h m/d/Y')
            ->currencySymbol('$')
            ->currencyCode('ِ‘]')
            ->currencyFormat('{SYMBOL}{VALUE}')
            ->currencyThousandsSeparator('.')
            ->currencyDecimalPoint(',')
            ->filename($id.'_report')
            ->addItems($items)
            ->notes($notes)
            ->logo(public_path('assets/dashboard/logo.png'))
            ->save('invoices');
    }
}
