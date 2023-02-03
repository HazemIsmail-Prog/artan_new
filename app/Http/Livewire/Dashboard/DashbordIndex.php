<?php

namespace App\Http\Livewire\Dashboard;

use App\Models\Account;
use App\Models\Payment;
use Illuminate\Support\Facades\DB;
use Livewire\Component;

class DashbordIndex extends Component
{
    public $widgets = [];
    public $yearList =[];
    public $year;
    public $chartData;

    public function mount()
    {
        // $this->yearList = Payment::selectRaw('YEAR(created_at) as year')->distinct()->get();
        $this->year = now()->format('Y');
        $this->updatedYear();
        $this->widgets['Bank Balance'] = Account::find(112001)->balance;
        $this->widgets['Cash on Hand'] = Account::find(111027)->balance;
    }

    public function updatedYear(){
        $this->yearList = Payment::selectRaw('YEAR(created_at) as year')->distinct()->get();
        $this->chartData = Payment::query()
        ->whereYear('created_at', $this->year)
        ->select(
            DB::raw("
            sum(amount) as total, 
            YEAR(created_at) year, 
            MONTH(created_at) month
            ")
            )
            ->groupBy('year', 'month')
            ->get()->toArray();
            // dd('');
        $this->dispatchBrowserEvent('loadChart',$this->chartData);

    }
    public function render()
    {
        return view('livewire.dashboard.dashbord-index')->layout('layouts.livewire_app');
    }
}
