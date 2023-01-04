<?php

namespace App\Observers;

use App\Models\Payment;
use App\Models\Voucher;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Log;

class PaymentObserver
{
    /**
     * Handle the Payment "created" event.
     *
     * @param  \App\Models\Payment  $payment
     * @return void
     */
    public function creating(Payment $payment)
    {
        $payment->user_id = auth()->id() ?? 2;
    }

    /**
     * Handle the Payment "created" event.
     *
     * @param  \App\Models\Payment  $payment
     * @return void
     */
    public function created(Payment $payment)
    {
        $voucher_data = [
            'order_id' => $payment->order_id,
            'payment_id' => $payment->id,
            'voucher_no'    => Voucher::query()->where('voucher_type', 'ov')->max('voucher_no') + 1,
            'voucher_type'  => 'ov',
            'voucher_date'  => today(),
            'created_by'    => auth()->id(),
            'updated_by'    => auth()->id(),
        ];

        DB::beginTransaction();
        try {
            $voucher = Voucher::create($voucher_data);
            $voucher->voucher_details()->createMany($this->getVoucherDetails($payment));
            DB::commit();
        } catch (\Exception $e) {
            DB::rollback();
            dd($e);
        }
    }

    /**
     * Handle the Payment "updated" event.
     *
     * @param  \App\Models\Payment  $payment
     * @return void
     */
    public function updated(Payment $payment)
    {
        $voucher = $payment->voucher;
        $voucher->voucher_details()->delete();
        $voucher->voucher_details()->createMany($this->getVoucherDetails($payment));
    }

    /**
     * Handle the Payment "deleted" event.
     *
     * @param  \App\Models\Payment  $payment
     * @return void
     */
    public function deleted(Payment $payment)
    {
        //
    }

    /**
     * Handle the Payment "restored" event.
     *
     * @param  \App\Models\Payment  $payment
     * @return void
     */
    public function restored(Payment $payment)
    {
        //
    }

    /**
     * Handle the Payment "force deleted" event.
     *
     * @param  \App\Models\Payment  $payment
     * @return void
     */
    public function forceDeleted(Payment $payment)
    {
        //
    }

    public function getVoucherDetails($payment)
    {
        $cash_account_id = 111027;
        $customr_receivable_account_id = 521008;
        $knet_account_id = 113002;
        $bank_charges_account_id = 424001;
        $knet_ratio = 0.0025;

        switch ($payment->type) {
            case 'cash':
                $voucher_details_data = [
                    [
                        'account_id'        => $cash_account_id,
                        'narration'         => 'Cash Payment',
                        'debit'             => $payment->amount,
                        'credit'            => 0,
                    ],
                    [
                        'account_id'        => $customr_receivable_account_id,
                        'narration'         => 'Cash Sales',
                        'debit'             => 0,
                        'credit'            => $payment->amount,
                    ],
                ];
                break;
            case 'knet':
                $voucher_details_data = [
                    [
                        'account_id'        => $knet_account_id,
                        'narration'         => 'Knet Payment',
                        'debit'             => $payment->amount - ($payment->amount * $knet_ratio),
                        'credit'            => 0,
                    ],
                    [
                        'account_id'        => $bank_charges_account_id,
                        'narration'         => 'Knet Bank Charges',
                        'debit'             => $payment->amount * $knet_ratio,
                        'credit'            => 0,
                    ],
                    [
                        'account_id'        => $customr_receivable_account_id,
                        'narration'         => 'Knet Sales',
                        'debit'             => 0,
                        'credit'            => $payment->amount,
                    ],
                ];
                break;
        }

        return $voucher_details_data;
    }
}
