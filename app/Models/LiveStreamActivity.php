<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\HasOne;

class LiveStreamActivity extends Model
{
    protected $table = 'live_stream_activities';

    protected $guarded = ['id'];

    public function streamer():BelongsTo
    {
        //the user that own the live stream activity
        return $this->belongsTo(User::class, 'user_id');
    }

    public function platform_account():BelongsTo
    {
        return $this->belongsTo(PlatformAccount::class, 'platform_account_id', 'id');
    }

    public function live_stream_activity_approval():HasOne
    {
        return $this->hasOne(LiveStreamActivityApproval::class);
    }

    public function live_stream_activity_cost():HasOne
    {
        return $this->hasOne(LiveStreamActivityCost::class);
    }

}
