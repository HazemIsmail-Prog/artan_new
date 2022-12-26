<?php

namespace App\Http\Controllers\Financial\Reports;

use App\Exports\ProfitLossExport;
use App\Http\Controllers\Controller;
use App\Models\Account;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Validator;
use Barryvdh\DomPDF\Facade\Pdf as PDF;
use Maatwebsite\Excel\Facades\Excel;

class ProfitLossController extends Controller
{
    public function index()
    {
        return view('pages.financial.reports.profit_loss.index');
    }

    public function export(Request $request)
    {
        $validator = Validator::make(
            request()->all(),
            [
                'start' => 'required',
                'end' => 'required',
            ]
        );

        $validator->validate();

        $page_title = 'Profit - Loss';

        $income_parent_account_id = Account::query()->whereUsage('income')->first()->id;
        $expenses_parent_account_id = Account::query()->whereUsage('expenses')->first()->id;

        $income_groups = Account::query()
            ->whereHas('childs', function ($q1) {
                $q1->doesnthave('childs')->whereHas('voucher_details');
            })
            ->with(['parent','childs' => function ($q4) use ($request) {
                $q4->whereHas('voucher_details');
                $q4->withCount(['voucher_details as total' => function ($q7) use ($request) {
                    $q7->select(DB::raw('SUM(credit) - SUM(debit)'));
                    $q7->whereHas('voucher', function ($q8) use ($request) {
                        $q8->whereBetween('voucher_date', [$request->start, $request->end]);
                    });
                }]);
            }])->get()->where('root_account.id', $income_parent_account_id);

        $expenses_groups = Account::query()
            ->whereHas('childs', function ($q1) {
                $q1->doesnthave('childs')->whereHas('voucher_details');
            })
            ->with(['parent','childs' => function ($q4) use ($request) {
                $q4->whereHas('voucher_details');
                $q4->withCount(['voucher_details as total' => function ($q7) use ($request) {
                    $q7->select(DB::raw('SUM(debit) - SUM(credit)'));
                    $q7->whereHas('voucher', function ($q8) use ($request) {
                        $q8->whereBetween('voucher_date', [$request->start, $request->end]);
                    });
                }]);
            }])->get()->where('root_account.id', $expenses_parent_account_id);


            switch ($request->action) {
                case 'pdf':
                    $pdf = PDF::loadView('pages.financial.reports.profit_loss.pdf', compact('income_groups', 'expenses_groups','page_title'));
                    $pdf->setPaper('a4', 'portrait'); // [landscape, portrait]
                    return $pdf->stream($page_title . '.pdf');
                    break;
                case 'excel':

                    return Excel::download(new ProfitLossExport($income_groups, $expenses_groups, $page_title), $page_title . '.xlsx');  //Excel
                    break;
            }
    }
}
