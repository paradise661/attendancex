<?php

namespace App\Livewire;

use App\Models\User;
use Livewire\Component;
use Livewire\WithPagination;

class Employee extends Component
{
    use WithPagination;
    public $searchTerms = '';
    public $limit = 1;

    public function updatingSearchTerms()
    {
        $this->resetPage();
    }

    public function applyFilters()
    {
        $this->resetPage();
    }

    public function clearFilters()
    {
        $this->searchTerms = '';
        $this->limit = 1;
        $this->resetPage();
    }

    public function render()
    {
        $searchTerms = '%' . $this->searchTerms . '%';
        $employees = User::where('user_type', 'Employee')
            ->where(function ($query) use ($searchTerms) {
                $query->where('first_name', 'like', $searchTerms)
                    ->orWhere('last_name', 'like', $searchTerms)
                    ->orWhere('email', 'like', $searchTerms)
                    ->orWhere('phone', 'like', $searchTerms);
            })
            ->orderBy('first_name')
            ->paginate($this->limit);

        return view('livewire.employee', compact('employees'));
    }
}
