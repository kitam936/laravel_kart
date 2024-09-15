<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class StoreChMaintRequest extends FormRequest
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
            'maint_date' => ['required'],
            'ch_maint_category_id' => ['required'],
            'maint_info' => ['required','max:100']

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
