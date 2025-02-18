<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use Exception;
use Illuminate\Http\Request;

class HolidayController extends Controller
{
    public function publicHolidays(Request $request)
    {
        try {
            $user = $request->user();

            $holidays = $user->department->publicHolidays()
                ->where(function ($query) use ($user) {
                    $query->where('gender', $user->gender)
                        ->orWhere('gender', 'Both');
                })
                ->get();
            $weekends = json_decode($user->department->holidays ?? '') ?? [];

            $holidayDates = [];

            foreach ($holidays as $holiday) {
                $startDate = \Carbon\Carbon::parse($holiday->start_date); // Convert start_date to Carbon instance
                $endDate = \Carbon\Carbon::parse($holiday->end_date); // Convert end_date to Carbon instance

                while ($startDate <= $endDate) {
                    $existingHolidayIndex = array_search($startDate->toDateString(), array_column($holidayDates, 'date'));

                    if ($existingHolidayIndex !== false) {
                        $holidayDates[$existingHolidayIndex]['name'] .= ', ' . $holiday->name;
                    } else {
                        $holidayDates[] = [
                            'id' => $holiday->id,
                            'date' => $startDate->toDateString(),
                            'name' => $holiday->name,
                        ];
                    }

                    $startDate->addDay();
                }
            }

            usort($holidayDates, function ($a, $b) {
                return strtotime($a['date']) - strtotime($b['date']);
            });

            return response()->json([
                'status' => 'success',
                'message' => 'Public Holidays retrieved successfully.',
                'data' => $holidayDates,
                'weekends' => $weekends,
            ]);
        } catch (Exception $e) {
            return response()->json([
                'status' => 'error',
                'message' => 'Failed to retrieve public holidays.',
                'error' => $e->getMessage(),
            ], 500);
        }
    }
}
