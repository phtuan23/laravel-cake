<?php

namespace App\Http\Requests\Product;

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
            'name' => 'required|between:4,100',
            'price' => 'required|numeric|min:5',
            'sale_price' => 'nullable|numeric|min:1|lt:price',
            'images' => 'required|image'
        ];
    }

    public function messages(){
        return [
            'name.required' => 'Product Name is not empty',
            'name.string' => 'Product Name must be string',
            'name.between' => 'Product Name must be between 4 and 100 characters',
            'price.required' => 'Product Price is not empty',
            'price.numeric' => 'Product Price must be a number',
            'price.min' => 'Product Price minimum 5',
            'sale_price.numeric' => 'Product Sale Price must be a number',
            'sale_price.min' => 'Product Sale Price minimum is 1',
            'sale_price.lt' => 'Product Sale Price must be less than Price',
            'images.required' => 'Please choose a photo for the product',
            'images.image' => 'Product Image must be a photo type. Please try again',
            'category_id' =>  "Please choose Category for Product"
        ];
    }
}
