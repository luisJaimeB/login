<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class RoleEditRequest extends FormRequest
{
    public function authorize(): bool
    {
        return true;
    }


    public function rules(): array
    {
        $role = $this->route('role');
        return [
            'name' => ['required', 'min:3', 'max:15', 'unique:roles,' . $role->id],
        ];
    }
}
