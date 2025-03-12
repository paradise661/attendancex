<?php

use App\Http\Controllers\Admin\AttendanceController;
use App\Http\Controllers\Admin\AttendanceRequestController;
use App\Http\Controllers\Admin\BranchController;
use App\Http\Controllers\Admin\DepartmentController;
use App\Http\Controllers\Admin\DesignationController;
use App\Http\Controllers\Admin\EmployeeController;
use App\Http\Controllers\Admin\LeaveController;
use App\Http\Controllers\Admin\LeavetypeController;
use App\Http\Controllers\Admin\NoticeController;
use App\Http\Controllers\Admin\NotificationController;
use App\Http\Controllers\Admin\PublicHolidayController;
use App\Http\Controllers\Admin\RoleController;
use App\Http\Controllers\Admin\ShiftController;
use App\Http\Controllers\Admin\SiteSettingController;
use App\Http\Controllers\Auth\Authcontroller;
use App\Http\Controllers\DashboardController;
use Illuminate\Support\Facades\Route;
use Illuminate\Support\Facades\Artisan;


Route::get('/', function () {
    return view('auth.login');
});

//Authentication
Route::get('login', [Authcontroller::class, 'showLoginForm'])->name('login');
Route::post('login', [Authcontroller::class, 'login'])->name('login.submit');
Route::post('logout', [Authcontroller::class, 'logout'])->name('logout');

//CMS
Route::middleware(['auth'])->group(function () {
    Route::get('change-password', [Authcontroller::class, 'changePassword'])->name('change.password');
    Route::post('change-password', [Authcontroller::class, 'updatePassword'])->name('update.password');

    Route::get('dashboard', [DashboardController::class, 'index'])->name('dashboard');
    Route::resource('branches', BranchController::class);
    Route::resource('designations', DesignationController::class);
    Route::resource('departments', DepartmentController::class);
    Route::resource('shifts', ShiftController::class);
    Route::resource('employees', EmployeeController::class);
    Route::resource('notices', NoticeController::class);
    Route::resource('leavetypes', LeavetypeController::class);
    Route::resource('publicholidays', PublicHolidayController::class);
    Route::get('attendances', [AttendanceController::class, 'index'])->name('attendance.index');
    Route::get('attendance/individual', [AttendanceController::class, 'individualAttendance'])->name('attendance.individual');

    Route::get('request/attendance', [AttendanceRequestController::class, 'index'])
        ->name('attendance.request');
    Route::get('request/attendance/{attendancerequest}', [AttendanceRequestController::class, 'edit'])
        ->name('attendance.request.edit');
    Route::put('request/attendance/{attendancerequest}', [AttendanceRequestController::class, 'update'])
        ->name('attendance.request.update');

    Route::get('leaves', [LeaveController::class, 'index'])
        ->name('leaves');
    Route::get('leaves/{leave}', [LeaveController::class, 'edit'])
        ->name('leaves.edit');
    Route::put('leaves/{leave}', [LeaveController::class, 'update'])
        ->name('leaves.update');

    Route::get('notifications', [NotificationController::class, 'index'])
        ->name('notification.index');

    Route::get('site-setting', [SiteSettingController::class, 'siteSettings'])
        ->name('site.setting');
    Route::post('site-setting/update', [SiteSettingController::class, 'updateSiteSettings'])
        ->name('site.setting.update');
    Route::get('site-setting/removefile/{filename}/{type}', [SiteSettingController::class, 'removefileFromSite'])
        ->name('site.setting.remove.file');

    Route::resource('roles', RoleController::class);
});

Route::get('get-departments/{branch_id}', [EmployeeController::class, 'getDepartments']);
Route::get('get-shifts/{department_id}', [EmployeeController::class, 'getShifts']);

//permission
Route::get('insert/permission', [RoleController::class, 'insertPermission']);
Route::get('insert/role', [RoleController::class, 'insertRole']);

//configure update
Route::get('system/update', [DashboardController::class, 'systemUpdate'])->name('system.update');

Route::get('migrate/database', function () {
    Artisan::call('session:table');
    Artisan::call('migrate', ['--force' => true]);
    Artisan::call('config:clear');
    Artisan::call('session:clear');
    return 'migrate';
});
