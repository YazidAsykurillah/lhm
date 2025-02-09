<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class LiveStreamActivityCost extends Model
{
    protected $table = 'live_stream_activity_costs';

    protected $guarded = ['id'];

    public function live_steram_activity():BelongsTo
    {
        return $this->belongsTo(LiveStreamActivity::class);
    }
}
