<?php

namespace App\Http\Controllers\Api\Admin;

use App\Http\Controllers\Controller;
use App\Http\Helper\ResponseHelper;
use App\Http\Requests\Admin\Category\CategoryRequest;
use App\Http\Requests\Admin\Category\CategoryUpdateRequest;
use App\Http\Traits\imagesTrait;
use App\Models\Category;
use App\Models\MetaSeo;
use App\services\category\categoryServices;
use Illuminate\Http\Request;
use Illuminate\Http\Response;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Str;
class CategoryController extends Controller
{
    use imagesTrait;

    public function index(){
        $categories = Category::latest('id')->get();
        return  view('Admin.pages.category.index',compact('categories'));
    }

    public function create(){
        return view('Admin.pages.category.create');
    }

    public  function store(CategoryRequest $request,categoryServices $services){
        try {
                // multi images
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
                if($request->canonical_url == "https://aitech.net.au/butcher/category/"){
                    $canonical =$request->canonical_url. $category->slug_url;
                }else{
                    $canonical = $request->canonical_url??"https://aitech.net.au/butcher/category"."/". $category->slug_url;
                }
            $services->meta($category->id,$request->title??$category->name,$canonical ,$request->keyword,$request->description_meta,$request->schema_data);
            return  redirect()->route('category')->with('success','Category Added Successfully');
        }catch ( \Exception $ex){
            return redirect()->back()->withErrors($ex->getMessage());
        }
    }

    public function edit($id){
        $category = Category::findOrFail($id);
        $meta = MetaSeo::whereCategoryId($id)->first();
        return view('Admin.pages.category.edit',compact('category','meta'));
    }

    public function update(CategoryUpdateRequest $request,$id){
        try {

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
            return  redirect()->back()->with('success','Category Added Successfully');
        }catch (\Exception $ex){
            return redirect()->back()->withErrors($ex->getMessage());
        }
    }

    public function destroy($id){
        try {
                $category = Category::findOrFail($id);
                if($category->products->isEmpty()){
                    $category->delete();
                    return  redirect()->back()->with('success','Category deleted Successfully');
                }else{
                    return  redirect()->back()->withErrors('This Category Have products cannot deleted it');
                }
        }catch (\Exception $ex){
            return redirect()->back()->withErrors($ex->getMessage());
        }
    }
}
