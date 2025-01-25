<?php

namespace App\Livewire\Attendance;

use App\Models\User;
use Livewire\Component;
use Carbon\Carbon;
use Livewire\WithPagination;
use App\Models\Attendance;

class FilterIndividualEmployee extends Component
{
    use WithPagination;
    public $dateRange = '';
    public $limit = 10;
    public $employees = [];
    public $employee = '';
    public $totalWorkedHours = 0;

    public function mount()
    {
        $this->employees = User::where('user_type', 'Employee')->latest()->get();
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
        $dates = [];
        if (!empty($this->dateRange)) {
            $dates = explode(' to ', $this->dateRange);
        }

        $attendancesQuery = Attendance::when($this->employee, function ($query) {
            return $query->where('user_id', $this->employee);
        })
            ->when(count($dates) === 2, function ($query) use ($dates) {
                return $query->whereBetween('date', [
                    \Carbon\Carbon::parse($dates[0])->startOfDay(),
                    \Carbon\Carbon::parse($dates[1])->endOfDay()
                ]);
            });

        $this->totalWorkedHours = $attendancesQuery->sum('worked_hours');

        $attendances = $attendancesQuery->latest()->paginate($this->limit);

        return view('livewire.attendance.filter-individual-employee', compact('attendances'));
    }
}
