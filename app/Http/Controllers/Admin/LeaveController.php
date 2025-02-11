<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Http\Requests\Admin\LeaveRequest;
use App\Models\Leave;
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

            return redirect()->route('leaves')->with('message', 'Leave request updated successfully.');
        } catch (Exception $e) {
            return redirect()->route('leaves')->with('warning', $e->getMessage())->withInput();
        }
    }
}
