<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\HasMany;

class BankAccount extends Model
{
    protected $table = 'bank_accounts';

    protected $guarded = ['id'];


    public function saving_transactions():HasMany
    {
        return $this->hasMany(BankAccount::class);
    }
}
