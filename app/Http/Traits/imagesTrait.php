<?php
namespace App\Http\Traits;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;

use Illuminate\Support\Facades\File;
trait imagesTrait {

    public function verifyAndStoreImage( Request $request, $fieldname = 'file', $directory = 'unknown' ) {
        if( $request->hasFile( $fieldname )) {
            foreach($request->file as $myfile) {
                $file = $myfile;
                $ext = $file->getClientOriginalExtension();
                $filename = $directory.'_'.time().'.'.$ext;
                $storagePath = Storage::put('public/'.$directory, $file);
                $storageName = basename($storagePath);
                $myff = $directory . '/' . $storageName;
                $mydata[] = $myff;
            }
            return $mydata;
        }
        else {
            return ['products/pbeef2.webp'];
        }
    }


    //delete old images
    public function deleteOldFiles($oldFiles)
    {
        //check if there are data
        if ($oldFiles !== null) {
            foreach ($oldFiles as $oldFile) {
                if ($oldFile !== null) {
                    unlink('storage/' . $oldFile);
                }
            }
        }
    }
    final public function image ($image,$folder,$oldImage=null){
        // delete old image
        if ($oldImage && File::exists(storage_path('app/public/' . $oldImage))) {
            File::delete(storage_path('app/public/' . $oldImage));
        }
        $rand= rand(999999, 1000000);
        $imageName = time().'_'.$rand. '.' . $image->getClientOriginalExtension();
        $image->move(storage_path('app/public/'.$folder),$imageName);
        return $folder.'/'.$imageName;
    }

//    final public function image ($image,$folder){
//        $rand= rand(999999, 1000000);
//        $imageName = time().'_'.$rand. '.' . $image->getClientOriginalExtension();
//        $image->storeAs('/public/'.$folder, $imageName);
//        return $imageName;
//    }


}
