<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class NotesUpdateRequest extends FormRequest
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
     * @return array<string, \Illuminate\Contracts\Validation\Rule|array|string>
     */
    public function rules(): array
    {
        return [
            'id' => 'required|numeric',
            'title' => 'required|string',
            'text' => 'required|string',
            'color' => 'required|string',
            'background_color' => 'required|string',
            'categorie_id' => 'nullable',
        ];
    }
}
