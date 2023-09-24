<?php

namespace App\Http\Requests;

use App\Rules\ValidSpace;
use App\Rules\CheckRequestConflicts;
use App\Rules\OneUserRequest;
use App\Rules\ValidDays;
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
            // 'user_id' => ['required', 'exists:users,id' , new OneUserRequest()],
            'start_date' => 'required|date|after:today',
            'end_date' => 'required|date|after_or_equal:start_date',
            'start_time' => 'required',
            'end_time' => 'required|after:start_time',
            'start_time' => [
                new ValidSpace(),
                new CheckRequestConflicts(),
            ],
            'days' => [
                'required',
                'array',
                new ValidDays(),
                // new OneUserRequest()
            ],
            'status' => 'nullable|in:pending,accepted,denied',
            'message' => 'nullable|string',
        ];
    }
}
