<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class CategoryEditRequest extends FormRequest
{
    public function authorize(): bool
    {
        return true;
    }


    public function rules(): array
    {
        $category = $this->route('category');
        return [
            'name' => ['required', 'min:3', 'max:25', 'unique:categories,' . $category->id]
        ];
    }
}
