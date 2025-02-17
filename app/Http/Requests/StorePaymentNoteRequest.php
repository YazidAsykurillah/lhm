<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Validation\Rule;

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
                /*Rule::unique('payment_notes')->where(function($query){
                    $query->where('user_id',$this->input('user_id'))
                        ->where('start_date', $this->input('start_date'))
                        ->where('end_date', $this->input('end_date'));
                }),*/
            ],
            'start_date'=>[
                'required'
            ],
            'end_date'=>[
                'required',
                'after:start_date',
                
            ],
            'title'=>[
                'required',
                'min:3',
                'max:225'
            ]
        ];

        return $rules;
    }


    public function messages()
    {
        return [
            //'user_id.unique' => 'Submitted start date and end date is exists for Selected user.',
        ];
    }
}
