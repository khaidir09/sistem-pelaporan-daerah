<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Matter extends Model
{
    protected $guarded = [];

    public function outcomes()
    {
        return $this->hasMany(Outcome::class);
    }

    public function category()
    {
        return $this->belongsTo(MatterCategory::class);
    }

    public function ikkMasters()
    {
        return $this->hasMany(IkkMaster::class);
    }

    public function agencies()
    {
        return $this->belongsToMany(Agency::class, 'agency_matter', 'matter_id', 'agency_id');
    }
}
