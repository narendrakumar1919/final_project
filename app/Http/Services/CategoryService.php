<?php

namespace App\Http\Services;

use App\Models\Category;

class CategoryService{

    function __construct(){

    }

     /**
     * Store a newly created resource in storage.
     * @parms array $input
     * @return Category
     */
    function create(array $input){
       $category=Category::create($input);
       return $category;
    }
}