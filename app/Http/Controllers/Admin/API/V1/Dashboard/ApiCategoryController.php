<?php

namespace App\Http\Controllers\Admin\API\V1\Dashboard;

use App\Http\Controllers\Controller;
use App\Http\Helper\ResponseHelper;
use App\Http\Requests\Admin\Category\CategoryRequest;
use App\Http\Requests\Admin\Category\CategoryUpdateRequest;
use App\Http\Resources\Admin\Category\Categoryresource;
use App\Http\Traits\imagesTrait;
use App\Models\Category;
use App\services\category\categoryServices;
use Illuminate\Http\Request;
use Illuminate\Support\Str;

class ApiCategoryController extends Controller
{
    use imagesTrait;
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $categories = Category::latest('id')->get();
        return ResponseHelper::jsonResponse(['category' => Categoryresource::collection($categories)]);
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(CategoryRequest $request,categoryServices $services)
    {
        $imgs =  $this->verifyAndStoreImage($request, 'file', 'category');
        if (isset($request->alt)){
            $alts = explode(',', $request->alts);
            $formattedAlts = array_map(function($alt){
                return Str::of(trim($alt))->trim('"')->__toString();
            }, $alts);
        }
        $category =  Category::create([
            "name" => $request->name,
            "slug_url" => strtolower(str_replace(" ","-",$request->name)),
            "description" => $request->description,
            "images" => $imgs,
            "alts" => [$request->name]
        ]);
        $category->refresh();
        if($request->canonical_url == "https://aitech.net.au/butcher/category/"){
            $canonical =$request->canonical_url. $category->slug_url;
        }else{
            $canonical = $request->canonical_url??"https://aitech.net.au/butcher/category"."/". $category->slug_url;
        }
        $services->meta($category->id,$request->title??$category->name,$canonical ,$request->keyword,$request->description_meta,$request->schema_data);
        return ResponseHelper::jsonResponse(['category' => new Categoryresource($category)]);
    }

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        $category = Category::findOrFail($id);
        return ResponseHelper::jsonResponse(['category' => new Categoryresource($category)]);
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(CategoryUpdateRequest $request, string $id)
    {
        $category = Category::findOrFail($id);
        if (isset($request->file) && $request->file !=null){
            // $this->deleteOldFiles($category->images);
            $images =  $this->verifyAndStoreImage($request, 'file', 'category');
            $category->update([ "images" => $images]);
        }
        if(isset($request->alts)){
            $alts = explode(',', $request->alts);
            $formattedAlts = array_map(function($alt) {
                return Str::of(trim($alt))->trim('"')->__toString();
            }, $alts);
        }
        $category->update([
            "name" => $request->name,
            "description" => $request->description,
            "alts" => $formattedAlts??null
        ]);
        return ResponseHelper::jsonResponse(['category' => new Categoryresource($category)]);
    }

    /**
     * Remove the specified resource from storage.
     */

    public function destroy($id){
        $category = Category::findOrFail($id);
        if($category->products->isEmpty()){
            $category->delete();
            return ResponseHelper::jsonResponse([],'Category Deleted Successfully');
        }else{
            return ResponseHelper::errorResponse('Category Deleted Successfully');
        }

    }
}
