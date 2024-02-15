<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class RegisterRequest extends FormRequest
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

        if(request()->path() == 'admin/create'){
        return [
            'name'=>'required|min:4|max:30|',
            'mobile'=>'required|numeric|digits:10|regex:/^[6-9]\d{9}$/',
            'email'=>'required|email|unique:admins,email',
            'password'=>'required|min:5|max:20',
            'confirm_password' => 'required|same:password'
        ];
    }else{
        return [
            'name'=>'required|min:4|max:20|alpha_spaces',
            'mobile'=>'required|numeric|digits:10|regex:/^[6-9]\d{9}$/',
            'email'=>'required|email|unique:users,email',
            'password'=>'required|min:5|max:20',
            'confirm_password' => 'required|same:password'
        ];
    }
    }
    public function messages(): array
    {
          return[
              'name.required'=> 'Name is required',
              'mobile.required'=> 'Mobile no. is required',
              'mobile.digits'=>'Enter a Valid no.',
              'mobile.regex'=>'Enter a Valid no.',
              'email.required'=> 'Email is required',
              'email.unique'=>'Email already registered',
              'password.required'=> 'Password is required'
          ];
    }
}
