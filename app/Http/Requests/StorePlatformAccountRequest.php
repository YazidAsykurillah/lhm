<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Validation\Rule;

class StorePlatformAccountRequest extends FormRequest
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

        $rules = [
            'platform_id'=>'required|integer|exists:platforms,id',
            
            'name'=>[
                'required',
                Rule::unique('platform_accounts','name')->where('platform_id', $this->input('platform_id'))
            ]
        ];

        return $rules;
    }
}
