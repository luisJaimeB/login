<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class ProductCreateRequest extends FormRequest
{
    
    public function authorize(): bool
    {
        return true;
    }

    
    public function rules(): array
    {
        return [
            'name' => 'required|max:50|unique:products',
            'description' => 'required|min:50|max:340',
            'price' => 'required',
            'image' => 'required|image|mimes:jpeg,png|max:3064'
        ];
    }
}