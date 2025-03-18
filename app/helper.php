<?php

use App\Models\Notification;
use App\Models\Setting;
use App\Models\User;
use Carbon\Carbon;
use Carbon\CarbonPeriod;
use Illuminate\Support\Facades\Http;


if (!function_exists('calculateWorkedHours')) {
    function calculateWorkedHours($checkinTime, $checkoutTime)
    {
        try {
            $checkin = Carbon::parse($checkinTime);
            $checkout = Carbon::parse($checkoutTime);

            $workedMinutes = $checkin->diffInMinutes($checkout);

            $workedHours = $workedMinutes / 60;

            return number_format($workedHours, 2);
        } catch (Exception $e) {
            return 0;
        }
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

if (!function_exists('sendPushNotification')) {
    function sendPushNotification($to, $title, $body)
    {
        $response = Http::withHeaders([
            'Accept' => 'application/json',
            'Content-Type' => 'application/json',
            'Accept-encoding' => 'gzip, deflate',
        ])->post('https://exp.host/--/api/v2/push/send', [
            'to' => $to,
            'title' => $title,
            'body' => $body,
        ]);

        if ($response->successful()) {
            return 1;
        }

        return 0;
    }
}

if (!function_exists('formatMinutesToHours')) {
    function formatMinutesToHours($totalMmin)
    {
        // Ensure the input is a valid number and fallback to 0 if it's not.
        $totalMmin = $totalMmin ?? 0;

        // Calculate hours and remaining minutes
        $hours = floor($totalMmin / 60);
        $minutes = $totalMmin % 60;

        // Return the formatted string
        return "{$hours}h" . ($minutes > 0 ? " {$minutes}m" : "");
    }
}

if (!function_exists('sendNotificationToAdmin')) {
    function sendNotificationToAdmin($userID, $messsage, $type, $entity_id)
    {
        Notification::create([
            'user_id' => $userID ?? NULL,
            'message' => $messsage ?? NULL,
            'type' => $type ?? NULL,
            'entity_id' => $entity_id ?? NULL
        ]);
    }
}

if (!function_exists('getNotification')) {
    function getNotification($limit = null)
    {
        $query = Notification::latest();

        if ($limit) {
            $query->limit($limit);
        }

        return $query->get();
    }
}

if (!function_exists('getSetting')) {
    function getSetting()
    {
        return Setting::pluck('value', 'key')->toArray();
    }
}

if (!function_exists('getHolidaysCount')) {
    function getHolidaysCount($start_date, $end_date, $user_id)
    {
        $user = User::find($user_id);
        $holidays = json_decode($user->department->holidays) ?? [];
        $period = CarbonPeriod::create(Carbon::parse($start_date), Carbon::parse($end_date))->toArray();

        $publicHolidays = $user->department->publicHolidays()
            ->where(function ($query) use ($user) {
                $query->where('gender', $user->gender)
                    ->orWhere('gender', 'Both');
            })
            ->get();
        $publicHolidayDates = [];

        foreach ($publicHolidays as $holiday) {
            $start = Carbon::parse($holiday->start_date);
            $end = Carbon::parse($holiday->end_date);

            $overlapStartDate = $start->max($start_date);
            $overlapEndDate = $end->min($end_date);

            if ($overlapStartDate <= $overlapEndDate) {
                while ($overlapStartDate <= $overlapEndDate) {
                    $publicHolidayDates[] = $overlapStartDate->toDateString();
                    $overlapStartDate->addDay();
                }
            }
        }

        $count = 0;
        foreach ($period as $dt) {
            if (in_array($dt->format('l'), $holidays) || in_array($dt->format('l'), $publicHolidayDates)) {
                $count++;
            }
        }
        return $count;
    }
}
