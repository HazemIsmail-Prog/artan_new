<?php

namespace App\Observers;

use App\Models\Order;
use App\Models\Voucher;
use Illuminate\Support\Facades\DB;

class OrderObserver
{

    /**
     * Handle the Order "created" event.
     *
     * @param  \App\Models\Order  $order
     * @return void
     */
    public function creating(Order $order)
    {
        $order->user_id = auth()->id() ?? 2;
        $order->vehicle_id  = 1;
    }

    /**
     * Handle the Order "created" event.
     *
     * @param  \App\Models\Order  $order
     * @return void
     */
    public function created(Order $order)
    {
        $sales_account_id = 311001;
        $customr_receivable_account_id = 521008;
        $voucher_data = [
            'order_id' => $order->id,
            'voucher_no'    => Voucher::query()->where('voucher_type', 'ov')->max('voucher_no') + 1,
            'voucher_type'  => 'ov',
            'voucher_date'  => today(),
            'created_by'    => auth()->id() ?? 2,
            'updated_by'    => auth()->id() ?? 2,
        ];
        $voucher_details_data = [
            [
                'account_id'        => $customr_receivable_account_id,
                'narration'         => $order->c_name,
                'debit'             => $order->amount,
                'credit'            => 0,
            ],
            [
                'account_id'        => $sales_account_id,
                'narration'         => 'Sales',
                'debit'             => 0,
                'credit'            => $order->amount,
            ],
        ];

        DB::beginTransaction();
        try {
            $voucher = Voucher::create($voucher_data);
            $voucher->voucher_details()->createMany($voucher_details_data);
            DB::commit();
        } catch (\Exception $e) {
            DB::rollback();
            dd($e);
        }
    }

    /**
     * Handle the Order "updated" event.
     *
     * @param  \App\Models\Order  $order
     * @return void
     */
    public function updated(Order $order)
    {
        $order->first_voucher->voucher_details[0]->update([
            'narration' => $order->c_name,
            'debit' => $order->amount,
        ]);
        $order->first_voucher->voucher_details[1]->update([
            'credit' => $order->amount,
        ]);
    }

    /**
     * Handle the Order "deleted" event.
     *
     * @param  \App\Models\Order  $order
     * @return void
     */
    public function deleted(Order $order)
    {
        $order->vouchers()->delete();
    }

    /**
     * Handle the Order "restored" event.
     *
     * @param  \App\Models\Order  $order
     * @return void
     */
    public function restored(Order $order)
    {
        //
    }

    /**
     * Handle the Order "force deleted" event.
     *
     * @param  \App\Models\Order  $order
     * @return void
     */
    public function forceDeleted(Order $order)
    {
        //
    }
}
