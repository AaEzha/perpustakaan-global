<?php

namespace App\Http\Requests\Web;

use Illuminate\Foundation\Http\FormRequest;

class UserUpdateRequest extends FormRequest
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
        return [
            'name' => 'required|string|max:200',
            'email' => 'required|email|max:200|unique:users,email,' . $this->user->id,
            'title' => 'required|string|in:Admin,Anggota',
        ];
    }

    public function attributes()
    {
        return [
            'title' => 'role'
        ];
    }
}
