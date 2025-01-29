<?php

namespace App\Livewire\Attendance;

use Livewire\Component;
use Livewire\WithPagination;
use App\Models\Attendance;
use App\Models\Branch;
use App\Models\User;
use Carbon\Carbon;

class Filterallemployee extends Component
{
    use WithPagination;
    public $searchTerms = '';
    public $limit = 10;
    public $branches = [];
    public $branch = '';

    public function mount()
    {
        $this->branches = Branch::where('status', 1)->latest()->get();
        $this->searchTerms = Carbon::today()->toDateString();
    }

    public function updatingSearchTerms()
    {
        $this->resetPage();
    }

    public function updatingBranch()
    {
        $this->resetPage();
    }

    public function applyFilters()
    {
        $this->resetPage();
    }

    public function clearFilters()
    {
        $this->searchTerms = Carbon::today()->toDateString();
        $this->branch = '';
        $this->limit = 10;
        $this->resetPage();
    }

    public function render()
    {
        $employees = User::where('user_type', 'Employee')->where('join_date', '>=', $this->searchTerms)->when($this->branch, function ($query) {
            return $query->where('branch_id', $this->branch);
        })->orderBy('first_name', 'ASC')->get();

        // Get the attendances based on the provided conditions
        $attendanceList = Attendance::when($this->branch, function ($query) {
            $query->whereHas('employee', function ($query) {
                $query->where('branch_id', $this->branch);
            });
        })
            ->when($this->searchTerms, function ($query) {
                return $query->whereDate('date', $this->searchTerms);
            })
            ->get();

        $attendances = [];
        foreach ($employees as $employee) {
            $attendance = $attendanceList->firstWhere('user_id', $employee->id);
            // dd($employee);
            if ($attendance) {
                $attendances[$employee->id] = (object) [
                    'user_id' => $employee->id,
                    'image' =>  $employee->image,
                    'full_name' => $employee->first_name . ' ' . $employee->last_name,
                    'branch' => $employee->branch->name ?? '-',
                    'date' => $this->searchTerms,
                    'checkin' => $attendance->checkin,
                    'checkout' => $attendance->checkout,
                    'break_start' => $attendance->break_start,
                    'break_end' => $attendance->break_end,
                    'worked_hours' => $attendance->worked_hours,
                    'type' => $attendance->type
                ];
            } else {
                $attendances[$employee->id] = (object) [
                    'user_id' => $employee->id,
                    'image' =>  $employee->image,
                    'full_name' => $employee->first_name . ' ' . $employee->last_name,
                    'branch' => $employee->branch->name ?? '-',
                    'date' => $this->searchTerms,
                    'checkin' => '-',
                    'checkout' => '-',
                    'break_start' => '-',
                    'break_end' => '-',
                    'worked_hours' => '-',
                    'type' => 'Absent'
                ];
            }
        }

        $attendances = collect($attendances);

        return view('livewire.attendance.filterallemployee', compact('attendances'));
    }
}
