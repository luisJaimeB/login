<?php

namespace App\Actions;


use Illuminate\Support\Facades\Auth;

class UpdateUserAction
{
    public static function update(array $input)
    {
        /** @var \App\Models\User $user */
        $user = Auth::user();
        $user->identification_number = $input['identification_number'];
        $user->document_type_id = $input['type_document_id'];
        $user->last_name = $input['last_name'];
        $user->mobile_number = $input['mobile_number'];
        $user->address = $input['address'];
        $user->postal_code = $input['postal_code'];

        if ($user->isDirty()) {
            $user->save();
        }
    }
}
