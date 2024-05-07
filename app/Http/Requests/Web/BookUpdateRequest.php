<?php

namespace App\Http\Requests\Web;

use Illuminate\Foundation\Http\FormRequest;

class BookUpdateRequest extends FormRequest
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
            'isbn' => 'required|string|max:30|unique:books,isbn,' . $this->book->id,
            'title' => 'required|string|max:255',
            'author' => 'required|string|max:255',
            'publisher' => 'required|string|max:255',
            'year_published' => 'required|numeric|digits:4',
            'description' => 'nullable|string',
            'cover' => 'nullable|image|max:512',
            'total_owned' => 'required|numeric|min:0',
        ];
    }
}
