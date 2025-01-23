<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Models\Attendance;
use App\Models\Notice;
use App\Models\User;
use Illuminate\Http\Request;
use Carbon\Carbon;

class DashboardController extends Controller
{
    public function dashboard(Request $request)
    {
        try {
            $today = Carbon::today();
            $currentYear = $today->year;

            $upcomingBirthday = User::select('id', 'first_name', 'last_name', 'date_of_birth', 'image', 'designation')
                ->whereNotNull('date_of_birth')
                ->get()
                ->map(function ($user) use ($today, $currentYear) {
                    $birthDate = Carbon::parse($user->date_of_birth);
                    $birthDate->year = ($birthDate->month < $today->month ||
                        ($birthDate->month == $today->month && $birthDate->day < $today->day))
                        ? $currentYear + 1 : $currentYear;

                    $daysLeft = $today->diffInDays($birthDate, false);

                    $user->upcoming_birthday_message = $this->formatBirthdayMessage($daysLeft);
                    $user->remaining_days = $daysLeft;
                    $user->full_name = "{$user->first_name} {$user->last_name}";
                    return $user;
                })
                ->sortBy('remaining_days')->first();

            $departmentId = $request->user()->department_id;

            $latestNotice = null;
            if ($departmentId) {
                $latestNotice = Notice::where('status', 1)
                    ->whereHas('departments', function ($query) use ($departmentId) {
                        $query->where('departments.id', $departmentId);
                    })
                    ->latest()
                    ->first();
            }

            $todayAttendance = Attendance::where('user_id', $request->user()->id)->whereDate('date', $today)->first();

            // Check if today's attendance exists and format checkin/checkout times
            if ($todayAttendance) {
                $todayAttendance->checkin = $todayAttendance->checkin ? Carbon::parse($todayAttendance->checkin)->format('g:i A') : null;
                $todayAttendance->checkout = $todayAttendance->checkout ? Carbon::parse($todayAttendance->checkout)->format('g:i A') : null;
            }

            return response()->json([
                'status' => 'success',
                'message' => 'Dashboard data retrieved successfully.',
                'data' => [
                    'today_attendance' => $todayAttendance,
                    'upcoming_birthday' => $upcomingBirthday,
                    'latest_notice' => $latestNotice,
                ],
            ]);
        } catch (\Exception $e) {
            return response()->json([
                'status' => 'error',
                'message' => 'Failed to retrieve dashboard data.',
                'error' => $e->getMessage(),
            ], 500);
        }
    }

    public function getUpcomingBirthdays()
    {
        try {
            $today = Carbon::today();
            $currentYear = $today->year;

            $users = User::select('id', 'first_name', 'last_name', 'date_of_birth', 'image', 'designation')
                ->whereNotNull('date_of_birth')
                ->get()
                ->map(function ($user) use ($today, $currentYear) {
                    $birthDate = Carbon::parse($user->date_of_birth);
                    $birthDate->year = ($birthDate->month < $today->month ||
                        ($birthDate->month == $today->month && $birthDate->day < $today->day))
                        ? $currentYear + 1 : $currentYear;

                    $daysLeft = $today->diffInDays($birthDate, false);

                    $user->upcoming_birthday_message = $this->formatBirthdayMessage($daysLeft);
                    $user->remaining_days = $daysLeft;
                    $user->full_name = "{$user->first_name} {$user->last_name}";
                    return $user;
                })
                ->sortBy('remaining_days')->values();

            return response()->json([
                'status' => 'success',
                'message' => 'Upcoming birthdays retrieved successfully.',
                'data' => $users,
            ]);
        } catch (\Exception $e) {
            return response()->json([
                'status' => 'error',
                'message' => 'Failed to retrieve birthdays.',
                'error' => $e->getMessage(),
            ], 500);
        }
    }

    private function formatBirthdayMessage($daysLeft)
    {
        if ($daysLeft == 0) {
            return 'Today';
        }

        if ($daysLeft == 1) {
            return '1 day left';
        }

        if ($daysLeft <= 7) {
            return "$daysLeft days later";
        }

        return "$daysLeft days later";
    }

    public function getNotices(Request $request)
    {
        try {
            $departmentId = $request->user()->department_id;

            if (!$departmentId) {
                return response()->json([
                    'status' => 'error',
                    'message' => 'User does not belong to any department.',
                ], 400);
            }

            $notices = Notice::where('status', 1)
                ->whereHas('departments', function ($query) use ($departmentId) {
                    $query->where('departments.id', $departmentId);
                })
                ->latest()
                ->get();


            return response()->json([
                'status' => 'success',
                'message' => 'Notices retrieved successfully.',
                'data' => $notices,
            ]);
        } catch (\Exception $e) {
            return response()->json([
                'status' => 'error',
                'message' => 'Failed to retrieve notices.',
                'error' => $e->getMessage(),
            ], 500);
        }
    }

    public function getMyTeam(Request $request)
    {
        try {
            $branchId = $request->user()->branch_id;

            if (!$branchId) {
                return response()->json([
                    'status' => 'error',
                    'message' => 'User does not belong to any branch.',
                ], 400);
            }

            $myteam = User::with('department')->where('user_type', 'Employee')->where('branch_id', $branchId)->latest()->get();

            return response()->json([
                'status' => 'success',
                'message' => 'Team retrieved successfully.',
                'data' => $myteam,
            ]);
        } catch (\Exception $e) {
            return response()->json([
                'status' => 'error',
                'message' => 'Failed to retrieve team.',
                'error' => $e->getMessage(),
            ], 500);
        }
    }
}
