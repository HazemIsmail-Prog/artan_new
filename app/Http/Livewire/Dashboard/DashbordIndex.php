<?php

namespace App\Http\Livewire\Dashboard;

use App\Models\Account;
use App\Models\Payment;
use Livewire\Component;

class DashbordIndex extends Component
{
    public $totalIncome;
    public $bankBalance;
    public $cashOnHandBalance;
    public function mount()
    {
        $this->totalIncome = Payment::sum('amount');
        $this->bankBalance = Account::find(112001)->balance;
        $this->cashOnHandBalance = Account::find(111027)->balance;
    }
    public function render()
    {
        return view('livewire.dashboard.dashbord-index')->layout('layouts.livewire_app');
    }
}
