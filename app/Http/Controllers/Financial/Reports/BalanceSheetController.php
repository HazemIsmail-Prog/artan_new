<?php

namespace App\Http\Controllers\Financial\Reports;

use App\Exports\BalanceSheetExport;
use App\Http\Controllers\Controller;
use App\Models\Account;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Validator;
use Barryvdh\DomPDF\Facade\Pdf as PDF;
use Maatwebsite\Excel\Facades\Excel;

class BalanceSheetController extends Controller
{
    public function index()
    {
        return view('pages.financial.reports.balance_sheet.index');
    }

    public function export(Request $request)
    {
        $validator = Validator::make(request()->all(),
            [
                'start' => 'required',
                'end' => 'required',
            ]);
        $validator->validate();

        $page_title = 'Balance Sheet';


        $assets_parent_account_id = Account::query()->whereUsage('assets')->first()->id;
        $liabilities_parent_account_id = Account::query()->whereUsage('liabilities')->first()->id;
        $equity_parent_account_account_id = Account::query()->whereUsage('equity')->first()->id;
        $income_parent_account_id = Account::query()->whereUsage('income')->first()->id;
        $expenses_parent_account_id = Account::query()->whereUsage('expenses')->first()->id;



        $income_total = Account::query()
        ->whereLevel(4)
        ->with('parent')
        ->withCount(['voucher_details as total' => function ($q7) use ($request) {
            $q7->select(DB::raw('SUM(credit) - SUM(debit)'));
            $q7->whereHas('voucher', function ($q8) use ($request) {
                $q8->where('voucher_date', '<=', $request->end);
            });
        }])
        ->get()->where('root_account.id',$income_parent_account_id);

        $expenses_total = Account::query()
        ->whereLevel(4)
        ->with('parent')
        ->withCount(['voucher_details as total' => function ($q7) use ($request) {
            $q7->select(DB::raw('SUM(credit) - SUM(debit)'));
            $q7->whereHas('voucher', function ($q8) use ($request) {
                $q8->where('voucher_date', '<=', $request->end);
            });
        }])
        ->get()->where('root_account.id',$expenses_parent_account_id);

         $profit = $income_total->sum('total') + $expenses_total->sum('total');

         $assets_groups = Account::
         query()
             ->whereHas('childs', function ($q1) use ($request) {
                 $q1->whereHas('voucher_details', function ($q) use ($request) {
                     $q->whereHas('voucher', function ($q8) use ($request) {
                         $q8->where('voucher_date', '<=', $request->end);
                     });
                 });
             })
             ->with(['parent','childs' => function ($q4) use ($request) {
                 $q4->whereHas('voucher_details');
                 $q4->withCount(['voucher_details as total' => function ($q7) use ($request) {
                     $q7->select(DB::raw('SUM(debit) - SUM(credit)'));
                     $q7->whereHas('voucher', function ($q8) use ($request) {
                         $q8->where('voucher_date', '<=', $request->end);
                     });
                 }]);
             }])->get()->where('root_account.id',$assets_parent_account_id);

             $liabilities_groups = Account::
             query()
                 ->whereHas('childs', function ($q1) use ($request) {
                     $q1->whereHas('voucher_details', function ($q) use ($request) {
                         $q->whereHas('voucher', function ($q8) use ($request) {
                             $q8->where('voucher_date', '<=', $request->end);
                         });
                     });
                 })
                 ->with(['parent','childs' => function ($q4) use ($request) {
                     $q4->whereHas('voucher_details');
                     $q4->withCount(['voucher_details as total' => function ($q7) use ($request) {
                         $q7->select(DB::raw('SUM(credit) - SUM(debit)'));
                         $q7->whereHas('voucher', function ($q8) use ($request) {
                             $q8->where('voucher_date', '<=', $request->end);
                         });
                     }]);
                 }])->get()->where('root_account.id',$liabilities_parent_account_id);

            $equity_group = Account::
            query()
                ->whereHas('childs', function ($q1) use ($request) {
                    $q1->whereHas('voucher_details', function ($q) use ($request) {
                        $q->whereHas('voucher', function ($q8) use ($request) {
                            $q8->where('voucher_date', '<=', $request->end);
                        });
                    });
                })
                ->with(['parent','childs' => function ($q4) use ($request) {
                    $q4->whereHas('voucher_details');
                    $q4->withCount(['voucher_details as total' => function ($q7) use ($request) {
                        $q7->select(DB::raw('SUM(credit) - SUM(debit)'));
                        $q7->whereHas('voucher', function ($q8) use ($request) {
                            $q8->where('voucher_date', '<=', $request->end);
                        });
                    }]);
                }])->get()->where('root_account.id',$equity_parent_account_account_id);




                switch ($request->action) {
                    case 'pdf':
                        $pdf = PDF::loadView('pages.financial.reports.balance_sheet.pdf', compact('assets_groups', 'liabilities_groups', 'equity_group','profit','page_title'));
                        $pdf->setPaper('a4', 'portrait'); // [landscape, portrait]
                        return $pdf->stream($page_title . '.pdf');
                        break;
                    case 'excel':
                        return Excel::download(new BalanceSheetExport($assets_groups, $liabilities_groups, $equity_group, $profit, $page_title), $page_title . '.xlsx');  //Excel
                        break;
                }
    }
}
