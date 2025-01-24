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
