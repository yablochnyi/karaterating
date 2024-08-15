<?php

namespace App\Livewire;

use App\Models\Region;
use App\Models\ManageTournament;
use Livewire\Component;

class FilterRegion extends Component
{
    public $regions;
    public $tournaments;
    public $q = '';
    public $selectedRegions = [];

    public function mount()
    {
        $this->regions = Region::all();
        $this->search(); // Инициализация списка турниров при монтировании
    }

    public function updatedQ()
    {
        $this->search();
    }

    public function updatedSelectedRegions()
    {
        $this->search();
    }

    public function search()
    {
        $query = ManageTournament::query();

        if (!empty($this->q)) {
            $query->where('name', 'like', '%' . $this->q . '%');
        }

        if (!empty($this->selectedRegions)) {
            $query->whereIn('region_id', $this->selectedRegions);
        }

        $this->tournaments = $query->orderBy('date', 'desc')->where('delete', false)->with('coaches')->get();
    }

    public function render()
    {
        return view('livewire.filter-region');
    }
}
