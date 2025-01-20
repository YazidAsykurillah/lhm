<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\HasMany;

class SavingTransaction extends Model
{
    protected $table = 'saving_transactions';
    protected $guarded=['id'];


    //Bank penerima transfer
    public function bank_account():BelongsTo
    {
        return $this->belongsTo(BankAccount::class);
    }

    public function umrah_manifest():BelongsTo
    {
        return $this->belongsTo(UmrahManifest::class);
    }
}
