<?php

namespace App\Http\Requests\Category;

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
            'name' => 'required|unique:category'
        ];
    }

    public function messages(){
        return [
            'name.required' => 'Categrory Name is not empty.',
            'name.unique' => 'Categrory Name is already exist'
        ];  
    }
}
