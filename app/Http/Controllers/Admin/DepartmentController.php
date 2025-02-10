<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Http\Requests\Admin\DepartmentRequest;
use App\Models\Branch;
use App\Models\Department;
use Illuminate\Http\Request;
use Exception;

class DepartmentController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $departments = Department::oldest('order')->paginate(perPage: 20);
        return view('admin.department.index', compact('departments'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        $branches = Branch::where('status', 1)->latest()->get();
        return view('admin.department.create', compact('branches'));
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(DepartmentRequest $request)
    {
        try {
            $input = $request->all();
            $input['holidays'] = json_encode($request->holidays ?? []);
            Department::create($input);
            return redirect()->route('departments.index')->with('message', 'Department Created Successfully');
        } catch (Exception $e) {
            return redirect()->route('departments.index')->with('warning', $e->getMessage())->withInput();
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
    public function edit(Department $department)
    {
        $branches = Branch::where('status', 1)->latest()->get();
        return view('admin.department.edit', compact('department', 'branches'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(DepartmentRequest $request, Department $department)
    {
        try {
            $input = $request->all();
            $input['holidays'] = $request->holidays ? json_encode($request->holidays) : json_encode([]);
            $department->update($input);
            return redirect()->route('departments.index')->with('message', 'Update Successfully');
        } catch (Exception $e) {
            return redirect()->route('departments.index')->with('warning', $e->getMessage())->withInput();
        }
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Department $department)
    {
        $department->delete();
        return redirect()->route('departments.index')->with('message', 'Delete Successfully');
    }
}
