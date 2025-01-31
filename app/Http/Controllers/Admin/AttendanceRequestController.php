<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
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
            dd($request->all());
            $input = $request->all();
            $input['action_by'] = Auth::user()->id;
            $attendancerequest->update($input);
            return redirect()->route('attendance.request')->with('message', 'Update Successfully');
        } catch (Exception $e) {
            return redirect()->route('attendance.request')->with('warning', $e->getMessage())->withInput();
        }
    }
}
