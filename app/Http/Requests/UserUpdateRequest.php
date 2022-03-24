<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class UserUpdateRequest extends FormRequest
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
            'last_name' => 'required|min:3|max:30',
            'type_document_id' => 'required|int|exists:document_types,id',
            'identification_number' => 'required|min:3|max:20',
            'mobile_number' => 'required|min:3|max:15',
            'address' =>'required|min:3|max:50',
            'postal_code' => 'required|min:3|max:10',
        ];
    }
}
