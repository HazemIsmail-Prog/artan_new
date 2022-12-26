<?php

namespace App\Http\Livewire\Vouchers;

use App\Models\Voucher;
use Livewire\Component;
use App\Exports\VouchersExport;
use App\Exports\VoucherTemplateExport;
use App\Imports\VoucherImport;
use App\Models\Account;
use Illuminate\Support\Facades\DB;
use Livewire\WithFileUploads;
use Maatwebsite\Excel\Facades\Excel;
use Barryvdh\DomPDF\Facade\Pdf as PDF;



class VouchersIndex extends Component
{
    use WithFileUploads;

    public $voucher_type;
    public $card_header;
    public $route_name;
    public $vouchers;
    public $search;
    public $file;

    public function mount($type)
    {
        $this->voucher_type = $type;
        switch ($this->voucher_type){
            case 'jv':
                $this->card_header = 'Journal Voucher';
                $this->route_name = 'journal_vouchers';
                break;
            case 'bp':
                $this->card_header = 'Bank Payment';
                $this->route_name = 'bank_payments';
                break;
            case 'br':
                $this->card_header = 'Bank Receipt';
                $this->route_name = 'bank_receipts';
                break;
        }
        $this->getVouchers();
    }

    public function getVouchers()
    {
        $this->vouchers = Voucher::query()
            ->with(['voucher_details' => function ($q) {
                $q->with('account');
            }])
            ->with('creator')
            ->where('voucher_type', $this->voucher_type)
            ->when($this->search, function ($q) {
                return $q->where('voucher_no', $this->search);
            })
            ->orderBy('id', 'desc')
            ->get();
    }

    public function updatedSearch()
    {
        $this->getVouchers();
    }

    public function import()
    {
        DB::beginTransaction();
        try {
            $voucher = Voucher::create([
                'voucher_no'    => Voucher::query()->where('voucher_type', 'jv')->max('voucher_no') + 1,
                'voucher_type'  => 'jv',
                'voucher_date'  => today(),
                'created_by'    => auth()->id(),
                'updated_by'    => auth()->id(),
            ]);
            Excel::import(new VoucherImport($voucher->id), $this->file);
            DB::commit();
            session()->flash('success', 'Transaction Added Successfully');
            $this->mount('jv');
        } catch (\Exception $e) {
            dd($e);
            DB::rollback();
        }
    }

    public function template()
    {
        $page_title = 'Voucher Template';
        $accounts = Account::query()->whereLevel(4)->get();
        return Excel::download(new VoucherTemplateExport($accounts), $page_title . '.xlsx');  //Excel
    }

    public function export()
    {
        $vouchers = Voucher::query()
            ->with(['voucher_details' => function ($q) {
                $q->with('account');
            }])
            ->where('voucher_type', $this->voucher_type)
            ->orderBy('id', 'desc')
            ->get();
        if ($vouchers->count() > 0) {
            return Excel::download(new VouchersExport($vouchers, $this->voucher_type, $this->card_header), $this->card_header . '.xlsx');  //Excel
        }
    }

    public function show($id)
    {
        $voucher = Voucher::query()
        ->with(['voucher_details' => function ($q) {
            $q->with('account');
        }])
        ->findOrFail($id);    
        
        $pdfContent = PDF::loadView('livewire.vouchers._show', [
            'voucher' => $voucher, 
            'page_title' => $this->card_header
            ])
        ->setPaper('a4', 'portrait') // [landscape, portrait]
        ->output(); 
        return response()->streamDownload(
            fn () => print($pdfContent),
            $this->card_header . ' No. - ' . $voucher->voucher_no . '.pdf'
        );
    }

    public function render()
    {
        return view('livewire.vouchers.vouchers-index')->layout('layouts.livewire_app');
    }
}
