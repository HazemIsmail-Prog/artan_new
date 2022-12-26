<?php

namespace App\Http\Livewire\Vouchers;

use App\Models\Account;
use App\Models\Voucher;
use Illuminate\Support\Facades\DB;
use Livewire\Component;

class VoucherForm extends Component
{

    public $accounts, $action, $voucher_type, $current_voucher, $card_header;
    public $date, $copy_from;
    public $placeholder = '';
    public $no_voucher_message = false;
    public $items = [];
    public $total_credit = 0;
    public $total_debit = 0;
    public $total_difference = 0;
    public $rows_number = 1;

    protected function rules()
    {
        return [
            'items.*.account_id'    => 'required',
            'items.*.credit'        => 'required_without:items.*.debit|numeric|min:0|not_in:0',
            'items.*.debit'         => 'required_without:items.*.credit|numeric|min:0|not_in:0',
            'total_difference'      => 'required|numeric|in:0',
        ];
    }

    protected function messages()
    {
        return [
            'items.*.debit.required_without'    => "please fill 1 at least",
            'items.*.credit.required_without'   => "please fill 1 at least",
            'items.*.account_id.required'       => "choose account",
            'total_difference.in'               => 'Difference must be 0'
        ];
    }

    public function render()
    {
        return view('livewire.vouchers.voucher-form')->layout('layouts.livewire_app');
    }

    public function mount($type,$id = null)
    {
        $this->voucher_type = $type;
        $this->current_voucher = Voucher::find($id);
        $this->card_header = 'Journal Voucher';
        $this->action = $this->current_voucher ? 'edit' : 'create';
        $this->accounts = Account::query()
        ->with(['voucher_details', 'parent' => function ($q) {
            $q->with(['parent' => function ($q) {
                $q->with('parent');
            }]);
        }])
        ->where('level', 4)
        ->whereActive(true)
        ->orderBy('name')
        ->get();
        switch ($this->action) {
            case 'create':
                $this->placeholder = $this->card_header . ' No.';
                $this->date = date('Y-m-d');
                $this->items = [
                    ['account_id' => '', 'narration' => '', 'debit' => '', 'credit' => ''],
                    ['account_id' => '', 'narration' => '', 'debit' => '', 'credit' => '']
                ];
                break;
            case 'edit':
                $this->voucher_type = $this->current_voucher->voucher_type;
                $this->date = $this->current_voucher->voucher_date;
                foreach ($this->current_voucher->voucher_details as $row) {
                    $this->items[] = [
                        'account_id'        => $row->account_id,
                        'narration'         => $row->narration,
                        'debit'             => $row->debit == 0 ? '' : $row->debit,
                        'credit'            => $row->credit == 0 ? '' : $row->credit,
                    ];
                }
                $this->calculate_difference();
                break;
        }
    }

    public function copy_voucher()
    {
        $copied_voucher = Voucher::query()
            ->whereVoucherNo($this->copy_from)
            ->whereVoucherType($this->voucher_type)
            ->first();
        if ($copied_voucher) {
            $this->no_voucher_message = false;
            $this->items = [];
            foreach ($copied_voucher->voucher_details as $row) {
                $this->items[] = [
                    'account_id'        => $row->account_id,
                    'narration'         => $row->narration,
                    'debit'             => $row->debit == 0 ? '' : $row->debit,
                    'credit'            => $row->credit == 0 ? '' : $row->credit,
                ];
            }
            $this->dispatchBrowserEvent('add_row');
        } else {
            $this->no_voucher_message = true;
        }
        $this->calculate_difference();

    }

    public function updatedCopyFrom()
    {
        $this->no_voucher_message = false;
    }

    public function add_row()
    {
        for ($i = 1; $i <= $this->rows_number; $i++) {
            $this->items[] = ['account_id' => '', 'narration' => '', 'debit' => '', 'credit' => ''];
        }
        $this->dispatchBrowserEvent('add_row');
        $this->rows_number = 1;
        $this->calculate_difference();
    }

