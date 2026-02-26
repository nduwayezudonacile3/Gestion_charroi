<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Support\Facades\Auth;

class UpdateEmployeRequest extends FormRequest
{
    public function authorize(): bool
    {
        // Vérifie que l'utilisateur est connecté ET qu'il est admin
        $user = Auth::user();
        return $user && $user->role === 'admin';
    }

    public function rules(): array
    {
        return [
            'nom' => 'required|string|max:255',
            'prenom' => 'required|string|max:255',
            'telephone' => 'required|string|max:20',
            'residence' => 'required|string|max:255',
            'fonction' => 'required|string|max:255',
            'description' => 'nullable|string',
        ];
    }
}