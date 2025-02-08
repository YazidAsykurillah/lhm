<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

use Illuminate\Database\Eloquent\Relations\BelongsTo;

class PlatformAccount extends Model
{
    protected $table = 'platform_accounts';

    protected $guarded = ['id'];


    public function platform():BelongsTo
    {
        return $this->belongsTo(Platform::class);
    }
    
}
