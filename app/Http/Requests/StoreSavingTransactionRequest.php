<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class StoreSavingTransactionRequest extends FormRequest
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
        //return[];
        $rules = [
            'transaction_source'=>'required',
            'sender_name'=>'required',
            'bank_account_id'=>'required|exists:bank_accounts,id',
            'amount'=>'required',
            'transaction_date'=>'required',
            'transaction_receipt' => 'required|file|max:2000|mimes:jpg,png,jpeg',
            'umrah_manifest_id'=>'required|integer|exists:umrah_manifests,id'
        ];
        return $rules;
    }
}
