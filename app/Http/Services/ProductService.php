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
    function create(array $input,$image){
        $productData = array_merge($input, ['image' => $image,'status'=>'1']);
       $product=Product::create($input);
       return $product;
    }
    function update($request, string $id){

        $product=Product::where('id',$id)->update($request);
        return $product;
     }

     function updateWithImage($request,$image, string $id){
        $productData = array_merge($request, ['image' => $image]);
        $product=Product::where('id',$id)->update($productData);
        return $product;
     }
     function index($request){

        $query= Product::query()->join('categories', 'products.category_id', '=', 'categories.id')
        ->select('products.id', 'products.product_name', 'products.description', 'categories.category_name', 'products.image', 'products.status');

        if (isset($request->status) && isset($request->category_id)) {
            $query = $query->where(function ($query) use ($request) {
                $query->where('products.status', $request->status)
                      ->orWhere('categories.id', $request->category_id);
            });
        } elseif (isset($request->status)) {
            $query = $query->where('products.status', $request->status);
        } elseif (isset($request->category_id)) {
            $query = $query->where('categories.id', $request->category_id);
        }
           return $query;
       }
}
