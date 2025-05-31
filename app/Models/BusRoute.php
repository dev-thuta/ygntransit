<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class BusRoute extends Model
{
    use HasFactory;

    public function busline()
    {
        return $this->belongsTo(BusLine::class, 'bus_line_id');
    }

    public function busstop()
    {
        return $this->belongsTo(BusStop::class, 'bus_stop_id');
    }
}
