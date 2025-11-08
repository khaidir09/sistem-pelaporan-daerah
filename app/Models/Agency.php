<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Agency extends Model
{
    protected $guarded = [];

    public function matters()
    {
        return $this->belongsToMany(IkkMaster::class, 'agency_ikk_master', 'agency_id', 'ikk_master_id');
    }
}
