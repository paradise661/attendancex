<?php

namespace App\Livewire\AttendanceRequest;

use App\Models\AttendanceRequest;
use Carbon\Carbon;
use Livewire\Component;
use Livewire\WithPagination;

class Filter extends Component
{
    use WithPagination;
    public $dateRange = '';
    public $limit = 10;

    public function mount()
    {
        $this->dateRange = Carbon::now()->subWeek()->format('Y-m-d') . ' to ' . Carbon::now()->format('Y-m-d');
    }

    public function updatingDateRange()
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
        $this->limit = 10;
        $this->resetPage();
    }

    public function render()
    {
        $dates = $this->dateRange ? explode(' to ', $this->dateRange) : [];
        $attendance_requests = AttendanceRequest::when(
            count($dates) === 2,
            fn($q) =>
            $q->whereBetween('date', [
                Carbon::parse($dates[0])->startOfDay(),
                Carbon::parse($dates[1])->endOfDay()
            ])
        )->latest()->paginate($this->limit);

        return view('livewire.attendance-request.filter', compact('attendance_requests'));
    }
}
