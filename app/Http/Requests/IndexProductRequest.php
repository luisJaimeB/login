<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class IndexProductRequest extends FormRequest
{
    public function authorize(): bool
    {
        return true;
    }


    public function rules(): array
    {
        return [
            'search' => ['filled', 'string', 'max:50'],
            'category' => ['filled', 'integer', 'exists:categories,id']
        ];
    }
}
