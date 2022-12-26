<?php

namespace App\Http\Livewire\Accounts;

use App\Models\Account;
use Livewire\Component;

class AccountsIndex extends Component
{
    public $account;

    public function showAccountModal($account = null, $parent = null)
    {
        $this->resetValidation();
        if (!$account) {
            $account['active'] = 1;
        }
        if ($parent) {
            $account['account_id'] = $parent;
        }
        $this->account = $account;
    }

    public function save_account()
    {
        if (isset($this->account['id'])) {
            //edit
            $this->validate([
                'account.name' => ['required'],
                'account.usage' => ['nullable'],
                'account.account_id' => ['nullable'],
                'account.active' => ['nullable'],
            ]);
            $currentAccount = Account::find($this->account['id']);
            $currentAccount->update([
                'name' => $this->account['name'],
                'usage' => $this->account['usage'],
                'account_id' => $this->account['account_id'],
                'active' => $this->account['active'],
            ]);
        } else {
            //create
            $this->validate([
                'account.name' => ['required'],
                'account.usage' => ['nullable'],
                'account.account_id' => ['required'],
                'account.active' => ['nullable'],
            ]);
            $parent = Account::findOrFail($this->account['account_id']);
            $this->account['level'] = $parent->level + 1;
            Account::create($this->account);
        }
        $this->reset('account');
        $this->dispatchBrowserEvent('hide-form');
    }

    public function delete_account(Account $account)
    {
        $account->delete();
    }

    public function render()
    {
        $accounts = Account::query()
            ->with(['childs'])
            ->where('level','!=',4)
            ->get();
        return view('livewire.accounts.accounts-index',[
            'accounts' => $accounts,
        ])->layout('layouts.livewire_app');
    }
}
