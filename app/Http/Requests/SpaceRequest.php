<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class SpaceRequest extends FormRequest
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
     * @return array<string, \Illuminate\Contracts\Validation\ValidationRule|array|string>
     */
    public function rules(): array
    {
        return [
            'branch_id' => 'required|int|exists:branches,id',
            'type' => 'string|in:room, free_space|nullable',
            'name' => 'required|string',
            'capacity' => 'required|integer|min:1',
            'price' => 'nullable|integer',
            'is_available' => 'nullable|boolean',
            'assets' => 'nullable|string'
        ];
    }
}
