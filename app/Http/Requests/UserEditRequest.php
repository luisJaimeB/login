<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class UserEditRequest extends FormRequest
{
    public function authorize(): bool
    {
        return true;
    }


    public function rules(): array
    {
        $user = $this->route('user');
        return [
            'name' => 'required',
            'username' => ['required', 'min:3', 'unique:users,username,' . $user->id],
            'email' => ['required', 'unique:users,email,' . request()->route('user')->id],
            'password' => 'sometimes'
        ];
    }
}
