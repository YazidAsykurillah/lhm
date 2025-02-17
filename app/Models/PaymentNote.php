<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\HasMany;

class PaymentNote extends Model
{
    protected $table = 'payment_notes';

    protected $guarded = ['id'];


    public function user():BelongsTo
    {
        return $this->belongsTo(User::class);
    }
    
    public function live_stream_activities():HasMany
    {
        return $this->hasMany(LiveStreamActivity::class);
    }


    public function payment_note_amount_collectors():HasMany
    {
        return $this->hasMany(PaymentNoteAmountCollector::class);
    }

    
}
