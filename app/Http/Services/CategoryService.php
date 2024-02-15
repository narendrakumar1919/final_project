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
    function create(array $input,$image){
        $categoryData = array_merge($input, ['image' => $image,'status'=>'1']);
        $category = Category::create($categoryData);
        $category->save();
        return $category;
    }

    function update($request, string $id){
        $category=Category::where('id',$id)->update($request);
        return $category;
     }

     function updateWithImage($request,$image, string $id){
        $categoryData = array_merge($request, ['image' => $image]);
        $category=Category::where('id',$id)->update($categoryData);
        return $category;
     }
     function index($request){

         $data = Category::select('*');
         if($request->status==1||$request->status==0){
          if(isset($request->status)){
            //  dd('yguhijk');
                $data = $data->where('status', $request->status );
            }
         }
            return $data;
        }

        function updateStatus($request, $id){

            $category=$id->update($request);
            return $category;
         }
}
