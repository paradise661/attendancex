<?php

use Carbon\Carbon;

function calculateWorkedHours($checkinTime, $checkoutTime)
{
    $checkin = Carbon::parse($checkinTime);
    $checkout = Carbon::parse($checkoutTime);

    $workedMinutes = $checkout->diffInMinutes($checkin);

    return abs($workedMinutes) / 60;
}
