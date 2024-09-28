<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class StoreStintRequest extends FormRequest
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
            'stint_info' => ['max:200'],
            'user_id' => ['required'],
            'kart_id' => ['required'],
            'tire_id' => ['required'],
            'engine_id' => ['required'],
            'cir_id' => ['required'],
            'start_date' => ['required', 'date'],
            'start_time' => ['required'],
            'laps' => ['required', 'numeric', 'between:1,200'],
            'upper_of_time' => ['required', 'numeric'],
            'bottom_of_time' => ['required', 'numeric'],
            'dry/wet' => ['required'],
            'image'=>['image|mimes:jpg,jpeg,png|max:2048'],
            'files.*.image' => ['required|image|mimes:jpg,jpeg,png|max:2048'],

        ];
    }

    public function messages()
    {
        return [
        'image' => '指定されたファイルが画像ではありません。',
        'mines' => '指定された拡張子（jpg/jpeg/png）ではありません。',
        'max' => 'ファイルサイズは2MB以内にしてください。',
    ];
    }
}
