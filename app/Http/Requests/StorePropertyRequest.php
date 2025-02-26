<?php

// app/Http/Requests/StorePropertyRequest.php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class StorePropertyRequest extends FormRequest
{
    public function authorize()
    {
        return auth()->user()->isApprovedAgent();
    }

    public function rules()
    {
        return [
            'title' => 'required|string|max:255',
            'type' => 'required|in:sale,rent',
            'price' => 'required|numeric|min:0',
            'is_price_negotiable' => 'sometimes|boolean',
            'description' => 'required|string|min:50',
            'amenities' => 'sometimes|array',
            'amenities.*' => 'string|max:255',
            'bedrooms' => 'required|integer|min:1',
            'bathrooms' => 'required|integer|min:1',
            'furnished' => 'sometimes|boolean',
        ];
    }
}

// app/Http/Requests/UpdatePropertyRequest.php
class UpdatePropertyRequest extends StorePropertyRequest
{
    public function rules()
    {
        return array_merge(parent::rules(), [
            'featured' => 'sometimes|boolean',
        ]);
    }
}