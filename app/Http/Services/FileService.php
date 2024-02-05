<?php
namespace App\Http\Services;

class FileService{
    function __construct(){

    }

    /**
     * file Upload.
     * @parms $file, string $destinationPath
     * @return $file_name
     */
    function fileUpload($file, string $destinationPath){

        $ext = $file->getClientOriginalExtension() !== "" ? $file->getClientOriginalExtension() : $file->extension();
        $file_name=time().".".$ext;
        $file->move($destinationPath,$file_name);
        return $file_name;
    }
}