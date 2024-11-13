<?php

namespace App\Http\Controllers\Api\Admin;

use App\Http\Controllers\Controller;
use App\Http\Requests\Admin\ProductRequest;
use App\Http\Requests\Admin\ProductUpdateRequest;
use App\Http\Traits\imagesTrait;
use App\Models\Category;
use App\Models\Customer;
use App\Models\MetaSeo;
use App\Models\OrderDetail;
use App\Models\priceLogs;
use App\Models\Product;
use App\Models\StockLog;
use App\Models\Unit;
use App\services\product\productPriceService;
use Carbon\Carbon;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;

class ProductController extends Controller
{
    use imagesTrait;
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $products = Product::with('prices')->get();
        return view('Admin.pages.products.index',compact('products'));
    }

    /**
     * create a listing of the resource.
     */

    public function create(){
        $categories = Category::get();
        $units = Unit::whereStatus(true)->get();
        $customers = Customer::wherehas('addresses')->get();
        return view('Admin.pages.products.create',compact('categories','units','customers'));
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(ProductRequest $request,productPriceService $service)
    {
        // images
        if( $request->hasFile( 'file' )) {
            $images = [];
            foreach($request->file as $myfile) {
                $rand = rand(10000, 99999);
                $directory = 'products';
                $ext = $myfile->getClientOriginalExtension();
                $file = time() . "_" . $rand . '.' . $ext;
                $filename = 'products/'.$file;
                // Store the file
                $stored = $myfile->move(storage_path('app/public/products'), $file);
                $images[] = $filename;
            }
        }
        else {
            $images = ['products/pbeef2.webp'];
        }

       if(isset($request->alts)){
           $alt =  $service->format($request->alts);
       }
       $product =  Product::create([
            "name" => $request->name,
            "slug_url" => strtolower(str_replace(" ","-",$request->name)),
            "description" => $request->description,
            "category_id" => $request->category_id,
            'images' => $images,
            "alts"  => [$request->name]
        ]);
       // store prices
        $service->productPrice($product->id,$request->prices);
        // store special prices
        $service->specialPrice($product->id,$request->special_prices);

        if($request->canonical_url == "https://aitech.net.au/butcher/products/"){
            $canonical =$request->canonical_url. $product->slug_url;
        }else{
            $canonical = $request->canonical_url??"https://aitech.net.au/butcher/products"."/". $product->slug_url;
        }
        $service->meta($product->id,$request->title??$product->name,$canonical,$request->keyword,$request->description_meta,$request->schema_data);
        return redirect()->route('products')->with('success','Product Added Successfully');
    }

    /**
     * show a list of the resource.
     */

    public function show($id){

        $product = Product::with('prices','specialPrices')->findOrFail($id);
        $logs = priceLogs::whereProductId($id)->get();
        $stock_logs = StockLog::whereProductId($id)->get();
        $pOrder = OrderDetail::where('product_id',$id)->get();
        $allpOrder = OrderDetail::count();
        $percentage = 0;
        if($pOrder->count() > 0){
            $percentage = ($pOrder->count() / $allpOrder) * 100;
        }
        $year = date('Y');
        $month = date('m');
        $dates = [];
        $total = [];
        for($i = 0; $i < 12; $i++){
            $dates[] = date('M Y', strtotime("$year-$month-01"));
            $total[] = OrderDetail::whereProductId($id)
                ->whereYear('created_at', $year)
                ->whereMonth('created_at', $month)
                ->sum('sub_total');
            $month--;
            if ($month == 0) {
                $month = 12;
                $year--;
            }
        }
        $unitId = $product->prices->value('unit_id');
        $currentDate = Carbon::tomorrow(); $lineDate = []; $priceLogs= [];
        for ($i = 7 ; $i >= 0 ; $i--){
            $startDate = $currentDate->subDays(1)->startOfDay();
            $endDate = $startDate->copy()->endOfDay();
            $lineDate[] = $startDate->format('d M');
            $priceLogs [] = priceLogs::whereProductId($id)->whereunitId($unitId)
                            ->whereBetween('created_at', [$startDate, $endDate])
                           ->value('new_price');
        }
        $lineDate = array_reverse($lineDate);
        $priceLogs = array_reverse($priceLogs);
        return view('Admin.pages.products.log',
            [
                "product" => $product,
                "logs" => $logs,
                "stock_logs" => $stock_logs,
                "pOrder" => $pOrder,
                "percentage" => ceil($percentage),
                "dates" => array_reverse($dates),
                "total" => array_reverse($total),
                "priceLogs" => $priceLogs,
                "lineDate" => $lineDate,
            ]);
    }

    /**
     * edit a list of the resource.
     */
    public function edit($id){
        $product = Product::with('prices','specialPrices')->findOrFail($id);
        $meta = MetaSeo::whereProductId($id)->firstOrFail();
        $categories = Category::get();
        $units = Unit::whereStatus(true)->get();
        $customers = Customer::whereHas('addresses')->get();
        return view('Admin.pages.products.edit',compact('product','categories','customers','units','meta'));
    }

    /**
     * Update the specified resource in storage.
     */

    public function update(ProductUpdateRequest $request, string $id,productPriceService $service)
    {

        try {
            $product = Product::findOrFail($id);
            if(isset($request->file) && $request->file != null){
                $images = [];
                foreach($request->file as $myfile) {
                    $rand = rand(10000, 99999);
                    $directory = 'products';
                    $ext = $myfile->getClientOriginalExtension();
                    $file = time() . "_" . $rand . '.' . $ext;
                    $filename = 'products/' .$file;
                    // Store the file
                    $stored = $myfile->move(storage_path('app/public/products'), $file);
                    $images[] = $filename;
                }
                $product->update([
                    'images' => $images
                ]);
            }
            $alt =  $service->format($request->alts);
            $product->update([
                "name" => $request->name,
                "discount" => $request->discount??0,
                "category_id" => $request->category_id,
                "alts"  => $alt,
                "status" => $request->status
            ]);
            $service->priceUpdate($id,$request->prices);
            $service->specialPrice($id,$request->special_prices);
            return redirect()->route('product-show',$id)->with('success','Product Updated Successfully');
        }catch (\Exception $ex){
            return redirect()->back()->withErrors($ex->getMessage());
        }
    }

    /**
     * Remove the specified resource from storage.
     */

    public function destroy(string $id)
    {
        try {
            $product = Product::findOrFail($id);
            $order = OrderDetail::whereProductId($id)->get();
            if($order->count() > 0){
              return redirect()->back()->withErrors('cannot deleted , This product Related to Invoices ');
            }
            $product->delete();
            return redirect()->back()->with('success','Product Deleted Successfully');
        }catch (\Exception $ex){
            return redirect()->back()->withErrors($ex->getMessage());
        }
    }
}
