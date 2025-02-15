<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

use App\Models\LiveStreamActivity;

class StartLiveStreamActivityRequest extends FormRequest
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
            'platform_account_id'=>[
                'required',
                'integer',
                'exists:platform_accounts,id',
                function($attribute, $value, $fail){
                    //check if the user has already ongoing livestreamactivity for the platform_account_id
                    $oGLivestream = LiveStreamActivity::where('user_id','=', \Auth::user()->id)
                                    ->where('platform_account_id','=', $value)
                                    ->whereNull('stoped_time')
                                    ->first();
                    if($oGLivestream){
                        $fail('You have already on going activity for the selected platform account, please select another one, or stop the current activity');
                    }
                }
            ],
        ];

        return $rules;
    }
}
