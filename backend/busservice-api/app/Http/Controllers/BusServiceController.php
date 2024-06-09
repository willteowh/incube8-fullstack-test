<?php

namespace App\Http\Controllers;

use App\Models\Bus;
use App\Models\BusSchedule;
use App\Models\BusStop;
use Illuminate\Http\Request;

class BusServiceController extends Controller
{
    /**
     * List all bus stops ordered by location.
     *
     * @return \Illuminate\Http\JsonResponse
     */
    public function list_bus_stop()
    {
        $bus_stops = BusStop::orderBy('bus_stop_location_value')->get();
        return response()->json($bus_stops);
    }
    /**
     * View the bus schedule of a particular bus stop.
     *
     * @param int $bus_stop_id
     * @return \Illuminate\Http\JsonResponse
     */
    public function view_bus_stop($bus_stop_id)
    {
        $bus_stop = BusStop::with(['busSchedules.bus'])->find($bus_stop_id);

        if (!$bus_stop) {
            return response()->json(['error' => 'Bus stop not found'], 404);
        }

        $schedule = $bus_stop->busSchedules->map(function ($busSchedule) {
            return [
                'bus_name' => $busSchedule->bus->bus_name,
                'bus_schedule_day' => $busSchedule->bus_schedule_day,
                'bus_schedule_time' => $busSchedule->bus_schedule_time,
            ];
        })->sortBy(['bus_schedule_day', 'bus_schedule_time'])->values();

        return response()->json([
            'bus_stop' => $bus_stop,
            'schedule' => $schedule,
        ]);
    }
}
