<?php

namespace App\Listeners;

use App\Events\LiveStreamActivityIsSaved;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Queue\InteractsWithQueue;
use App\Models\LiveStreamActivityApproval;

class UpdateLiveStreamActivityApproval
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
    public function handle(LiveStreamActivityIsSaved $event): void
    {
        $live_stream_activity = $event->live_stream_activity;
        $live_stream_activity_approval = LiveStreamActivityApproval::updateOrCreate(
            [
                'live_stream_activity_id'=>$live_stream_activity->id
            ],
            [
                'live_stream_activity_id'=>$live_stream_activity->id,
                'is_approved'=>FALSE
            ],
        );
    }
}
