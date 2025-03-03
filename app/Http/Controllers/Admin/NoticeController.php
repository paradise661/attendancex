<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Http\Requests\Admin\NoticeRequest;
use App\Models\Department;
use App\Models\Notice;
use App\Models\User;
use Illuminate\Http\Request;
use Exception;
use Illuminate\Support\Facades\Gate;


class NoticeController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        abort_unless(Gate::allows('view appnotice'), 403);

        $notices = Notice::latest()->paginate(perPage: 20);
        return view('admin.notice.index', compact('notices'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        abort_unless(Gate::allows('create appnotice'), 403);

        $departments = Department::where('status', 1)->oldest('order')->get();
        return view('admin.notice.create', compact('departments'));
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(NoticeRequest $request)
    {
        abort_unless(Gate::allows('create appnotice'), 403);

        try {
            $notice =  Notice::create($request->all());
            $notice->departments()->attach($request->departments);

            $expoTokens = User::whereNotNull('expo_token')->pluck('expo_token')->toArray();
            sendPushNotification($expoTokens, $request->title, $request->description);

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
        abort_unless(Gate::allows('edit appnotice'), 403);

        $departments = Department::where('status', 1)->oldest('order')->get();
        return view('admin.notice.edit', compact('notice', 'departments'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(NoticeRequest $request, Notice $notice)
    {
        abort_unless(Gate::allows('edit appnotice'), 403);

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
        abort_unless(Gate::allows('delete appnotice'), 403);

        $notice->departments()->detach();
        $notice->delete();
        return redirect()->route('notices.index')->with('message', 'Delete Successfully');
    }
}
