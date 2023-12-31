<?php

namespace App\Http\Requests;

use App\Rules\ValidBranch;
use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Validation\Rule;


class BranchRequest extends FormRequest
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
            'name' => ['required' , 'max:255'],
            'work_days' => ['required', 'array'],
            'work_days.*' => ['string'],
            'start_time' => ['required'],
            'end_time' => ['required'],
            'location' => ['required' , 'max:255'],
        ];
    }
}
