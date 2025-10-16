<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class ReportHistory extends Model
{
    protected $guarded = [];

    public function ikkReport()
    {
        return $this->belongsTo(IkkReport::class);
    }

    public function user()
    {
        return $this->belongsTo(User::class);
    }
}
