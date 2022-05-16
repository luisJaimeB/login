<?php

namespace App\Rules;

class ProductRules implements Rules
{
    public static function toArray(): array
    {
        return [
            'name' => ['required', 'max:50'],
            'description' => ['required','min:50','max:340'],
            'price' => ['required'],
            'quantity' => ['required'],
            'image' => ['image', 'mimes:jpeg,png', 'max:3064'],
        ];
    }
}
