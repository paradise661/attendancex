<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Http\Requests\Admin\EmployeeRequest;
use App\Models\Branch;
use App\Models\Department;
use App\Models\Designation;
use App\Models\Shift;
use App\Models\User;
use Illuminate\Http\Request;
use Exception;
use File;
use Illuminate\Support\Facades\Hash;

class EmployeeController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        return view('admin.employee.index');
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        $branches = Branch::where('status', 1)->oldest('order')->get();
        $departments = Department::where('status', 1)->oldest('order')->get();
        $shifts = Shift::where('status', 1)->oldest('order')->get();
        $designations = Designation::where('status', 1)->oldest('order')->get();
        return view('admin.employee.create', compact('branches', 'departments', 'shifts', 'designations'));
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(EmployeeRequest $request)
    {
        try {
            $input = $request->all();
            $input['image'] = $this->fileUpload($request, 'image');
            $input['password'] = Hash::make('password');
            $input['status'] = 'Active';

            User::create($input);
            return redirect()->route('employees.index')->with('message', 'Employee Created Successfully.');
        } catch (Exception $e) {
            return redirect()->route('employees.index')->with('warning', $e->getMessage())->withInput();
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
    public function edit(User $employee)
    {
        $branches = Branch::where('status', 1)->oldest('order')->get();
        $departments = Department::where('status', 1)->oldest('order')->get();
        $shifts = Shift::where('status', 1)->oldest('order')->get();
        $designations = Designation::where('status', 1)->oldest('order')->get();

        return view('admin.employee.edit', compact('employee', 'branches', 'departments', 'shifts', 'designations'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(EmployeeRequest $request, User $employee)
    {
        $validated = $request->validate([
            'password' => 'nullable|min:8',  // Ensure password is at least 8 characters if provided
            'image' => 'nullable|image|mimes:jpeg,png,jpg,gif,svg|max:2048',  // Validate image if provided
        ]);

        try {

            $old_image = $employee->image;
            $input = $request->except('password');
            if ($request->password) {
                $input['password'] = Hash::make($request->password);
            }

            $image = $this->fileUpload($request, 'image');

            if ($image) {
                $this->removeFile($old_image);
                $input['image'] = $image;
            } else {
                unset($input['image']);
            }

            $employee->update($input);

            return redirect()->route('employees.index')->with('message', 'Updated Successfully.');
        } catch (Exception $e) {
            return redirect()->route('employees.index')->with('warning', $e->getMessage())->withInput();
        }
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(User $employee)
    {
        $this->removeFile($employee->image);
        $employee->delete();
        return redirect()->route('employees.index')->with('message', 'Delete Successfully');
    }

    public function fileUpload(Request $request, $name)
    {
        $imageName = '';
        if ($image = $request->file($name)) {
            $destinationPath = public_path() . '/uploads/employee';
            $imageName = date('YmdHis') . $name . "-" . $image->getClientOriginalName();
            $image->move($destinationPath, $imageName);
            $image = $imageName;
        }
        return $imageName;
    }

    public function removeFile($file)
    {
        if ($file) {
            $filePath = str_replace(asset(''), '', $file);

            if ($filePath === 'assets/images/profile.jpg') {
                return;
            }

            $path = public_path($filePath);

            if (File::exists($path)) {
                File::delete($path);
            }
        }
    }

    public function getDepartments($branch_id)
    {
        $departments = Department::where('branch_id', $branch_id)->get();
        return response()->json($departments);
    }

    public function getShifts($department_id)
    {
        $shifts = Shift::where('department_id', $department_id)->get();
        return response()->json($shifts);
    }
}
