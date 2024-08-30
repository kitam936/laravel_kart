<?php

namespace App\Services;

use Illuminate\Support\Facades\Storage;

class UploadService
{
    public static function upload($DocFile,$stint_id)
    {
        // dd($DocFile['doc']);
        if(is_array($DocFile))
        {
            $file = $DocFile['data'];
        }else{
            $file = $DocFile;
        }
        // dd($file);

        // $fileName = $file->getClientOriginalName();
        // $extension = $file->extension();
        // dd($fileName, $extension);

        $fileNameToStore = 'stint'.$stint_id.'_'.$file->getClientOriginalName();
        // dd($fileNameToStore);
        Storage::putFileAs('public/data',  $file, $fileNameToStore );
        return $fileNameToStore;
    }
}
