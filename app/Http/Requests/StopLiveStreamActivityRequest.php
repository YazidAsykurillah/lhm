<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class StopLiveStreamActivityRequest extends FormRequest
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
            'live_stream_activity_id'=>[
                'required',
                'integer',
                'exists:live_stream_activities,id'
            ],
            'sales_turn_over'=>[
                'required'
            ]
        ];

        return $rules;
    }
}
