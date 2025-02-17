<?php

namespace App\Listeners;

use App\Events\PaymentNoteIsSaved;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Queue\InteractsWithQueue;
use App\Models\LiveStreamActivity;
use Carbon\Carbon;

class UpdatePaymentNoteAmountFromLiveStreamActivity
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
        
        
    }
}
