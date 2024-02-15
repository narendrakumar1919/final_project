<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class ProductRequest extends FormRequest
{
    public function authorize(): bool
    {
        return true;
    }
    /**
     * Determine if the user is authorized to make this request.
     */
    public function rules(): array
    {

        if(request()->path() == 'products/create'){
        return [
            'product_name'=>'required|min:5|max:20|alpha_spaces',
            'category_id'=>'required',
            'description'=>'required|min:5||max:200',
            'image'=>'required|mimes:jpg,png,jpeg,gif',
        ];
        }else{
        return [
            'product_name' => 'required|min:5|max:20|alpha_spaces',
            'description' => 'required|min:5||max:200',
            'category_id'=>'required',
            'image'=>'mimes:jpg,png,jpeg,gif'
        ];
        }
    }
    public function messages(): array
    {
          return[
              'product_name.required'=> 'a title is required',
              'product_name.alpha'=> 'Product Name must be in Alphabet',
              'category_id.required'=>'select a Category',
              'description.required'=> 'a title is required',
              'image.required'=> 'Image is required'
          ];
    }
}
