<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Http\Requests\PublicHolidayRequest;
use App\Models\Department;
use App\Models\PublicHoliday;
use Carbon\Carbon;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Gate;
use Exception;


class PublicHolidayController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        abort_unless(Gate::allows('view publicholiday'), 403);

        $publicHolidays = PublicHoliday::latest()->paginate(10);
        return view('admin.publicholiday.index', compact('publicHolidays'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        abort_unless(Gate::allows('create publicholiday'), 403);

        $departments = Department::orderBy('name', 'ASC')->get();
        return view('admin.publicholiday.create', compact('departments'));
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(PublicHolidayRequest $request)
    {
        abort_unless(Gate::allows('create publicholiday'), 403);
        try {
            $input = $request->except('holidays');
            $end_date = $request->end_date ?? $request->start_date;
            $input['status'] = 1;
            $input['end_date'] = $end_date;

            $start_date = Carbon::parse($request->start_date);
            $end_date = Carbon::parse($end_date);

            $input['total_days'] = $start_date->diffInDays($end_date) + 1;
            $publicHoliday = PublicHoliday::create($input);
            $publicHoliday->departments()->attach($request->departments);
            return redirect()->route('publicholidays.index')->with('message', 'New Holiday Added');
        } catch (Exception $e) {
            return redirect()->route('publicholidays.index')->with('warning', $e->getMessage())->withInput();
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
    public function edit(PublicHoliday $publicholiday)
    {
        abort_unless(Gate::allows('edit publicholiday'), 403);

        $departments = Department::orderBy('name', 'ASC')->get();
        return view('admin.publicholiday.edit', compact('publicholiday', 'departments'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(PublicHolidayRequest $request, PublicHoliday $publicholiday)
    {
        abort_unless(Gate::allows('edit publicholiday'), 403);

        try {
            $input = $request->except('holidays');
            $end_date = $request->end_date ?? $request->start_date;
            $input['status'] = 1;
            $input['end_date'] = $end_date;

            $start_date = Carbon::parse($request->start_date);
            $end_date = Carbon::parse($end_date);

            $input['total_days'] = $start_date->diffInDays($end_date) + 1;
            $publicholiday->update($input);
            $publicholiday->departments()->detach();
            $publicholiday->departments()->attach($request->departments);
            return redirect()->route('publicholidays.index')->with('message', 'Holiday Updated');
        } catch (Exception $e) {
            return redirect()->route('publicholidays.index')->with('warning', $e->getMessage())->withInput();
        }
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(PublicHoliday $publicholiday)
    {
        abort_unless(Gate::allows('delete publicholiday'), 403);

        $publicholiday->departments()->detach();
        $publicholiday->delete();
        return redirect()->route('publicholidays.index')->with('message', 'Holiday Deleted');
    }
}
