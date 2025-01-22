<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Http\Requests\Admin\NoticeRequest;
use App\Models\Department;
use App\Models\Notice;
use Illuminate\Http\Request;
use Exception;

class NoticeController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $notices = Notice::latest()->paginate(perPage: 20);
        return view('admin.notice.index', compact('notices'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        $departments = Department::where('status', 1)->oldest('order')->get();
        return view('admin.notice.create', compact('departments'));
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(NoticeRequest $request)
    {
        try {

            $notice =  Notice::create($request->all());
            $notice->departments()->attach($request->departments);

            return redirect()->route('notices.index')->with('message', 'Notice Created Successfully');
        } catch (Exception $e) {
            return redirect()->route('notices.index')->with('warning', $e->getMessage())->withInput();
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
    public function edit(Notice $notice)
    {
        $departments = Department::where('status', 1)->oldest('order')->get();
        return view('admin.notice.edit', compact('notice', 'departments'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(NoticeRequest $request, Notice $notice)
    {
        try {
            $notice->update($request->all());
            $notice->departments()->sync($request->departments);

            return redirect()->route('notices.index')->with('message', 'Update Successfully');
        } catch (Exception $e) {
            return redirect()->route('notices.index')->with('warning', $e->getMessage())->withInput();
        }
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Notice $notice)
    {
        $notice->departments()->detach();

        $notice->delete();
        return redirect()->route('notices.index')->with('message', 'Delete Successfully');
    }
}
