<?php

namespace App\Http\Services;

use App\Models\Product;

class ProductService{

    function __construct(){

    }

     /**
     * Store a newly created resource in storage.
     * @parms array $input
     * @return Product
     */
    function create(array $input){
       $product=Product::create($input);
       return $product;
    }
    function update($request, string $id){
        $product=Product::where('id',$id)->update($request);
        return $product;
     }

     function updateWithImage($request, string $id){
        $product=Product::where('id',$id)->update($request);
        return $product;
     }
}
