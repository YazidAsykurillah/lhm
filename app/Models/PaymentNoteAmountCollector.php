<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class PaymentNoteAmountCollector extends Model
{
    protected $table = 'payment_note_amount_collectors';
    protected $guarded=['id'];

    public function payment_note():BelongsTo
    {
        return $this->belongsTo(PaymentNote::class, 'payment_note_id');
    }
}
