<?php

namespace App\Http\Controllers\Financial\Reports;

use App\Exports\AccountStatementExport;
use App\Helpers\Helper;
use App\Http\Controllers\Controller;
use App\Models\Account;
use Illuminate\Http\Request;
use Maatwebsite\Excel\Facades\Excel;
use Illuminate\Support\Facades\Validator;

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
                $mpdf = new \Mpdf\Mpdf([
                    // 'pagenumPrefix' => 'Page number ',
                    // 'pagenumSuffix' => ' - ',
                    'nbpgPrefix' => ' of ',
                    'nbpgSuffix' => ' pages',
                    'margin_top' => 25,
                    'margin_bottom' => 15,
                ]);

                $body = view('pages.financial.reports.account_statement.pdf.body', compact('accounts'));
                $header = view('pages.financial.reports.account_statement.pdf.header', compact('page_title'));
                $footer = view('pages.financial.reports.account_statement.pdf.footer');
                $mpdf->SetHTMLHeader($header);
                $mpdf->SetHTMLFooter($footer);
                
                ini_set("pcre.backtrack_limit", "5000000");

                $mpdf->WriteHTML($body); //should be before output directly
                $mpdf->Output();
                break;
            case 'excel':
                return Excel::download(new AccountStatementExport($accounts), $page_title . '.xlsx');  //Excel
                break;
        }
    }
}
