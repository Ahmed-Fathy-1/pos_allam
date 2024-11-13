<?php

namespace App\Http\Controllers\Api\Admin;

use App\Http\Controllers\Controller;
use App\Http\Helper\ResponseHelper;
use App\Http\Requests\Admin\SettingRequest;
use App\Http\Resources\Admin\Setting\SettingResource;
use App\Http\Traits\imagesTrait;
use App\Models\MetaSeo;
use App\Models\Setting;
use Illuminate\Support\Arr;
use Symfony\Component\HttpFoundation\Response as ResponseAlias;

class SettingController extends Controller
{
    use imagesTrait;
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $meta = MetaSeo::wherePageId(1)->first();
        $allSettings = Setting::get();
        $setting= $allSettings->flatMap(function  ($allSettings){
            return [ $allSettings->key => $allSettings->value];
        });
        return view('Admin.pages.setting.index',compact('setting','meta'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(SettingRequest $request)
    {
       foreach ($request->validated() as $key => $value){
           if($value !=null){
               if ($key === 'logo'){
                   $value =  $this->image($value,'logo');
               }
               Setting::where('key', $key)->update(['value' => $value]);
           }
       }
        return redirect()->route('setting')->with('success',"Data Updated Successfully");
    }

}
