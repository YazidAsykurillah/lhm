<?php

namespace App\Listeners;

use App\Events\LiveStreamActivityIsSaved;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Queue\InteractsWithQueue;
use App\Models\LiveStreamActivityCost;
use Carbon\Carbon;

class UpdateLiveStreamActivityCost
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

        $live_stream_activity_id = $live_stream_activity->id;
        $streamer_rate = $live_stream_activity->streamer->rate_per_hour;

        $started_time = Carbon::parse($live_stream_activity->started_time);
        $stoped_time = Carbon::parse($live_stream_activity->stoped_time);

        $total_hour = round($started_time->diffInHours($stoped_time),1);
        $total_cost = $total_hour*$streamer_rate;
        
        LiveStreamActivityCost::updateOrCreate(
            [
                'live_stream_activity_id'=>$live_stream_activity_id,
            ],
            [
                'streamer_rate'=>$streamer_rate,
                'total_hour'=>$total_hour,
                'total_cost'=>$total_cost,
            ]
        );


    }
}
