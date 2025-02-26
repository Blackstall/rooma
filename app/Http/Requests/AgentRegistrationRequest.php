<?php
// app/Http/Requests/Auth/AgentRegistrationRequest.php

namespace App\Http\Requests\Auth;

use Illuminate\Foundation\Http\FormRequest;

class AgentRegistrationRequest extends FormRequest
{
    public function authorize()
    {
        return true;
    }

    public function rules()
    {
        return [
            'license_number' => 'required|string|max:255|unique:agents',
            'company' => 'required|string|max:255',
            'phone' => 'required|string|max:20',
            'bio' => 'nullable|string|max:1000',
        ];
    }
}