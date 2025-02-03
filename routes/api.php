<?php

use App\Http\Controllers\Api\AttendanceController;
use App\Http\Controllers\Api\DashboardController;
use App\Http\Controllers\Api\UserAuthController;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;

Route::get('/user', function (Request $request) {
    return $request->user();
})->middleware('auth:sanctum');

Route::post('login', [UserAuthController::class, 'login']);
Route::get('settings', [DashboardController::class, 'settings']);

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
});
