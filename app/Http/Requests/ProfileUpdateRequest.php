<?php

namespace App\Http\Requests;

use Illuminate\Support\Facades\Auth;
use Illuminate\Foundation\Http\FormRequest;

class ProfileUpdateRequest extends FormRequest
{
    /**
     * Determine if the user is authorized to make this request.
     */
    public function authorize(): bool
    {
        return true;
    }

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array<string, \Illuminate\Contracts\Validation\ValidationRule|array<mixed>|string>
     */
    public function rules(): array
    {
        $user = Auth::user();
    
        return [
            'name' => 'nullable|string|max:255',
            'username' => 'nullable|string|unique:users,username,' . $user->id, 
            'email' => 'nullable|email|unique:users,email,' . $user->id, 
            'avatar' => 'nullable|image|mimes:jpeg,png,jpg,svg|max:2048',
            'old_password' => 'required|string|min:6',
            'new_password' => 'nullable|string|min:6|', 
        ];
    }
    
}
