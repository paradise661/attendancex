<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Http\Requests\Admin\BranchRequest;
use App\Models\Branch;
use Illuminate\Http\Request;
use Exception;
use Illuminate\Support\Facades\Gate;

class BranchController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        abort_unless(Gate::allows('view branch'), 403);

        $branches = Branch::latest()->paginate(perPage: 20);
        return view('admin.branch.index', compact('branches'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        abort_unless(Gate::allows('create branch'), 403);

        return view('admin.branch.create');
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(BranchRequest $request)
    {
        abort_unless(Gate::allows('create branch'), 403);

        try {
            Branch::create($request->all());
            return redirect()->route('branches.index')->with('message', 'Branch Created Successfully');
        } catch (Exception $e) {
            return redirect()->route('branches.index')->with('warning', $e->getMessage())->withInput();
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
    public function edit(Branch $branch)
    {
        abort_unless(Gate::allows('edit branch'), 403);

        return view('admin.branch.edit', compact('branch'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(BranchRequest $request, Branch $branch)
    {
        abort_unless(Gate::allows('edit branch'), 403);

        try {
            $branch->update($request->all());
            return redirect()->route('branches.index')->with('message', 'Update Successfully');
        } catch (Exception $e) {
            return redirect()->route('branches.index')->with('warning', $e->getMessage())->withInput();
        }
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Branch $branch)
    {
        abort_unless(Gate::allows('delete branch'), 403);

        $branch->delete();
        return redirect()->route('branches.index')->with('message', 'Delete Successfully');
    }
}
