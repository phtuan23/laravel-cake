<?php

namespace App\Http\Requests\Account;

use Illuminate\Foundation\Http\FormRequest;

class CreateRequest extends FormRequest
{
    /**
     * Determine if the user is authorized to make this request.
     *
     * @return bool
     */
    public function authorize()
    {
        return true;
    }

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array
     */
    public function rules()
    {
        return [
            'name' => 'required|between:4,20|unique:account',
            'password' => 'required|min:6',
            'email' => 'required|email|between:10,200|unique:account'   
        ];
    }

    public function messages(){
        return [
            'name.required' => 'Name is not empty!',
            'name.between' => 'Name must be between 4 and 20 character',
            'name.unique' => 'Name is already exists!',
            'email.required' => 'Email is not empty!',
            'email.email' => 'Email is invalid!',
            'email.unique' => 'Email is already exists!',
            'password.required' => 'Password is not empty!',
            'password.min' => 'Password minimum 6 character'
        ];
    }
}
