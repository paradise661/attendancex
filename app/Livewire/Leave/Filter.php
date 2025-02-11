<?php

namespace App\Livewire\Leave;

use App\Models\Leave;
use Carbon\Carbon;
use Livewire\WithPagination;
use Livewire\Component;

class Filter extends Component
{
    use WithPagination;
    public $dateRange = '';
    public $limit = 10;
    public $status = '';

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
        $this->status = '';
        $this->limit = 10;
        $this->resetPage();
    }

    public function render()
    {
        $dates = $this->dateRange ? explode(' to ', $this->dateRange) : [];
        $leaves = Leave::when(
            count($dates) === 2,
            fn($q) =>
            $q->where(function ($query) use ($dates) {
                $query->whereBetween('from_date', [
                    Carbon::parse($dates[0])->startOfDay(),
                    Carbon::parse($dates[1])->endOfDay()
                ])->orWhereBetween('to_date', [
                    Carbon::parse($dates[0])->startOfDay(),
                    Carbon::parse($dates[1])->endOfDay()
                ]);
            })
        )
            ->when($this->status, fn($q) => $q->where('status', $this->status)) // Filter by status
            ->latest()
            ->paginate($this->limit);
        return view('livewire.leave.filter', compact('leaves'));
    }
}