    public function delete_row($index)
    {
        unset($this->items[$index]);
        $this->items = array_values($this->items);
        $this->dispatchBrowserEvent('add_row');

        $this->calculate_difference();
    }
    public function duplicate_row($index)
    {
        $this->items[] = [
            'account_id'    => $this->items[$index]['account_id'],
            'narration'     => $this->items[$index]['narration'],
            'debit'         => $this->items[$index]['debit'],
            'credit'        => $this->items[$index]['credit']
        ];
        $this->dispatchBrowserEvent('add_row');
        $this->rows_number = 1;
        $this->calculate_difference();
    }

    public function updatedItems($value, $get_field)
    {
        $arr = explode('.', $get_field);
        $index = $arr[0];
        $changed_field = $arr[1];
        if ($changed_field == 'debit') {
            $this->items[$index]['credit'] = '';
        }
        if ($changed_field == 'credit') {
            $this->items[$index]['debit'] = '';
        }
        $this->calculate_difference();
        // if ($this->errorBag->count() != 0) {
        //     $this->validate($this->rules(), $this->messages());
        // }

        $this->dispatchBrowserEvent('add_row');

    }

    public function calculate_difference()
    {
        $this->total_debit = 0;
        $this->total_credit = 0;
        $this->total_difference = 0;
        foreach ($this->items as $key => $val) {
            $this->total_debit  = $this->total_debit    + floatval($val['debit']);
            $this->total_credit = $this->total_credit   + floatval($val['credit']);
        }
        $this->total_difference = round($this->total_debit, 3) - round($this->total_credit, 3);
    }

    public function save_voucher()
    {
        $this->calculate_difference();
        $this->dispatchBrowserEvent('add_row');
        $this->validate();
        switch ($this->action) {
            case 'create':
                $voucher_data = [
                    'voucher_no'    => Voucher::query()->where('voucher_type', $this->voucher_type)->max('voucher_no') + 1,
                    'voucher_type'  => $this->voucher_type,
                    'voucher_date'  => $this->date,
                    'created_by'    => auth()->id(),
                    'updated_by'    => auth()->id(),
                ];
                DB::beginTransaction();
                try {
                    $voucher = Voucher::create($voucher_data);
                    $voucher->voucher_details()->createMany($this->get_voucher_details_data());
                    DB::commit();
                    session()->flash('success', 'Voucher Added Successfully');
                    return redirect()->route('vouchers.index',$this->voucher_type);
                } catch (\Exception $e) {
                    DB::rollback();
                    dd($e);
                    return redirect()->back()->withInput();
                }
                break;

            case 'edit':
                $voucher_data = [
                    'voucher_date'  => $this->date,
                    'updated_by'    => auth()->id(),
                    'updated_at'    => now(),
                ];
                DB::beginTransaction();
                try {
                    $this->current_voucher->update($voucher_data);
                    $this->current_voucher->voucher_details()->delete();
                    $this->current_voucher->voucher_details()->createMany($this->get_voucher_details_data());
                    DB::commit();
                    session()->flash('success', 'Voucher Updated Successfully');
                    return redirect()->route('vouchers.index', $this->voucher_type);
                } catch (\Exception $e) {
                    DB::rollback();
                    dd($e);
                    return redirect()->back()->withInput();
                }
                break;
        }
    }

    public function get_voucher_details_data()
    {
        $voucher_details_data = [];
        foreach ($this->items as $item) {
            $voucher_details_data[] = [
                'account_id'        => $item['account_id'],
                'narration'         => $item['narration'],
                'debit'             => $item['debit'] == '' ? 0 : $item['debit'],
                'credit'            => $item['credit'] == '' ? 0 : $item['credit'],
            ];
        }

        return $voucher_details_data;
    }

    public function generate_opening_voucher()
    {
        if ($this->voucher_type == 'jv') {
            $this->items = [];

            foreach ($this->accounts as $account) {
                $this->items[] = ['account_id' => $account->id, 'narration' => '', 'debit' => '', 'credit' => ''];
            }
        }
        $this->dispatchBrowserEvent('add_row');
    }
}
