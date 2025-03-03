<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Http\Requests\Admin\LeaveRequest;
use App\Mail\EmployeeNotifyRequest;
use App\Models\Leave;
use App\Models\LeaveApproval;
use App\Models\Notification;
use Illuminate\Http\Request;
use Exception;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Mail;
use Illuminate\Support\Facades\Gate;

class LeaveController extends Controller
{
    public function index()
    {
        abort_unless(Gate::allows('view leaverequest'), 403);

        return view('admin.leave.index');
    }

    public function edit(Leave $leave, Request $request)
    {
        abort_unless(Gate::allows('manage leaverequest'), 403);

        if ($notificationID = $request->query('notification_id')) {
            Notification::where('id', $notificationID)
                ->update([
                    'is_seen' => 1,
                    'seen_by' => Auth::id(),
                ]);
        }

        return view('admin.leave.edit', compact('leave'));
    }

    public function update(LeaveRequest $request, Leave $leave)
    {
        abort_unless(Gate::allows('manage leaverequest'), 403);

        try {
            $leave->update([
                'status' => $request->status,
                'action_reason' => $request->action_reason ?? NULL,
                'action_by' => Auth::id(),
            ]);

            if ($request->status === 'Approved') {
                $startDate = new \DateTime($leave->from_date);
                $endDate = new \DateTime($leave->to_date);

                // Insert single or multiple records based on date range
                while ($startDate <= $endDate) {
                    LeaveApproval::create([
                        'leave_id' => $leave->id,
                        'date' => $startDate->format('Y-m-d'),
                        'is_paid' => true,
                        'user_id' => $leave->user_id,
                    ]);
                    $startDate->modify('+1 day');
                }
            }

            //send mail to employee
            Mail::to($leave->employee->email ?? "")->send(
                new EmployeeNotifyRequest($leave, 'leaveRequest')
            );

            return redirect()->route('leaves')->with('message', 'Leave request updated successfully.');
        } catch (Exception $e) {
            return redirect()->route('leaves')->with('warning', $e->getMessage())->withInput();
        }
    }
}
