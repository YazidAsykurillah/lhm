<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

use Illuminate\Database\Eloquent\Relations\HasMany;

class UmrahBatch extends Model
{
    protected $table='umrah_batches';

    protected $guarder=['id'];

    public function umrah_manifests():HasMany
    {
        return $this->hasMany(UmrahManifest::class);
    }

    
}
