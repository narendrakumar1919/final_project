<?php
namespace App\Http\Services;

use App\Models\Product;

class ProductUpdateService{
    function __construct(){

    }

    /**
     * update a resource in storage.
     * @parms $request string $id
     * @return $user
     */

    function update($request ,string $id){
        $product=Product::where('id',$id)->update([
            'porduct_name' => $request->product_name,
            // 'description' => $request->description,
        ]);
        return $product;
    }
}