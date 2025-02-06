<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Leave;
use Illuminate\Http\Request;

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

    public function update(Request $request, Leave $leave)
    {
        dd($leave);
    }
}
