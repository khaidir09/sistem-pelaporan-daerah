<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class IkkMaster extends Model
{
    protected $guarded = [];

    public function matter()
    {
        return $this->belongsTo(Matter::class, 'matter_id');
    }

    public function ikkReports()
    {
        return $this->hasMany(IkkReport::class, 'ikk_master_id');
    }
}
