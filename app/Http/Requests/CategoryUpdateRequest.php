<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class CategoryUpdateRequest extends FormRequest
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
        return [
            'category_name' => 'required|alpha',
            'description' => 'required',
        ];
    }
    public function messages(): array
    {
        return [
            'category_name.required' => 'A title is required',
            'category_name.alpha' => 'Category Name must be in Alphabet',
            'description.required' => 'A description is required',
        ];
    }
}
