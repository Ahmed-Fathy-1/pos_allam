<?php

namespace App\Http\Controllers\Api\Admin;

use App\Http\Controllers\Controller;
use App\Http\Requests\Admin\Meta\CategoryMetaRequest;
use App\Http\Requests\Admin\Meta\MetaRequest;
use App\Models\Category;
use App\Models\MetaSeo;
use App\Models\Product;
use Illuminate\Http\Request;

class MetaDashboardController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {

    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {

    }

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(string $id)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(MetaRequest $request)
    {
        $metaSeo = MetaSeo::wherePageId($request->page_id)->firstOrFail();
        $metaSeo->update([
           "title" => $request->title,
            "canonical_url" => $request->canonical_url,
            "keyword" => $request->keyword,
            "description" => $request->description,
            "schema_markup" => $request->schema_data,
        ]);
        return redirect()->back()->with('success','Meta Tags Updated Successfully');
    }

    public function metaProduct(MetaRequest $request,$id){
        $product = Product::findOrFail($id);
        $product->update([
            'slug_url' => strtolower(str_replace(" ","-",$request->slug_url)),
            'new_redirection' =>$request->new_redirection,
        ]);
        $metaProduct = MetaSeo::whereProductId($id)->firstOrFail();
        $metaProduct->update([
            "title" => $request->title,
            "canonical_url" => $request->canonical_url??"https://aitech.net.au/butcher/products"."/". $product->slug_url,
            "keyword" => $request->keyword,
            "description" => $request->description,
            "schema_markup" => $request->schema_data,
        ]);
        return redirect()->back()->with('success','Meta Tags Updated Successfully');
    }
    public function metaCategory(CategoryMetaRequest $request,$id){
        $category = Category::findOrFail($id);
        $category->update([
            'slug_url' => strtolower(str_replace(" ","-",$request->slug_url)),
            'new_redirection' =>$request->new_redirection,
        ]);
        $metaProduct = MetaSeo::whereCategoryId($id)->firstOrFail();
        $metaProduct->update([
            "title" => $request->title,
            "canonical_url" => $request->canonical_url??"https://aitech.net.au/butcher/category"."/". $category->slug_url,
            "keyword" => $request->keyword,
            "description" => $request->description,
            "schema_markup" => $request->schema_data,
        ]);
        return redirect()->back()->with('success','Meta Tags Updated Successfully');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        //
    }
}
