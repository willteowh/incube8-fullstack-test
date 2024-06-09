<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class BusStop extends Model
{
    use HasFactory;
    protected $table = 'bus_stops';
    protected $primaryKey = 'bus_stop_id';
    protected $fillable = ['bus_stop_name', 'bus_stop_location_value'];

    // Relationship with BusSchedule
    public function busSchedules()
    {
        return $this->hasMany(BusSchedule::class, 'bus_stop_id');
    }
}
