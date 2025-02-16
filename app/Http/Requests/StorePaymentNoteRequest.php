<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class StorePaymentNoteRequest extends FormRequest
{
    /**
     * Determine if the user is authorized to make this request.
     */
    public function authorize(): bool
    {
        return $this->user()->can('manage-payment-note');
    }

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array<string, \Illuminate\Contracts\Validation\ValidationRule|array<mixed>|string>
     */
    public function rules(): array
    {
        $rules = [
            'user_id'=>[
                'required',
                'integer',
                'exists:users,id',
            ],
            'start_date'=>[
                'required'
            ],
            'end_date'=>[
                'required',
                'after:start_date'
            ],
            'title'=>[
                'required',
                'min:3',
                'max:225'
            ]
        ];

        return $rules;
    }
}
