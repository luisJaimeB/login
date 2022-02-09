<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class ProductEditRequest extends FormRequest
{
    
    public function authorize(): bool
    {
        return true;
    }

    
    public function rules(): array
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
