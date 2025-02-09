<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class LiveStreamActivityApproval extends Model
{
    protected $table = 'live_stream_activity_approvals';

    protected $guarded = ['id'];

    public function approver():BelongsTo
    {
        return $this->belongsTo(User::class, 'approver_id');
    }
}
