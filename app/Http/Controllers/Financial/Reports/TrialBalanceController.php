<?php

namespace App\Http\Controllers\Financial\Reports;

use App\Exports\TrialBalanceExport;
use App\Helpers\Helper;
use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;
use Barryvdh\DomPDF\Facade\Pdf as PDF;
use Maatwebsite\Excel\Facades\Excel;


class TrialBalanceController extends Controller
{
    public function index()
    {
        return view('pages.financial.reports.trial_balance.index');
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
        $page_title = 'Trial Balance';
        $groups = Helper::GetTrialBalanceReportData($request);
        switch ($request->action) {
            case 'pdf':
                $pdf = PDF::loadView('pages.financial.reports.trial_balance.pdf', compact('groups', 'page_title'));
                $pdf->setPaper('a4', 'landscape'); // [landscape, portrait]
                return $pdf->stream($page_title . '.pdf');
                break;
            case 'excel':
                return Excel::download(new TrialBalanceExport($groups), $page_title . '.xlsx');  //Excel
                break;
        }
    }
}
