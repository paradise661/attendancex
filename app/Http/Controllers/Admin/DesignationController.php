<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Http\Requests\Admin\DesignationRequest;
use App\Models\Designation;
use Illuminate\Http\Request;
use Exception;

class DesignationController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $designations = Designation::oldest('order')->paginate(perPage: 20);
        return view('admin.designation.index', compact('designations'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        return view('admin.designation.create');
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(DesignationRequest $request)
    {
        try {
            Designation::create($request->all());
            return redirect()->route('designations.index')->with('message', 'Designation Created Successfully');
        } catch (Exception $e) {
            return redirect()->route('designations.index')->with('warning', $e->getMessage())->withInput();
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
    public function edit(Designation $designation)
    {
        return view('admin.designation.edit', compact('designation'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(DesignationRequest $request, Designation $designation)
    {
        try {
            $designation->update($request->all());
            return redirect()->route('designations.index')->with('message', 'Update Successfully');
        } catch (Exception $e) {
            return redirect()->route('designations.index')->with('warning', $e->getMessage())->withInput();
        }
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Designation $designation)
    {
        $designation->delete();
        return redirect()->route('designations.index')->with('message', 'Delete Successfully');
    }
}
