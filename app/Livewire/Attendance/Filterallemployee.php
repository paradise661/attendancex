<?php

namespace App\Livewire\Attendance;

use Livewire\Component;
use Livewire\WithPagination;
use App\Models\Attendance;
use App\Models\Branch;
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
        $attendances = Attendance::when($this->branch, function ($query) {
            $query->whereHas('employee', function ($query) {
                $query->where('branch_id', $this->branch);
            });
        })
            ->when($this->searchTerms, function ($query) {
                return $query->whereDate('date', $this->searchTerms);
            })
            ->latest()
            ->paginate($this->limit);

        return view('livewire.attendance.filterallemployee', compact('attendances'));
    }
}
