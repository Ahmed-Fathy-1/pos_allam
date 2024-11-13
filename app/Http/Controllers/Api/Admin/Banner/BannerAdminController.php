<?php

namespace App\Http\Controllers\Api\Admin\Banner;
use App\Http\Controllers\Controller;
use App\Http\Helper\ResponseHelper;
use App\Http\Requests\Admin\Banner\BannerRequest;
use App\Http\Resources\Admin\Banner\BannerResource;
use App\Models\Banner;
use App\Models\Category;
use Illuminate\Http\Request;
use Illuminate\Http\Response;
use Symfony\Component\HttpFoundation\Response as ResponseAlias;

class BannerAdminController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $banners = Banner::latest('id')->get();
        $categories = Category::get();
        return view('Admin.pages.banner.index',compact('banners','categories'));
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(BannerRequest $request)
    {
        try {
            $file = $request->file('image');
            $filename = time() . '.' . $file->getClientOriginalExtension();
            $file->storeAs('/public/banners/', $filename);
           Banner::create([
                'title' => $request->title,
                'description' => $request->description,
                'category_id' => $request->category_id,
                'text_color' => $request->text_color,
                'image'  => $filename,
                 "alt" => $request->alt
            ]);
           return redirect()->back()->with('success','Banner Added Successfully');
        }catch (\Exception $ex){
            return redirect()->back()->withErrors($ex->getMessage());
        }
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(BannerRequest $request)
    {
        try {
           $banner = Banner::findOrFail($request->id);
            if($request->has('image')){
                $oldImagePath = asset('storage/banners/') . $banner->image;
                if (file_exists($oldImagePath)) {
                    unlink($oldImagePath);
                }
                // update image
                $image = $request->file('image');
                $filename = time() . '.' . $image->getClientOriginalExtension();
                $image->storeAs('/public/banners/', $filename);
                $banner->update([
                    'image' =>  $filename
                ]);
            }
            if(!$request->has('status'))
              $status = 0;
            else
                $status = 1;
            $banner->update([
                'title' => $request->title,
                'description' => $request->description,
                'category_id' => $request->category_id,
                'text_color' => $request->text_color,
                'status' => $status,
                "alt" => $request->alt
            ]);
            return redirect()->back()->with('success','Banner Update Successfully');
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
            $banner = Banner::findOrFail($id);
            $oldImagePath = asset('storage/banners/') . $banner->image;
            if (file_exists($oldImagePath)) {
                unlink($oldImagePath);
            }
            $banner->delete();
            return redirect()->back()->with('success','Banner deleted Successfully');
        }catch (\Exception $ex){
            return redirect()->back()->withErrors($ex->getMessage());
        }
    }
}
