<?php

namespace App\Http\Requests\Category;
use App\Models\Category;

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
            'name' => 'required|between:3,100|string|unique:category,name,'.$this->category->id
        ];
    }

    public function messages(){
        return [
            'name.required' => 'Categrory Name is not empty.',
            'name.unique' => 'Categrory Name is already exist',
            'name.between' => 'Categrory Name must be between 3 and 100 characters',
            'name.string' => 'Categrory Name is invalid'
        ];  
    }
}
