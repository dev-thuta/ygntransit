<?php

namespace App\Models;

use App\Models\Township;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class BusStop extends Model
{
    use HasFactory;

    public function township()
    {
        return $this->belongsTo(Township::class);
    }

   public function busroutes()
    {
        return $this->hasMany(BusRoute::class);
    }

    public function buslines()
    {
        return $this->hasManyThrough(BusLine::class, BusRoute::class, 'bus_stop_id', 'id', 'id', 'bus_line_id');
    }
}
