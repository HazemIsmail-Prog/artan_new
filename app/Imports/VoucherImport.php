<?php

namespace App\Imports;

use App\Models\VoucherDetail;
use Illuminate\Support\Facades\Session;
use Maatwebsite\Excel\Concerns\ToModel;
use Maatwebsite\Excel\Concerns\withHeadingRow;

class VoucherImport implements ToModel, withHeadingRow
{

    protected $voucher_id;

    public function __construct($voucher_id)
    {
        $this->voucher_id = $voucher_id;
    }

    public function model(array $row)
    {
        return new VoucherDetail([
            'voucher_id'    => $this->voucher_id,
            'account_id'    =>$row['account_id'],
            'narration'     =>$row['narration'],
            'debit'         =>$row['debit'],
            'credit'        =>$row['credit'],
         ]);
    }
}
