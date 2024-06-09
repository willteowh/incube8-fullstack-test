<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Bus extends Model
{
    use HasFactory;

    protected $table = 'buses';
    protected $primaryKey = 'bus_id';
    protected $fillable = ['bus_name'];

    // Relationship with BusSchedule
    public function busSchedules()
    {
        return $this->hasMany(BusSchedule::class, 'bus_id');
    }
}
