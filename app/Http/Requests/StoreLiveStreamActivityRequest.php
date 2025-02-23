<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

use Illuminate\Validation\Rule;
use Carbon\Carbon;
use App\Models\LiveStreamActivity;

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
                'exists:platform_accounts,id',
                function($attribute, $value, $fail){
                    //check if the user has already ongoing livestreamactivity for the platform_account_id
                    $oGLivestream = LiveStreamActivity::where('user_id','=', $this->input('user_id'))
                                    ->where('live_stream_date', '=', $this->input('live_stream_date'))
                                    ->where('platform_account_id','=', $value)
                                    ->whereNull('stoped_time')
                                    ->first();
                    if($oGLivestream){
                        $fail('The live streamer already has on going activity for the selected platform account on selected date, please select another platform account');
                    }
                }
            ],
            'live_stream_date'=>[
                'required',
                'date'
            ],
            'started_time'=>[
                'required',
                'date_format:Y-m-d H:i',
                'after_or_equal:'.Carbon::parse($this->input('live_stream_date'))->format('Y-m-d H:i')
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
