<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class PaymentNote extends Model
{
    protected $table = 'payment_notes';

    protected $guarded = ['id'];


    public function user():BelongsTo
    {
        return $this->belongsTo(User::class);
    }
    
}
