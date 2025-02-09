<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class StoreLiveStreamActivityRequest extends FormRequest
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
            'user_id'=>[
                'required',
                'integer',
                'exists:users,id'
            ],
            'platform_account_id'=>[
                'required',
                'integer',
                'exists:platform_accounts,id'
            ],
            'live_stream_date'=>[
                'required',
                'date'
            ],
            'started_time'=>[
                'required',
                'date_format:Y-m-d H:i'
            ],
            'stoped_time'=>[
                'required',
                'date_format:Y-m-d H:i',
                'after:started_time'
            ],
            'sales_turn_over'=>[
                'required'
            ]
            
        ];

        return $rules;
    }
}
