<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Agency extends Model
{
    protected $guarded = [];

    public function matters()
    {
        return $this->belongsToMany(Matter::class, 'agency_matter', 'agency_id', 'matter_id');
    }
}
