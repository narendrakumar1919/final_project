<?php
namespace App\Http\Services;

use App\Models\Admin;
use Illuminate\Support\Arr;

class ProfileService{
    function __construct(){

    }

    /**
     * file Upload.
     * @parms array $input
     * @return $file_name
     */
    function update(array $inputs, $id){
        $admin=Admin::where('id',$id)->update($inputs);
        return $admin;
    }
    function updatePassword(array $inputs, $id){
        $inputs = Arr::except($inputs,['confirm_password']);
        $admin=Admin::where('id',$id)->update($inputs);
        return $admin;
    }
    

}
