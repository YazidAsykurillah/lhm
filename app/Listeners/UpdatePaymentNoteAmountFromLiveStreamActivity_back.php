<?php

namespace App\Listeners;

use App\Events\PaymentNoteIsSaved;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Queue\InteractsWithQueue;
use App\Models\LiveStreamActivity;
use Carbon\Carbon;

class UpdatePaymentNoteAmountFromLiveStreamActivity_back
{
    /**
     * Create the event listener.
     */
    public function __construct()
    {
        //
    }

    /**
     * Handle the event.
     */
    public function handle(PaymentNoteIsSaved $event): void
    {

        $payment_note = $event->payment_note;

        $payment_note_id = $payment_note->id;
        $start_date = Carbon::parse($payment_note->start_date)->format('Y-m-d');
        $end_date = Carbon::parse($payment_note->end_date)->format('Y-m-d');

        //select related live stream activities
        $live_stream_activities = LiveStreamActivity::query()
                                    ->whereHas('live_stream_activity_approval', function($query){
                                        $query->where('is_approved','=', TRUE);
                                    })
                                    ->where('user_id','=', $payment_note->user_id)
                                    ->where('stoped_time','!=', NULL)
                                    ->where('live_stream_date','>=', $start_date)
                                    ->where('live_stream_date','<=', $end_date)
                                    ->get();
        
        if(count($live_stream_activities)){
            //initiate amount for payment_note
            $amount = 0;
            /*$live_stream_activities->toQuery()->update([
                'payment_note_id' => $payment_note_id,
            ]);*/

            foreach($live_stream_activities as $live_stream_activity){
                $live_stream_activity->payment_note_id = $payment_note_id;
                $live_stream_activity->save();
                $amount+=$live_stream_activity->live_stream_activity_cost->total_cost;
            }

            //update amount of payment_note
            $payment_note->amount = $amount;
            $payment_note->save();
        }

        
        
        
    }
}
