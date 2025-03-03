<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Gate;
use App\Models\Attendance;
use Illuminate\Http\Request;

class AttendanceController extends Controller
{
    public function index()
    {
        abort_unless(Gate::allows('view allemployeesattendance'), 403);

        return view('admin.attendance.index');
    }

    public function individualAttendance()
    {
        abort_unless(Gate::allows('view individualemployeeattendance'), 403);

        return view('admin.attendance.individual');
    }
}
