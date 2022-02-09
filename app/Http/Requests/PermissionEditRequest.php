<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class PermissionEditRequest extends FormRequest
{
    
    public function authorize(): bool
    {
        return true;
    }

    
    public function rules(): array
    {
        $permission = $this->route('permission');
        return [
            'name' => ['required', 'unique:permissions,name,' . $permission->id],
        ];
    }
}
