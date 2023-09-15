<?php

namespace App\Http\Requests;

use App\Rules\ValidSpace;
use App\Rules\CheckRequestConflicts;
use Illuminate\Foundation\Http\FormRequest;

class CustomBookingRequest extends FormRequest
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
            'space_id' => ['required','integer','exists:spaces,id'],
            'start_date' => 'required|date',
            'end_date' => 'required|date|after_or_equal:start_date',
            'start_time' => 'required|date_format:H:i',
            'end_time' => 'nullable|date_format:H:i|after:start_time',
            'start_time' =>[ new ValidSpace() , new CheckRequestConflicts()],
            'days' => 'required|array',
            'status' => 'nullable|in:pending,accepted,denied',
            'message' => 'nullable|string',
        ];
    }
}
