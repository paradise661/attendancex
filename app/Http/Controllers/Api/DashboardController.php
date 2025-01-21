<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Models\User;
use Illuminate\Http\Request;
use Carbon\Carbon;

class DashboardController extends Controller
{
    public function dashboard()
    {
        return 'dashboard data';
    }

    public function upcomingBirthdays()
    {
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

                // Combine first_name and last_name
                $user->full_name = "{$user->first_name} {$user->last_name}";

                return $user;
            })
            ->sortBy('remaining_days')->values();

        return response()->json([
            'status' => 'success',
            'message' => 'Upcoming birthdays retrieved successfully.',
            'data' => $users,
        ]);
    }

    private function formatBirthdayMessage($daysLeft)
    {
        if ($daysLeft == 1) {
            return '1 day left';
        }

        if ($daysLeft <= 7) {
            return "$daysLeft days later";
        }

        return "$daysLeft days later";
    }
}
