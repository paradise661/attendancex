<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Http\Requests\Admin\ShiftRequest;
use App\Models\Department;
use App\Models\Shift;
use Illuminate\Http\Request;
use Exception;
use Illuminate\Support\Facades\Gate;

class ShiftController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        abort_unless(Gate::allows('view shift'), 403);

        $shifts = Shift::latest()->paginate(perPage: 20);
        return view('admin.shift.index', compact('shifts'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        abort_unless(Gate::allows('create shift'), 403);

        $departments = Department::where('status', 1)->latest()->get();
        return view('admin.shift.create', compact('departments'));
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(ShiftRequest $request)
    {
        abort_unless(Gate::allows('create shift'), 403);

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
        abort_unless(Gate::allows('edit shift'), 403);

        $departments = Department::where('status', 1)->latest()->get();
        return view('admin.shift.edit', compact('shift', 'departments'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(ShiftRequest $request, Shift $shift)
    {
        abort_unless(Gate::allows('edit shift'), 403);

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
        abort_unless(Gate::allows('delete shift'), 403);

        $shift->delete();
        return redirect()->route('shifts.index')->with('message', 'Delete Successfully');
    }
}
