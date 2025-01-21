<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Http\Requests\Admin\ShiftRequest;
use App\Models\Department;
use App\Models\Shift;
use Illuminate\Http\Request;
use Exception;

class ShiftController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $shifts = Shift::latest()->paginate(perPage: 20);
        return view('admin.shift.index', compact('shifts'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        $departments = Department::where('status', 1)->latest()->get();
        return view('admin.shift.create', compact('departments'));
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(ShiftRequest $request)
    {
        try {
            Shift::create($request->all());
            return redirect()->route('shifts.index')->with('message', 'Shift Created Successfully');
        } catch (Exception $e) {
            return redirect()->route('shifts.index')->with('warning', $e->getMessage())->withInput();
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
    public function edit(Shift $shift)
    {
        $departments = Department::where('status', 1)->latest()->get();
        return view('admin.shift.edit', compact('shift', 'departments'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(ShiftRequest $request, Shift $shift)
    {
        try {
            $shift->update($request->all());
            return redirect()->route('shifts.index')->with('message', 'Update Successfully');
        } catch (Exception $e) {
            return redirect()->route('shifts.index')->with('warning', $e->getMessage())->withInput();
        }
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Shift $shift)
    {
        $shift->delete();
        return redirect()->route('shifts.index')->with('message', 'Delete Successfully');
    }
}
