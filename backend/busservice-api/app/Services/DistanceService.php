<?php

namespace App\Services;

class DistanceService
{
    /**
     * Calculate the great-circle distance between two points
     * using the Haversine formula.
     *
     * @param  float  $latitudeFrom
     * @param  float  $longitudeFrom
     * @param  float  $latitudeTo
     * @param  float  $longitudeTo
     * @param  int    $earthRadius
     * @return float
     */
    public function haversineGreatCircleDistance($latitudeFrom, $longitudeFrom, $latitudeTo, $longitudeTo, $earthRadius = 6371)
    {
        // Convert from degrees to radians
        $latFrom = deg2rad($latitudeFrom);
        $lonFrom = deg2rad($longitudeFrom);
        $latTo = deg2rad($latitudeTo);
        $lonTo = deg2rad($longitudeTo);

        $latDelta = $latTo - $latFrom;
        $lonDelta = $lonTo - $lonFrom;

        $angle = 2 * asin(sqrt(pow(sin($latDelta / 2), 2) +
            cos($latFrom) * cos($latTo) * pow(sin($lonDelta / 2), 2)));

        return $angle * $earthRadius;
    }
}
