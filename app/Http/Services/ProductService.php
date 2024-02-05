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
}