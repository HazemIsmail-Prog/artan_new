<?php

namespace App\Http\Livewire\Dashboard;

use Livewire\Component;

class DashbordIndex extends Component
{
    public function render()
    {
        return view('livewire.dashboard.dashbord-index')->layout('layouts.livewire_app');
    }
}
