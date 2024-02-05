<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class ProductAddRequest extends FormRequest
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
        // dd(request()->all());.
        return [
            'product_name'=>'required|alpha',
            'category_id'=>'required',
            'description'=>'required',
            'image'=>'required',
        ];
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
