<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Http\Requests\Admin\DesignationRequest;
use App\Models\Designation;
use Illuminate\Http\Request;
use Exception;
use Illuminate\Support\Facades\Gate;


class DesignationController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        abort_unless(Gate::allows('view designation'), 403);

        $designations = Designation::oldest('order')->paginate(perPage: 20);
        return view('admin.designation.index', compact('designations'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        abort_unless(Gate::allows('create designation'), 403);

        return view('admin.designation.create');
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(DesignationRequest $request)
    {
        abort_unless(Gate::allows('create designation'), 403);

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
        abort_unless(Gate::allows('edit designation'), 403);

        return view('admin.designation.edit', compact('designation'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(DesignationRequest $request, Designation $designation)
    {
        abort_unless(Gate::allows('edit designation'), 403);

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
        abort_unless(Gate::allows('delete designation'), 403);

        $designation->delete();
        return redirect()->route('designations.index')->with('message', 'Delete Successfully');
    }
}
