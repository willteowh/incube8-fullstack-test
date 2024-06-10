<?php

namespace App\Http\Controllers;

use App\Models\BusStop;
use App\Http\Requests\FindNearestBusStopRequest;
use App\Services\DistanceService;

class BusServiceController extends Controller
{
    protected $distanceService;

    /**
     * Create a new controller instance.
     *
     * @param  \App\Services\DistanceService  $distanceService
     * @return void
     */
    public function __construct(DistanceService $distanceService)
    {
        $this->distanceService = $distanceService;
    }

    /**
     * Find nearest bus stop based on lat and lon
     *
     * @return \Illuminate\Http\JsonResponse
     */
    public function findNearestBusStop(FindNearestBusStopRequest  $request)
    {
        $lat = $request->input('lat');
        $lon = $request->input('lon');

        // Fetch all bus stops
        $bus_stops = BusStop::all();

        // Calculate distances
        $bus_stops = $bus_stops->map(function ($bus_stop) use ($lat, $lon) {
            $distance = $this->distanceService->haversineGreatCircleDistance($lat, $lon, $bus_stop->bus_stop_location_latitude, $bus_stop->bus_stop_location_longitude);
            $bus_stop->distance = $distance;
            return $bus_stop;
        });

        // Sort bus stops by distance
        $sorted_bus_stops = $bus_stops->sortBy('distance')->values();

        return response()->json($sorted_bus_stops);
    }

    /**
     * View the bus timing of a bus stop
     *
     * @param int $bus_stop_id
     * @return \Illuminate\Http\JsonResponse
     */
    public function viewBusTiming($bus_stop_id)
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
