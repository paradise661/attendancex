<?php

namespace App\Http\Controllers;

use App\Models\Attendance;
use App\Models\Department;
use App\Models\LeaveApproval;
use App\Models\User;
use Carbon\Carbon;
use Illuminate\Http\Request;


class DashboardController extends Controller
{
    public function index()
    {
        // return 1;
        $totalEmployees = User::where('user_type', 'Employee')->where('status', 'Active')->get()->count();
        $departmentCount = Department::count();

        // upcomingBirthdays
        $today = Carbon::today();
        $currentYear = $today->year;

        $upcomingBirthdays = User::select('id', 'email', 'first_name', 'last_name', 'date_of_birth', 'image', 'designation')
            ->whereNotNull('date_of_birth')
            ->get()
            ->map(function ($user) use ($today, $currentYear) {
                $birthDate = Carbon::parse($user->date_of_birth);
                $birthDate->year = ($birthDate->month < $today->month ||
                    ($birthDate->month == $today->month && $birthDate->day < $today->day))
                    ? $currentYear + 1 : $currentYear;

                $daysLeft = $today->diffInDays($birthDate, false);

                // $user->upcoming_birthday_message = $this->formatBirthdayMessage($daysLeft);
                $user->remaining_days = $daysLeft;
                $user->full_name = "{$user->first_name} {$user->last_name}";
                $user->email = $user->email;
                return $user;
            })
            ->sortBy('remaining_days')->take(3)->values();
        // return $upcomingBirthdays;

        $todayPresent = Attendance::where('date', date('Y-m-d'))->get()->count();
        $todayLeave = LeaveApproval::where('date', date('Y-m-d'))->get()->count();
        $todayAbsent = $totalEmployees - $todayPresent - $todayLeave;
        $presentPercent = intval($todayPresent / $totalEmployees * 100);

        return view('admin.dashboard', compact('totalEmployees', 'presentPercent', 'departmentCount', 'upcomingBirthdays', 'todayPresent', 'todayAbsent', 'todayLeave'));
    }
}
