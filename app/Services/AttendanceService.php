<?php

namespace App\Services;

use App\Models\Attendance;
use App\Models\Department;
use App\Models\LeaveApproval;
use App\Models\User;
use Carbon\Carbon;

class AttendanceService
{
    public static function getAttendance($startDate, $endDate, $userId)
    {
        $user = User::where('id', $userId)->first();
        if ($user) {
            $attendances = Attendance::where('user_id', $userId)
                ->whereBetween('date', [$startDate, $endDate]);
            $totalWorkedHour = $attendances->sum('worked_hours');
            $totalBreakTaken = $attendances->sum('total_break');
            $attendances = $attendances->get();

            $dateRange = Carbon::parse($startDate)->toPeriod($endDate);

            $absentDates = $dateRange->filter(function ($date) use ($attendances) {
                return !$attendances->contains('date', $date->format('Y-m-d'));
            });

            $leaves = LeaveApproval::whereBetween('date', [$startDate, $endDate])->where('user_id', $userId)->get();
            $leavesTakenDates = $leaves->pluck('date')->toArray();

            $weekends = json_decode($user->department->holidays ?? '') ?? [];

            // Append absent dates to $attendances
            foreach ($absentDates as $absentDate) {
                $type = 'Absent';
                if (in_array($absentDate->format('Y-m-d'), $leavesTakenDates)) {
                    $type = 'Leave';
                }
                if (in_array(date('l', strtotime($absentDate)), $weekends)) {
                    $type = 'Holiday';
                }
                $attendances->push((object)[
                    'user_id' => $userId,
                    'type' => $type,
                    'date' => $absentDate->format('Y-m-d'),
                ]);
            }

            $attendances = $attendances->sortBy('date')->values();
            return ['attendances' => $attendances, 'totalWorkedHour' => $totalWorkedHour, 'totalBreakTaken' => $totalBreakTaken];
        }

        return null;
    }
}
