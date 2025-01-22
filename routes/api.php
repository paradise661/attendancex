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

// Sanctum-protected routes
Route::middleware(['auth:sanctum'])->group(function () {
    Route::get('dashboards', [DashboardController::class, 'dashboard']);
    Route::get('upcomingbirthdays', [DashboardController::class, 'getUpcomingBirthdays']);
    Route::get('notices', [DashboardController::class, 'getNotices']);
    Route::get('myteam', [DashboardController::class, 'getMyTeam']);
    Route::post('attendance', [AttendanceController::class, 'store']);
});
