<?php

namespace App\Http\Controllers\Financial\Reports;

use App\Exports\AccountStatementExport;
use App\Helpers\Helper;
use App\Http\Controllers\Controller;
use App\Models\Account;
use Illuminate\Http\Request;
use Maatwebsite\Excel\Facades\Excel;
use Illuminate\Support\Facades\Validator;
use Barryvdh\DomPDF\Facade\Pdf as PDF;

class AccountStatementController extends Controller
{
    public function index(Request $request)
    {
        $accounts_list = Account::query()->doesnthave('childs')->orderBy('name')->get();
        return view('pages.financial.reports.account_statement.index', compact('accounts_list'));
    }

    public function export(Request $request)
    {
        $validator = Validator::make(
            request()->all(),
            [
                'start' => 'required',
                'end' => 'required',
                'accounts_list' => 'required',
            ]
        );
        $validator->validate();
        $page_title = 'Account Statement';
        $accounts = Helper::GetAccountStatementReportData($request);
        switch ($request->action) {
            case 'pdf':
                $pdf = PDF::loadView('pages.financial.reports.account_statement.pdf', compact('accounts', 'page_title'));
                $pdf->setPaper('a4', 'portrait'); // [landscape, portrait]
                return $pdf->stream($page_title . '.pdf');
                break;
            case 'excel':
                return Excel::download(new AccountStatementExport($accounts), $page_title . '.xlsx');  //Excel
                break;
        }
    }
}
