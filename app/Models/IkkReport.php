<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class IkkReport extends Model
{
    protected $guarded = [];

    public function ikkMaster()
    {
        return $this->belongsTo(IkkMaster::class, 'ikk_master_id');
    }
}
