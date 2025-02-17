<?php

namespace App\Listeners;

use App\Events\PaymentNoteIsSaved;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Queue\InteractsWithQueue;
use App\Models\PaymentNoteAmountCollector;

class BuildPaymentNoteAmountCollectorFromLiveStreamActivity
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

        //initiate $value
        $value = 0;

        $live_stream_activities = $payment_note->live_stream_activities;
        if(count($live_stream_activities)){
            foreach($live_stream_activities as $live_stream_activity){
                $value += $live_stream_activity->live_stream_activity_cost->total_cost;
            }
        }

        PaymentNoteAmountCollector::updateOrCreate(
            [
                'payment_note_id'=>$payment_note->id,
                'name'=>'live-stream-cost',
            ],
            [
                'value'=>$value
            ]
        );
    }
}
