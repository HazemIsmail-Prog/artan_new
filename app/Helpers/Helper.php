<?php

namespace App\Helpers;

use App\Models\Account;
use Illuminate\Support\Facades\DB;

class Helper
{
    // Financial Reports
    public static function GetAccountStatementReportData($request)
    {
        $accounts = Account::query()
            ->whereIn('id', $request->accounts_list)
            ->withCount(['voucher_details as opening_debit' => function ($q3) use ($request) {
                $q3->select(DB::raw('SUM(debit)'))
                    ->whereHas('voucher', function ($q4) use ($request) {
                        $q4->where('voucher_date', '<', $request->start);
                    });
            }])
            ->withCount(['voucher_details as opening_credit' => function ($q3) use ($request) {
                $q3->select(DB::raw('SUM(credit)'))
                    ->whereHas('voucher', function ($q4) use ($request) {
                        $q4->where('voucher_date', '<', $request->start);
                    });
            }])
            ->with(['voucher_details' => function ($q) use ($request) {
                $q->with('voucher')
                    ->whereHas('voucher', function ($q2) use ($request) {
                        $q2->whereBetween('voucher_date', [$request->start, $request->end]);
                    });
            }])
            ->whereHas('voucher_details' , function ($q) use ($request) {
                $q->whereHas('voucher', function ($q2) use ($request) {
                    $q2->whereBetween('voucher_date', [$request->start, $request->end]);
                });
            })
            ->get();
        return $accounts;
    }

    public static function GetBankBookReportData($request)
    {
        $accounts = Account::query()
            ->whereIn('id', $request->accounts_list)
            ->with(['voucher_details' => function ($q) use ($request) {
                $q->with('voucher');
                $q->whereHas('voucher', function ($q2) use ($request) {
                    $q2->whereIn('voucher_type', ['bp', 'br']);
                    $q2->whereBetween('voucher_date', [$request->start, $request->end]);
                });
                //this with count for sorting while using whereHas
                $q->withCount(['voucher as voucher_date' => function ($q) {
                    $q->select('voucher_date');
                }]);
                $q->orderBy('voucher_date');
            }])
            ->get();
        return $accounts;
    }

    public static function GetCashBookReportData($request)
    {
        $accounts = Account::query()
            ->whereIn('id', $request->accounts_list)
            ->with(['voucher_details' => function ($q) use ($request) {
                $q->with('voucher');
                $q->whereHas('voucher', function ($q2) use ($request) {
                    $q2->whereIn('voucher_type', ['cp', 'cr']);
                    $q2->whereBetween('voucher_date', [$request->start, $request->end]);
                });
                //this with count for sorting while using whereHas
                $q->withCount(['voucher as voucher_date' => function ($q) {
                    $q->select('voucher_date');
                }]);
                $q->orderBy('voucher_date');
            }])
            ->get();
        return $accounts;
    }

    public static function GetTrialBalanceReportData($request)
    {
        $groups = Account::query()
            ->whereHas('childs', function ($q1) {
                $q1->doesnthave('childs')->whereHas('voucher_details');
            })
            ->with(['childs' => function ($q4) use ($request) {
                $q4->whereHas('voucher_details')
                    ->withCount(['voucher_details as opening_debit' => function ($q7) use ($request) {
                        $q7->select(DB::raw('SUM(debit)'))
                            ->whereHas('voucher', function ($q8) use ($request) {
                                $q8->where('voucher_date', '<', $request->start);
                            });
                    }])
                    ->withCount(['voucher_details as opening_credit' => function ($q9) use ($request) {
                        $q9->select(DB::raw('SUM(credit)'))
                            ->whereHas('voucher', function ($q10) use ($request) {
                                $q10->where('voucher_date', '<', $request->start);
                            });
                    }])
                    ->withCount(['voucher_details as transaction_debit' => function ($q11) use ($request) {
                        $q11->select(DB::raw('SUM(debit)'))
                            ->whereHas('voucher', function ($q12) use ($request) {
                                $q12->whereBetween('voucher_date', [$request->start, $request->end]);
                            });
                    }])
                    ->withCount(['voucher_details as transaction_credit' => function ($q13) use ($request) {
                        $q13->select(DB::raw('SUM(credit)'))
                            ->whereHas('voucher', function ($q14) use ($request) {
                                $q14->whereBetween('voucher_date', [$request->start, $request->end]);
                            });
                    }]);
            }])->get();

        return $groups;
    }
}
