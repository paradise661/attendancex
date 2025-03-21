<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Mail\EmployeeNotifyRequest;
use App\Models\Attendance;
use App\Models\AttendanceRequest;
use App\Models\Notification;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Exception;
use Illuminate\Support\Facades\Mail;
use Illuminate\Support\Facades\Gate;


class AttendanceRequestController extends Controller
{
    public function index()
    {
        abort_unless(Gate::allows('view attendancerequest'), 403);

        return view('admin.attendancerequest.index');
    }

    public function edit(AttendanceRequest $attendancerequest, Request $request)
    {
        abort_unless(Gate::allows('manage attendancerequest'), 403);

        if ($notificationID = $request->query('notification_id')) {
            Notification::where('id', $notificationID)
                ->update([
                    'is_seen' => 1,
                    'seen_by' => Auth::id(),
                ]);
        }

        return view('admin.attendancerequest.edit', compact('attendancerequest'));
    }

    public function update(Request $request, AttendanceRequest $attendancerequest)
    {
        abort_unless(Gate::allows('manage attendancerequest'), 403);

        try {
            $input = $request->all();
            $input['action_by'] = Auth::id();

            if ($request->status === 'Approved') {
                $checkin = $attendancerequest->checkin ? date('H:i:s', strtotime($attendancerequest->checkin)) : null;
                $checkout = $attendancerequest->checkout ? date('H:i:s', strtotime($attendancerequest->checkout)) : null;

                $attendance = Attendance::where('user_id', $attendancerequest->user_id)
                    ->where('date', $attendancerequest->date)
                    ->first();

                if ($attendance) {
                    // Preserve existing checkin & checkout if not provided in $attendancerequest
                    $checkin = $checkin ?? ($attendance->checkin ? date('H:i:s', strtotime($attendance->checkin)) : null);
                    $checkout = $checkout ?? ($attendance->checkout ? date('H:i:s', strtotime($attendance->checkout)) : null);

                    // Recalculate worked hours based on available checkin & checkout
                    $workedHours = $checkin && $checkout ? calculateWorkedHours($checkin, $checkout) : $attendance->worked_hours;

                    $attendance->update([
                        'checkin' => $checkin,
                        'checkout' => $checkout,
                        'worked_hours' => $workedHours,
                        'request_reason' => $attendancerequest->reason ?? $attendance->request_reason,
                    ]);
                } else {
                    // If no attendance record exists, create a new one
                    $workedHours = $checkin && $checkout ? calculateWorkedHours($checkin, $checkout) : null;
                    Attendance::create([
                        'user_id' => $attendancerequest->user_id,
                        'date' => $attendancerequest->date,
                        'type' => 'Present',
                        'checkin' => $checkin,
                        'checkout' => $checkout,
                        'worked_hours' => $workedHours,
                        'attendance_by' => 'Admin',
                        'request_reason' => $attendancerequest->reason ?? null,
                    ]);
                }
            }
            $attendancerequest->update($input);

            //send mail to employee
            Mail::to($attendancerequest->employee->email ?? '')->send(
                new EmployeeNotifyRequest($attendancerequest, 'attendanceRequest')
            );

            return redirect()->route('attendance.request')->with('message', 'Update Successful');
        } catch (Exception $e) {
            return redirect()->route('attendance.request')->with('warning', $e->getMessage())->withInput();
        }
    }
}
