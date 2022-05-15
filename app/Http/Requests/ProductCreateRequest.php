<?php

namespace App\Http\Requests;

use App\Rules\ProductRules;
use Illuminate\Foundation\Http\FormRequest;

class ProductCreateRequest extends FormRequest
{
    public function authorize(): bool
    {
        return true;
    }


    public function rules(): array
    {
        return ProductRules::toArray();
    }
}
