<?php

use App\Http\Controllers\Api\AttendanceController;
use App\Http\Controllers\Api\DashboardController;
use App\Http\Controllers\Api\HolidayController;
use App\Http\Controllers\Api\LeaveController;
use App\Http\Controllers\Api\UserAuthController;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;

Route::get('/user', function (Request $request) {
    return $request->user();
})->middleware('auth:sanctum');

Route::post('login', [UserAuthController::class, 'login']);
Route::post('biometric/login', [UserAuthController::class, 'biometricLogin']);
Route::get('settings', [DashboardController::class, 'settings']);
Route::post('forgotpassword/sendotp', [UserAuthController::class, 'forgotPasswordOtp']);
Route::post('forgotpassword/checkotp', [UserAuthController::class, 'forgotPasswordCheckOtp']);
Route::post('resetpassword', [UserAuthController::class, 'resetPassword']);

// Sanctum-protected routes
Route::middleware(['auth:sanctum'])->group(function () {
    Route::post('change-password', [UserAuthController::class, 'changePassword']);
    Route::post('update-profile', [UserAuthController::class, 'updateProfile']);
    Route::get('dashboard', [DashboardController::class, 'dashboard']);
    Route::get('upcomingbirthdays', [DashboardController::class, 'getUpcomingBirthdays']);
    Route::get('notices', [DashboardController::class, 'getNotices']);
    Route::get('myteam', [DashboardController::class, 'getMyTeam']);

    Route::get('attendance', [AttendanceController::class, 'getAttendance']);
    Route::post('attendance/checkin', [AttendanceController::class, 'checkIn']);
    Route::post('attendance/checkout', [AttendanceController::class, 'checkOut']);
    Route::post('attendance/breakstart', [AttendanceController::class, 'breakStart']);
    Route::post('attendance/breakend', [AttendanceController::class, 'breakEnd']);
    Route::post('attendance/record', [AttendanceController::class, 'getSpecificDateAttendanceRecord']);
    Route::get('attendance/request', [AttendanceController::class, 'getMyAttendanceRequest']);
    Route::post('attendance/request', [AttendanceController::class, 'attendanceRequest']);

    Route::get('leavetypes', [LeaveController::class, 'getLeaveTypes']);
    Route::get('leaves', [LeaveController::class, 'getLeaves']);
    Route::post('leave/request', [LeaveController::class, 'leaveRequest']);
    Route::post('leave/cancel', [LeaveController::class, 'leaveCancelRequest']);
    Route::get('publicholidays', [HolidayController::class, 'publicHolidays']);
});
