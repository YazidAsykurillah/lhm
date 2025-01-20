<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;


class CompleteMyProfileRequest extends FormRequest
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
        $rules= [
            'user_id'=>'required|integer|exists:users,id',
            'name'=>'required|min:3',
            'address'=>'required',
            'gender'=>'required',
            //'photo_file' => 'required|file|max:2000|mimes:jpg,png,jpeg',
            'photo_file' => [
                'required_if:old_photo_file,null',
                'file',
                'max:2000',
                'mimes:jpg,png,jpeg'

            ],
            'ktp_number'=>'required',
            'ktp_file' => [
                'required_if:old_ktp_file,null',
                'file',
                'max:2000',
                'mimes:jpg,png,jpeg'

            ],
            'passport_number'=>'required',
            'passport_file' => [
                'required_if:old_passport_file,null',
                'file',
                'max:2000',
                'mimes:jpg,png,jpeg'

            ],
            

        ];
        return $rules;
    }
}
