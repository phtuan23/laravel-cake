<?php

namespace App\Http\Requests\Customer;

use Illuminate\Foundation\Http\FormRequest;

class UpdateRequest extends FormRequest
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
            'name' => 'required|string|between:3,100',
            'email' => 'required|email|max:200|unique:customer,email,'.$this->customer->id,
            'password' => 'required|min:6',
            'image' => 'nullable|image'
        ];
    }

    public function messages(){
        return [
            'image.image' => 'Avatar must be a photo (JPG,JPEG,PNG)',
            'name.required' => 'Name is not empty',
            'name.string' => 'Name must be string',
            'name.between' => 'Name must be between 3 and 100 characters',
            'email.required' => 'Email is not empty',
            'email.email' => 'Email must be a valid email address',
            'email.unique' => 'Email address is already exist',
            'password.required' => 'Password is not empty',
            'password.min' => 'Password minimum 6 characters'
        ];
    }
}
