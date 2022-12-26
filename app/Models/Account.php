<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\Session;

class Account extends Model
{
    use HasFactory;

    protected $guarded = [];

    // protected $with = ['childs'];
    protected $append = ['root_account', 'type', 'balance'];

    public function parent()
    {
        return $this->belongsTo(Account::class, 'account_id')->with('parent');
    }

    public function childs()
    {
        return $this->hasMany(Account::class)->with('childs', 'parent');
    }

    public function voucher_details()
    {
        return $this->hasMany(VoucherDetail::class, 'account_id');
    }

    public function getRootAccountAttribute()
    {
        switch ($this->level) {
            case 1:
                return $this;
                break;
            case 2:
            case 3:
            case 4:
                return $this->parent->root_account;
                break;
        }
    }

    public function getBalanceAttribute()
    {
        $debit = $this->voucher_details->sum('debit');
        $credit = $this->voucher_details->sum('credit');

        switch ($this->type) {
            case 'Debit':
                $balance = $debit - $credit;
                break;
            case 'Credit':
                $balance = $credit - $debit;
                break;
        }
        return $balance;
    }

    public function getTypeAttribute()
    {
        switch ($this->level) {
            case 1:
                switch ($this->usage) {
                    case 'assets':
                    case 'liabilities':
                    case 'expenses':
                        return 'Debit';
                        break;
                    case 'income':
                    case 'equity':
                        return 'Credit';
                        break;
                }
                break;
            case 2:
            case 3:
            case 4:
                return $this->root_account->type;
                break;
        }
    }
}
