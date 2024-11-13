<?php

namespace App\Http\Traits\Utils;

use Illuminate\Http\UploadedFile;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Str;

trait UploadFileTrait
{
    private $mainFolder = 'uploads';

    public function uploadFile(UploadedFile $file, $folderPath)
    {
        $folderPath = $this->mainFolder . '/' . $folderPath;
        // Generate a unique name for the file
        $fileName = Str::uuid() . '.' . $file->getClientOriginalExtension();

        // Upload the file to the specified folderPath
        $file->storeAs($folderPath, $fileName, 'public');

        return $fileName;
    }

    public function updateFile(UploadedFile $file,$currentFile, $folderPath)
    {
        $currentFile = $this->mainFolder . '/' . $folderPath . '/' . $currentFile;

        // Delete the current file
        Storage::disk('public')->delete($currentFile);

        // Upload the new file
        return $this->uploadFile($file, $folderPath);
    }

    public function getFileWithFullPath($file, $folder)
    {
        if(is_array($file)){
            $files = [];
            foreach($file as $f){
                $folderPath = 'storage/' . $this->mainFolder . '/' . $folder . '/' . $f;
                $files[] = asset($folderPath);
            }
            return $files;
        }else{
            $folderPath = 'storage/' . $this->mainFolder . '/' . $folder . '/' . $file;
            return asset($folderPath);
        }
    }

    public function getFileWithFullPathPublic($file, $folder)
    {
        $folderPath = 'storage/' . $this->mainFolder . '/' . $folder . '/' . $file;
        return asset($folderPath);
    }
}
