<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Http\Requests\Admin\LeaveRequest;
use App\Models\Leave;
use App\Models\LeaveApproval;
use Illuminate\Http\Request;
use Exception;
use Illuminate\Support\Facades\Auth;


class LeaveController extends Controller
{
    public function index()
    {
        return view('admin.leave.index');
    }

    public function edit(Leave $leave)
    {
        return view('admin.leave.edit', compact('leave'));
    }

    public function update(LeaveRequest $request, Leave $leave)
    {
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

            return redirect()->route('leaves')->with('message', 'Leave request updated successfully.');
        } catch (Exception $e) {
            return redirect()->route('leaves')->with('warning', $e->getMessage())->withInput();
        }
    }
}
