<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Models\Attendance;
use App\Models\Notice;
use App\Models\Setting;
use App\Models\User;
use Illuminate\Http\Request;
use Carbon\Carbon;
use DateTime;
use Illuminate\Support\Facades\DB;

class DashboardController extends Controller
{
    public function dashboard(Request $request)
    {
        try {
            $today = Carbon::today();
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


            $start_month = date('Y-m-01');
            $end_month = date('Y-m-d', strtotime('-1 day'));

            // Get the user attendance for the current month
            $attendanceRecords = Attendance::where('user_id', $request->user()->id)
                ->whereBetween('date', [$start_month, $end_month]) // Filter by the current month
                ->whereNotNull('checkout')
                ->get();
            $todayAttn = Attendance::where('user_id', $request->user()->id)
                ->where('date', date('Y-m-d'))
                ->first();

            $totalDaysInMonth = date('d');
            $holidaysCount = getHolidaysCount($start_month, $end_month, $request->user()->id);
            $totalBusinessDays = $totalDaysInMonth - $holidaysCount;
            $presentDays = $attendanceRecords->count();
            if ($todayAttn) {
                $presentDays = $presentDays + 1;
            }

            $presentPercentage = ($presentDays / $totalBusinessDays) * 100;

            return response()->json([
                'status' => 'success',
                'message' => 'Dashboard data retrieved successfully.',
                'data' => [
                    'today_attendance' => $todayAttendance,
                    'latest_notice' => $latestNotice,
                    'presentPercentage' => round($presentPercentage, 0),
                    'ads' => asset('uploads/ads/main.jpeg'),
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

    public function getUpcomingBirthdays(Request $request)
    {
        try {
            $today = Carbon::today();
            $currentYear = $today->year;

            $users = User::select('id', 'first_name', 'last_name', 'date_of_birth', 'image', 'designation')
                ->whereHas('branch', callback: function ($query) use ($request) {
                    $query->where('branches.id', $request->user()->branch_id);
                })
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

            $myteam = User::with('department')->where('user_type', 'Employee')->where('branch_id', $branchId)->oldest('order')->get();

            $teamData = $myteam->groupBy(function ($user) {
                return $user->department->name;
            });

            $formattedTeamData = $teamData->map(function ($members, $department) {
                return [
                    'name' => $department,
                    'members' => $members->map(function ($member) {
                        return $member;
                    }),
                ];
            })->values();

            return response()->json([
                'status' => 'success',
                'message' => 'Team retrieved successfully.',
                'data' => $formattedTeamData,
            ]);
        } catch (\Exception $e) {
            return response()->json([
                'status' => 'error',
                'message' => 'Failed to retrieve team.',
                'error' => $e->getMessage(),
            ], 500);
        }
    }

    public function settings()
    {
        try {
            $settings = Setting::pluck('value', 'key');

            if ($settings['company_logo']) {
                $settings['company_logo'] = asset('uploads/site/' . $settings['company_logo']);
            }

            if ($settings['app_logo']) {
                $settings['app_logo'] = asset('uploads/site/' . $settings['app_logo']);
            }

            return response()->json([
                "statusCode" => 200,
                "error" => false,
                "data" => $settings,
                'message' => 'Retrieved successfully'
            ]);
        } catch (\Exception $e) {
            return response()->json(['statusCode' => 401, 'error' => true, 'message' => $e->getMessage()]);
        }
    }
}
