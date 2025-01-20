<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\HasMany;

class UmrahManifest extends Model
{
    protected $table = 'umrah_manifests';

    protected $fillable=[
        'umrah_batch_id',
        'user_id'
    ];


    public function umrah_batch(): BelongsTo
    {
        return $this->belongsTo(UmrahBatch::class);
    }

    public function user(): BelongsTo
    {
        return $this->belongsTo(User::class);
    }

    public function participants(): HasMany
    {
        return $this->HasMany(Participant::class);
    }

    public function saving_transactions():HasMany
    {
        return $this->hasMany(SavingTransaction::class);
    }
}
