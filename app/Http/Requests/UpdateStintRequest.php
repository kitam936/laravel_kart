<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class UpdateStintRequest extends FormRequest
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
            'event_name' => ['required', 'max:50'],
            'information' => ['required', 'max:200'],
            'area_id' => ['required'],
            'place' => ['required', 'max:50'],
            'main_fee' => ['required', 'numeric', 'between:0,10000'],
            'sub_fee' => ['required', 'numeric', 'between:0,10000'],
            'event_date' => ['required', 'date'],
            'start_time' => ['required'],
            'end_time' => ['required', 'after:start_time'],
            'capacity' => ['required', 'numeric', 'between:1,200'],
            'is_visible' => ['required', 'boolean']
        ];
    }
}
