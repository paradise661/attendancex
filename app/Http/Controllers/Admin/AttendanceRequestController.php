<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Attendance;
use App\Models\AttendanceRequest;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Exception;

class AttendanceRequestController extends Controller
{
    public function index()
    {
        return view('admin.attendancerequest.index');
    }

    public function edit(AttendanceRequest $attendancerequest)
    {
        return view('admin.attendancerequest.edit', compact('attendancerequest'));
    }

    public function update(Request $request, AttendanceRequest $attendancerequest)
    {
        try {
            $input = $request->all();
            $input['action_by'] = Auth::id();
            $attendancerequest->update($input);

            if ($request->status === 'Approved') {
                $checkin = $attendancerequest->checkin ? date('H:i:s', strtotime($attendancerequest->checkin)) : null;
                $checkout = $attendancerequest->checkout ? date('H:i:s', strtotime($attendancerequest->checkout)) : null;
                $workedHours = calculateWorkedHours($checkin, $checkout);

                Attendance::updateOrCreate(
                    ['user_id' => $attendancerequest->user_id, 'date' => $attendancerequest->date],
                    [
                        'type' => 'Present',
                        'checkin' => $checkin,
                        'checkout' => $checkout,
                        'worked_hours' => $workedHours,
                        'attendance_by' => 'Admin',
                        'request_reason' => $attendancerequest->reason ?? null,
                    ]
                );
            }

            return redirect()->route('attendance.request')->with('message', 'Update Successful');
        } catch (Exception $e) {
            return redirect()->route('attendance.request')->with('warning', $e->getMessage())->withInput();
        }
    }
}
