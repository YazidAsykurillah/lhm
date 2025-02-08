<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\HasMany;

class Platform extends Model
{
    protected $table = 'platforms';

    protected $guarded = ['id'];


    public function platform_accounts():HasMany
    {
        return $this->hasMany(PlatformAccount::class);
    }
}
