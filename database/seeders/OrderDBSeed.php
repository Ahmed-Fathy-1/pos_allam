<?php

namespace Database\Seeders;

use App\Models\Order;
use App\Models\Setting;
use App\services\Order\OrderSeeder;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use LaravelDaily\Invoices\Classes\InvoiceItem;
use LaravelDaily\Invoices\Classes\Party;
use LaravelDaily\Invoices\Invoice;
use Illuminate\Support\Facades\File;
use Symfony\Component\Console\Helper\ProgressBar;
use Symfony\Component\Console\Output\ConsoleOutput;
class OrderDBSeed extends Seeder
{
    /**
     * Run the database seeds.
     */
    protected $orderSeederService;

    public function __construct(OrderSeeder $orderSeederService)
    {
        $this->orderSeederService = $orderSeederService;
    }

    public function run(){
        $totalIterations = 25;
        $currentIteration = 0;

        $output = new ConsoleOutput();
        $progressBar = new ProgressBar($output, $totalIterations);
        $progressBar->start();

        $folderPath = public_path('storage/invoices');
        if (File::isDirectory($folderPath)) {
            $files = File::files($folderPath);
            foreach ($files as $file) {
                File::delete($file);
            }
        }

        $date1 = now();
        $date2 = now();
        $date3 = now();
        $date4 = now();
        $date5 = now();

        $details1 = [
            [
                'product_id' => 1,
                'unit' => 1,
                'quantity' => 2,
            ],
            [
                'product_id' => 1,
                'unit' => 2,
                'quantity' => 2,
            ],
            [
                'product_id' => 2,
                'unit' => 1,
                'quantity' => 43,
            ],
            [
                'product_id' => 3,
                'unit' => 2,
                'quantity' => 3,
            ],
            [
                'product_id' => 5,
                'unit' => 3,
                'quantity' => 1,
            ],
            [
                'product_id' => 13,
                'unit' => 1,
                'quantity' => 33,
            ],
        ];
        $details2 = [
            [
                'product_id' => 1,
                'unit' => 1,
                'quantity' => 4,
            ],
            [
                'product_id' => 1,
                'unit' => 2,
                'quantity' => 5,
            ],
            [
                'product_id' => 2,
                'unit' => 1,
                'quantity' => 4,
            ],
            [
                'product_id' => 3,
                'unit' => 2,
                'quantity' => 13,
            ],
            [
                'product_id' => 5,
                'unit' => 3,
                'quantity' => 11,
            ],
            [
                'product_id' => 13,
                'unit' => 1,
                'quantity' => 32,
            ],
        ];
        $details3 = [
            [
                'product_id' => 1,
                'unit' => 1,
                'quantity' => 14,
            ],
            [
                'product_id' => 1,
                'unit' => 2,
                'quantity' => 15,
            ],
            [
                'product_id' => 2,
                'unit' => 1,
                'quantity' => 24,
            ],
            [
                'product_id' => 3,
                'unit' => 2,
                'quantity' => 3,
            ],
            [
                'product_id' => 5,
                'unit' => 3,
                'quantity' => 1,
            ],
            [
                'product_id' => 13,
                'unit' => 1,
                'quantity' => 3,
            ],
        ];
        $details4 = [
            [
                'product_id' => 1,
                'unit' => 1,
                'quantity' => 7,
            ],
            [
                'product_id' => 1,
                'unit' => 2,
                'quantity' => 8,
            ],
            [
                'product_id' => 2,
                'unit' => 1,
                'quantity' => 29,
            ],
            [
                'product_id' => 3,
                'unit' => 2,
                'quantity' => 23,
            ],
            [
                'product_id' => 5,
                'unit' => 3,
                'quantity' => 21,
            ],
            [
                'product_id' => 13,
                'unit' => 1,
                'quantity' => 23,
            ],
        ];
        $details5 = [
            [
                'product_id' => 1,
                'unit' => 1,
                'quantity' => 17,
            ],
            [
                'product_id' => 1,
                'unit' => 2,
                'quantity' => 18,
            ],
            [
                'product_id' => 2,
                'unit' => 1,
                'quantity' => 9,
            ],
            [
                'product_id' => 3,
                'unit' => 2,
                'quantity' => 2,
            ],
            [
                'product_id' => 5,
                'unit' => 3,
                'quantity' => 2,
            ],
            [
                'product_id' => 13,
                'unit' => 1,
                'quantity' => 2,
            ],
        ];

        for ($i = 0 ; $i <=5; $i++){
            $createdAt = ($i === 0) ? $date1 : $date1->subDay();
            $order = Order::create(
                [
                    "mobile" =>"012253722",
                    'address_id' => 7,
                    "payment_method" => 1,
                    "delivery_id" => 6,
                    'shipping' => 20,
                    "created_at" => $createdAt
                ]);
            $this->orderSeederService->orderDetails($order->id,$details1);
            $this->orderSeederService->updateOrder($order->load('orderDetails'));
            $client = new Party([
                'name'          =>   "Admin (" .Setting::where('key','mobile')->value('value') ." )",
                'phone'         => Setting::where('key','abn')->value('value'),
                'address'       =>  Setting::where('key','address')->value('value')
            ]);
            $customer = new Party([
                'name'          =>  "User (012253722)" ,
                'address'       => "272 Adelaide Street,Adelaide,SA,5000" ,
                'phone'         => "personal",
                'custom_fields' => [
                    'order number' => $order->id,
                ],
            ]);
            $items = [];
            foreach ( $order->orderDetails as $orderInvoce ){
                $items [] =
                    InvoiceItem::make($orderInvoce->product->name)
                        ->description($orderInvoce->unit->name)
                        ->pricePerUnit($orderInvoce->price)
                        ->quantity($orderInvoce->quantity)
                        ->discount($orderInvoce->discount)
                        ->tax($orderInvoce->gst);
            }
            $notes = [
//            'we added ' . $tax . ' % tax on orders Total',
            ];

            $notes = implode("<br>", $notes);
            $invoice = Invoice::make('Butcher')
                // ->sequence($order->total)
                ->seller($client)
                ->buyer($customer)
                ->date(now())
                ->shipping(20)
                ->dateFormat('s:m:h m/d/Y')
                ->currencySymbol('$')
                ->currencyCode('ِ‘]')
                ->currencyFormat('{SYMBOL}{VALUE}')
                ->currencyThousandsSeparator('.')
                ->currencyDecimalPoint(',')
                ->filename($order->id. '_invoice')
                ->addItems($items)
                ->notes($notes)
                ->logo(public_path('assets/dashboard/logo.png'))
                ->save('invoices');
            $progressBar->advance();
        }

        for ($i = 0 ; $i <=5; $i++){
            $createdAt = ($i === 0) ? $date2 : $date2->subDay();
            $order = Order::create(
                [
                    "mobile" =>"0145253722",
                    'address_id' => 7,
                    "payment_method" => 1,
                    "delivery_id" => 6,
                    'shipping' => 20,
                    "created_at" => $createdAt
                ]);

            $this->orderSeederService->orderDetails($order->id,$details2);
            $this->orderSeederService->updateOrder($order->load('orderDetails'));
            $client = new Party([
                'name'          => "Admin (" .Setting::where('key','mobile')->value('value') ." )",
                'phone'         => Setting::where('key','abn')->value('value'),
                'address'       =>  Setting::where('key','address')->value('value')
            ]);
            $customer = new Party([
                'name'          =>  "khaled Ali(0145253722)" ,
                'address'       => "282 Adelaide Street,Adelaide,SA,5000" ,
                'phone'         => "personal",
                'custom_fields' => [
                    'order number' => $order->id,
                ],
            ]);
            $items = [];
            foreach ( $order->orderDetails as $orderInvoce ){
                $items [] =
                    InvoiceItem::make($orderInvoce->product->name)
                        ->description($orderInvoce->unit->name)
                        ->pricePerUnit($orderInvoce->price)
                        ->quantity($orderInvoce->quantity)
                        ->discount($orderInvoce->discount)
                        ->tax($orderInvoce->gst);
            }
            $notes = [
//            'we added ' . $tax . ' % tax on orders Total',
            ];

            $notes = implode("<br>", $notes);
            $invoice = Invoice::make('Butcher')
                // ->sequence($order->total)
                ->seller($client)
                ->buyer($customer)
                ->date(now())
                ->shipping(20)
                ->dateFormat('s:m:h m/d/Y')
                ->currencySymbol('$')
                ->currencyCode('ِ‘]')
                ->currencyFormat('{SYMBOL}{VALUE}')
                ->currencyThousandsSeparator('.')
                ->currencyDecimalPoint(',')
                ->filename($order->id. '_invoice')
                ->addItems($items)
                ->notes($notes)
                ->logo(public_path('assets/dashboard/logo.png'))
                ->save('invoices');
            $progressBar->advance();
        }

        for ($i = 0 ; $i <=5; $i++){
            $createdAt = ($i === 0) ? $date3 : $date3->subDay();
            $order = Order::create(
                [
                    "mobile" =>"+61456789012",
                    'address_id' => 4,
                    "payment_method" => 1,
                    "delivery_id" => 6,
                    "cashier_id" => 2,
                    'shipping' => 20,
                    "created_at" => $createdAt
                ]);

            $this->orderSeederService->orderDetails($order->id,$details3);
            $this->orderSeederService->updateOrder($order->load('orderDetails'));
            $client = new Party([
                'name'          => "Admin (" .Setting::where('key','mobile')->value('value') ." )",
                'phone'         => Setting::where('key','abn')->value('value'),
                'address'       =>  Setting::where('key','address')->value('value')
            ]);
            $customer = new Party([
                'name'          =>  "Michael Brown (+61456789012)" ,
                'address'       => "101 William Street,Perth,WA,6000" ,
                'phone'         => "23456789012",
                'custom_fields' => [
                    'order number' => $order->id,
                ],
            ]);
            $items = [];
            foreach ( $order->orderDetails as $orderInvoce ){
                $items [] =
                    InvoiceItem::make($orderInvoce->product->name)
                        ->description($orderInvoce->unit->name)
                        ->pricePerUnit($orderInvoce->price)
                        ->quantity($orderInvoce->quantity)
                        ->discount($orderInvoce->discount)
                        ->tax($orderInvoce->gst);
            }
            $notes = [
//            'we added ' . $tax . ' % tax on orders Total',
            ];

            $notes = implode("<br>", $notes);
            $invoice = Invoice::make('Butcher')
                // ->sequence($order->total)
                ->seller($client)
                ->buyer($customer)
                ->date(now())
                ->shipping(20)
                ->dateFormat('s:m:h m/d/Y')
                ->currencySymbol('$')
                ->currencyCode('ِ‘]')
                ->currencyFormat('{SYMBOL}{VALUE}')
                ->currencyThousandsSeparator('.')
                ->currencyDecimalPoint(',')
                ->filename($order->id. '_invoice')
                ->addItems($items)
                ->notes($notes)
                ->logo(public_path('assets/dashboard/logo.png'))
                ->save('invoices');
            $progressBar->advance();
        }

        for ($i = 0 ; $i <=5; $i++){
            $createdAt = ($i === 0) ? $date4 : $date4->subDay();
            $order = Order::create(
                [
                    "mobile" =>"+61000456789",
                    'address_id' => 3,
                    "payment_method" => 1,
                    "delivery_id" => 6,
                    "cashier_id" => 2,
                    'shipping' => 20,
                    "created_at" => $createdAt
                ]);

            $this->orderSeederService->orderDetails($order->id,$details4);
            $this->orderSeederService->updateOrder($order->load('orderDetails'));
            $client = new Party([
                'name'          => "Admin (" .Setting::where('key','mobile')->value('value') ." )",
                'phone'         => Setting::where('key','abn')->value('value'),
                'address'       =>  Setting::where('key','address')->value('value')
            ]);
            $customer = new Party([
                'name'          =>  "Emma Davis(+61000456789)" ,
                'address'       => " 789 George Street,Perth,WA,6000" ,
                'phone'         => "4567890123",
                'custom_fields' => [
                    'order number' => $order->id,
                ],
            ]);
            $items = [];
            foreach ( $order->orderDetails as $orderInvoce ){
                $items [] =
                    InvoiceItem::make($orderInvoce->product->name)
                        ->description($orderInvoce->unit->name)
                        ->pricePerUnit($orderInvoce->price)
                        ->quantity($orderInvoce->quantity)
                        ->discount($orderInvoce->discount)
                        ->tax($orderInvoce->gst);
            }
            $notes = [
//            'we added ' . $tax . ' % tax on orders Total',
            ];

            $notes = implode("<br>", $notes);
            $invoice = Invoice::make('Butcher')
                // ->sequence($order->total)
                ->seller($client)
                ->buyer($customer)
                ->date(now())
                ->shipping(20)
                ->dateFormat('s:m:h m/d/Y')
                ->currencySymbol('$')
                ->currencyCode('ِ‘]')
                ->currencyFormat('{SYMBOL}{VALUE}')
                ->currencyThousandsSeparator('.')
                ->currencyDecimalPoint(',')
                ->filename($order->id. '_invoice')
                ->addItems($items)
                ->notes($notes)
                ->logo(public_path('assets/dashboard/logo.png'))
                ->save('invoices');
            $progressBar->advance();
        }

        for ($i = 0 ; $i <=5; $i++){
            $createdAt = ($i === 0) ? $date5 : $date5->subDay();
            $order = Order::create(
                [
                    "mobile" =>"+61423456789",
                    'address_id' => 2,
                    "payment_method" => 1,
                    "delivery_id" => 6,
                    "cashier_id" => 2,
                    'shipping' => 20,
                    "created_at" => $createdAt
                ]);

            $this->orderSeederService->orderDetails($order->id,$details5);
            $this->orderSeederService->updateOrder($order->load('orderDetails'));
            $client = new Party([
                'name'          => "Admin (" .Setting::where('key','mobile')->value('value') ." )",
                'phone'         => Setting::where('key','abn')->value('value'),
                'address'       =>  Setting::where('key','address')->value('value')
            ]);
            $customer = new Party([
                'name'          =>  "Bob Williams(+61423456789)" ,
                'address'       => "456 Queen Street,Brisbane,QLD,4000" ,
                'phone'         => "45678901234",
                'custom_fields' => [
                    'order number' => $order->id,
                ],
            ]);
            $items = [];
            foreach ( $order->orderDetails as $orderInvoce ){
                $items [] =
                    InvoiceItem::make($orderInvoce->product->name)
                        ->description($orderInvoce->unit->name)
                        ->pricePerUnit($orderInvoce->price)
                        ->quantity($orderInvoce->quantity)
                        ->discount($orderInvoce->discount)
                        ->tax($orderInvoce->gst);
            }
            $notes = [
//            'we added ' . $tax . ' % tax on orders Total',
            ];

            $notes = implode("<br>", $notes);
            $invoice = Invoice::make('Butcher')
                // ->sequence($order->total)
                ->seller($client)
                ->buyer($customer)
                ->date(now())
                ->shipping(20)
                ->dateFormat('s:m:h m/d/Y')
                ->currencySymbol('$')
                ->currencyCode('ِ‘]')
                ->currencyFormat('{SYMBOL}{VALUE}')
                ->currencyThousandsSeparator('.')
                ->currencyDecimalPoint(',')
                ->filename($order->id. '_invoice')
                ->addItems($items)
                ->notes($notes)
                ->logo(public_path('assets/dashboard/logo.png'))
                ->save('invoices');
            $progressBar->advance();
        }

        $progressBar->finish();

    }


}
