<?php

namespace App\Http\Livewire\Dashboard;

use App\Models\Account;
use App\Models\Payment;
use Livewire\Component;

class DashbordIndex extends Component
{
    public $widgets = [];

    public function mount()
    {
        $this->widgets['Total Income'] = Payment::sum('amount');
        $this->widgets['Bank Balance'] = Account::find(112001)->balance;
        $this->widgets['Cash on Hand'] = Account::find(111027)->balance;
    }
    public function render()
    {
        return view('livewire.dashboard.dashbord-index')->layout('layouts.livewire_app');
    }
}
