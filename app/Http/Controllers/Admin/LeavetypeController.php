<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Http\Requests\Admin\LeavetypeRequest;
use App\Models\LeaveType;
use Illuminate\Http\Request;
use Exception;

class LeavetypeController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $leavetypes = LeaveType::oldest('order')->paginate(perPage: 20);
        return view('admin.leavetype.index', compact('leavetypes'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        return view('admin.leavetype.create');
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(LeavetypeRequest $request)
    {
        try {
            LeaveType::create($request->all());
            return redirect()->route('leavetypes.index')->with('message', 'Leavetype Created Successfully');
        } catch (Exception $e) {
            return redirect()->route('leavetypes.index')->with('warning', $e->getMessage())->withInput();
        }
    }

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(LeaveType $leavetype)
    {
        return view('admin.leavetype.edit', compact('leavetype'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(LeavetypeRequest $request, LeaveType $leavetype)
    {
        try {
            $input = $request->all();
            $input['is_paid'] = $request->is_paid ? 1 : 0;
            $leavetype->update($input);
            return redirect()->route('leavetypes.index')->with('message', 'Leavetype Update Successfully');
        } catch (Exception $e) {
            return redirect()->route('leavetypes.index')->with('warning', $e->getMessage())->withInput();
        }
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(LeaveType $leavetype)
    {
        $leavetype->delete();
        return redirect()->route('leavetypes.index')->with('message', 'Delete Successfully');
    }
}
