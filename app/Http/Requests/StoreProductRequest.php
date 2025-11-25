<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class StoreProductRequest extends FormRequest
{
    public function rules()
    {
        return [
            'name'  => 'required|string|min:2',
            'price' => 'required|numeric|min:0.01',
        ];
    }
    public function messages()
    {
        return [
            'name.required' => 'Le nom est obligatoire.',
            'name.min'      => 'Le nom doit contenir au moins 2 caractères.',

            'price.required' => 'Le prix est obligatoire.',
            'price.numeric'  => 'Le prix doit être un nombre.',
            'price.min'      => 'Le prix doit être positif.',

        ];
    }
}
