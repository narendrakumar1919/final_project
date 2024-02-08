<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;


class CategoryRequest extends FormRequest
{
    /**
     * Determine if the user is authorized to make this request.
     */
    public function authorize(): bool
    {
        return true;
    }

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array<string, \Illuminate\Contracts\Validation\ValidationRule|array<mixed>|string>
     */
    public function rules(): array
    {

            if(request()->path() == 'categories/create'){
            return [
                'category_name' => 'required|min:4|max:30|alpha_spaces',
                'description' => 'required|min:5||max:200',
                'image' => 'required|mimes:jpg,png,jpeg,gif',
            ];
            }else{
                return[
                    'category_name' => 'required|min:4|max:30|alpha_spaces',
                    'description' => 'required|min:5||max:200',
                    'image'=>'mimes:jpg,png,jpeg,gif'
                ];
            }
        // }
    }

    public function messages(): array
    {
        return [
            'category_name.alpha_spaces' => 'may only contain letters and spaces',
            // 'category_name.alpha' => 'Category Name must be in Alphabettttt',
            // 'description.required' => 'A description is required',
            // 'image.required' => 'Image is required',

        ];
    }
}
