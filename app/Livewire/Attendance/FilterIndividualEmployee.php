<?php

namespace App\Livewire\Attendance;

use App\Models\User;
use Livewire\Component;
use Carbon\Carbon;
use Livewire\WithPagination;
use App\Models\Attendance;
use App\Services\AttendanceService;

class FilterIndividualEmployee extends Component
{
    use WithPagination;
    public $dateRange = '';
    public $limit = 10;
    public $employees = [];
    public $employee = '';
    public $totalWorkedHours = 0;
    public $totalBreak = 0;

    public function mount()
    {
        $this->employees = User::where('user_type', 'Employee')->orderBy('first_name')->get();
        $this->dateRange = Carbon::now()->subWeek()->format('Y-m-d') . ' to ' . Carbon::now()->format('Y-m-d');
    }

    public function updatingDateRange()
    {
        $this->resetPage();
    }

    public function updatingEmployee()
    {
        $this->resetPage();
    }

    public function applyFilters()
    {
        $this->resetPage();
    }

    public function clearFilters()
    {
        $this->dateRange = '';
        $this->employee = '';
        $this->limit = 10;
        $this->resetPage();
    }

    public function render()
    {
        if (!$this->employee) {
            $this->employee = $this->employees->first()->id;
            $joinDate = $this->employees->first()->join_date;
        } else {
            $joinDate = User::find($this->employee)->join_date;
        }

        $dates = [];
        if (!empty($this->dateRange)) {
            $dates = explode(' to ', $this->dateRange);
        }

        $startDate = $dates[0] ?? '';
        $endDate = $dates[1] ?? '';

        $totalWorkedHour = 0;
        $totalBreakTaken = 0;
        if ($startDate && $endDate) {
            if ($startDate <= $joinDate) {
                $startDate = $joinDate;
            }

            $attendancesRecords = AttendanceService::getAttendance($startDate, $endDate, $this->employee);
            $attendances = $attendancesRecords['attendances'];
            $totalWorkedHour = $attendancesRecords['totalWorkedHour'];
            $totalBreakTaken = $attendancesRecords['totalBreakTaken'];
        } else {
            $attendances = collect([]);
        }

        return view('livewire.attendance.filter-individual-employee', compact('attendances', 'totalWorkedHour', 'totalBreakTaken'));
    }
}
