<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class StoreRoutineRequest extends FormRequest
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
            'name' => 'required|string|max:255',
            'description' => 'required|string',
            'start_date' => 'required|date|after_or_equal:today', // Assuming routines cannot start in the past
            'end_date' => 'nullable|date|after_or_equal:start_date', // End date must be after or equal to start date
            'event_id' => 'required|exists:events,id', // Assuming event_id must exist in the events table
            'user_id' => 'required|exists:users,id', // Assuming user_id must exist in the users table
        ];
    }
}
