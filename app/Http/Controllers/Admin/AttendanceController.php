<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Attendance;
use Illuminate\Http\Request;

class AttendanceController extends Controller
{
    public function index()
    {
        $attendances = Attendance::where('date', today())->latest()->paginate(20);
        return view('admin.attendance.index', compact('attendances'));
    }
}
