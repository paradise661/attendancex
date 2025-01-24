<?php

use Carbon\Carbon;

if (!function_exists('calculateWorkedHours')) {
    function calculateWorkedHours($checkinTime, $checkoutTime)
    {
        $checkin = Carbon::parse($checkinTime);
        $checkout = Carbon::parse($checkoutTime);

        $workedMinutes = $checkin->diffInMinutes($checkout);

        return $workedMinutes / 60;
    }
}

if (!function_exists('formatWorkedHours')) {
    function formatWorkedHours($workedHours)
    {
        $workedHours = $workedHours ?? 0;

        if ($workedHours < 1) {
            $workedMinutes = round($workedHours * 60);
            return "{$workedMinutes}m";
        } else {
            $hours = floor($workedHours);
            $minutes = round(($workedHours - $hours) * 60);
            return "{$hours}h" . ($minutes > 0 ? " {$minutes}m" : "");
        }
    }
}

if (!function_exists('getDistance')) {
    function getDistance($latitude1, $longitude1, $latitude2, $longitude2)
    {
        $latitude1 = (float) $latitude1;
        $latitude2 = (float) $latitude2;
        $longitude1 = (float) $longitude1;
        $longitude2 = (float) $longitude2;
        $earth_radius = 6371;

        $dLat = deg2rad((float)$latitude2 - (float)$latitude1);
        $dLon = deg2rad((float)$longitude2 - (float)$longitude1);

        $a = sin($dLat / 2) * sin($dLat / 2) + cos(deg2rad($latitude1)) * cos(deg2rad($latitude2)) * sin($dLon / 2) * sin($dLon / 2);
        $c = 2 * asin(sqrt($a));
        $d = $earth_radius * $c;

        return $d;
    }
}
