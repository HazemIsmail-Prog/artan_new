<?php

namespace App\Http\Controllers\Financial\Reports;

use App\Exports\BankBookExport;
use App\Helpers\Helper;
use App\Http\Controllers\Controller;
use App\Models\Account;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;
use Barryvdh\DomPDF\Facade\Pdf as PDF;
use Maatwebsite\Excel\Facades\Excel;

class BankBookController extends Controller
{
    public function index()
    {
        $accounts_list = Account::query()->doesnthave('childs')->whereUsage('bank')->orderBy('name')->get();
        return view('pages.financial.reports.bank_book.index', compact('accounts_list'));
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
        $page_title = 'Bank Book';
        $accounts = Helper::GetBankBookReportData($request);
        switch ($request->action) {
            case 'pdf':
                $pdf = PDF::loadView('pages.financial.reports.bank_book.pdf', compact('accounts', 'page_title'));
                $pdf->setPaper('a4', 'portrait'); // [landscape, portrait]
                return $pdf->stream($page_title . '.pdf');
                break;
            case 'excel':
                return Excel::download(new BankBookExport($accounts), $page_title . '.xlsx');  //Excel
                break;
        }
    }
}
