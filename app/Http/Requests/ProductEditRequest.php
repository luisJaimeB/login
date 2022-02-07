<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class ProductEditRequest extends FormRequest
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
        $product = $this->route('product');
        return [
            'name' => ['required', 'min:5', 'max:50', 'unique:products,name,' . $product->id],
            'description' => ['required', 'min:50', 'max:340'],
            'price' => ['required'],
            'image' => ['nullable', 'image', 'mimes:jpeg,png', 'max:3064'],
        ];
    }
}
