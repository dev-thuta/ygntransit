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
}
