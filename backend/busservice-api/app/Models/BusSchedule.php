<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class BusSchedule extends Model
{
    use HasFactory;

    protected $table = 'bus_schedules';
    protected $primaryKey = 'bus_schedule_id';
    protected $fillable = ['bus_id', 'bus_stop_id', 'bus_schedule_day', 'bus_schedule_time'];

    // Relationship with Bus
    public function bus()
    {
        return $this->belongsTo(Bus::class, 'bus_id');
    }

    // Relationship with BusStop
    public function busStop()
    {
        return $this->belongsTo(BusStop::class, 'bus_stop_id');
    }
}
