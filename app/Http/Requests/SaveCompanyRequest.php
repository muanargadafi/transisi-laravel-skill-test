<?php

namespace App\Http\Requests;

use Illuminate\Contracts\Validation\ValidationRule;
use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Validation\Rule;

class SaveCompanyRequest extends FormRequest
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
     * @return array<string, ValidationRule|array<mixed>|string>
     */
    public function rules(): array
    {
        return [
            'name' => [
                'required',
                'string',
                'max:255',
            ],
            'email' => [
                'required',
                'email',
                'max:255',
                Rule::unique('companies')->ignore($this->route('company')?->id ?? 'NULL'),
            ],
            'website' => [
                'required',
                'url',
                'max:255',
            ],
            'temp_logo' => [
                'nullable',
                'string',
            ],
            'logo' => [
                'required_without:temp_logo',
                'image',
                'mimes:png',
                'dimensions:min_width=100,min_height=100',
                'max:2048',
            ],
        ];
    }
}
