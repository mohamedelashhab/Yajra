<?php
namespace App\Http\Controllers\Traits;

use Illuminate\Http\Request;

trait FileUpload
{

    /**
     * File upload trait used in controllers to upload files
     */
    public function saveFiles($file, $folder)
    {
        $destinationPath = '/uploads/'.$folder;

        $file_name = time().'-'.$file->getClientOriginalName();
        $file->move($_SERVER['DOCUMENT_ROOT'].$destinationPath, $file_name); 

        return $file_name;
    }

}