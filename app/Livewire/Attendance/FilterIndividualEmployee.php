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

        if ($startDate && $endDate) {
            if ($startDate <= $joinDate) {
                $startDate = $joinDate;
            }

            $attendances = Attendance::when($this->employee, function ($query) {
                return $query->where('user_id', $this->employee);
            })
                ->when(count($dates) === 2, function ($query) use ($startDate, $endDate) {
                    return $query->whereBetween('date', [
                        \Carbon\Carbon::parse($startDate)->startOfDay(),
                        \Carbon\Carbon::parse($endDate)->endOfDay()
                    ]);
                });
            $this->totalWorkedHours = $attendances->sum('worked_hours');
            $this->totalBreak = $attendances->sum('total_break');

            $attendances = $attendances->get();

            $dateRange = Carbon::parse($startDate)->toPeriod($endDate);

            $absentDates = $dateRange->filter(function ($date) use ($attendances) {
                return !$attendances->contains('date', $date->format('Y-m-d'));
            });

            // Append absent dates to $attendances
            foreach ($absentDates as $absentDate) {
                $attendances->push((object) [
                    'date' => $absentDate->format('Y-m-d'),
                    'checkin' => '-',
                    'checkout' => '-',
                    'break_start' => '-',
                    'break_end' => '-',
                    'worked_hours' => 0,
                    'total_break' => '-',
                    'type' => 'Absent'
                ]);
            }


            $attendances = $attendances->sortBy('date')->values();
        } else {
            $attendances = collect([]);
        }


        return view('livewire.attendance.filter-individual-employee', compact('attendances'));
    }
}
