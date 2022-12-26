<?php

namespace Database\Seeders;

use App\Models\Voucher;
use Illuminate\Database\Seeder;

class VoucherSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {

        Voucher::create([
            'voucher_no' => 1,
            'voucher_type' => 'jv',
            'voucher_date' => '2022-01-13',
            'created_by' => 1,
            'updated_by' => 1,
        ]);
    }
}
