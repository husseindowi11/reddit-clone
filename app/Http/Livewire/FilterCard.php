<?php

namespace App\Http\Livewire;

use App\Models\Community;
use Livewire\Component;

class FilterCard extends Component
{
    public $community;
    public function mount(Community $community)
    {
        $this->community = $community;
    }
    public function render()
    {
        return view('livewire.filter-card');
    }
}
