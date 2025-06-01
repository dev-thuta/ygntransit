<?php

namespace App\Models;

use App\Models\BusRoute;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class BusLine extends Model
{
    use HasFactory;

    public function busroutes()
    {
        return $this->hasMany(BusRoute::class, 'bus_line_id');
    }

    public function busstops()
    {
        return $this->hasManyThrough(
            BusStop::class,
            BusRoute::class,
            'bus_line_id',
            'id',
            'id',
            'bus_stop_id'
        );
    }
}
