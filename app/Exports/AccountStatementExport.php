<?php

namespace App\Exports;

use Illuminate\Contracts\View\View;
use Maatwebsite\Excel\Concerns\FromView;
use Maatwebsite\Excel\Concerns\ShouldAutoSize;
use Maatwebsite\Excel\Concerns\WithColumnWidths;
use Maatwebsite\Excel\Concerns\WithStyles;
use Maatwebsite\Excel\Concerns\WithTitle;
use PhpOffice\PhpSpreadsheet\Worksheet\Worksheet;

class AccountStatementExport implements FromView, WithTitle, ShouldAutoSize, WithStyles, WithColumnWidths
{
    protected $accounts;
    
    function __construct($accounts)
    {
        $this->accounts = $accounts;
    }
    public function view() :View
    {
        return view('pages.financial.reports.account_statement.excel', ['accounts' => $this->accounts]);

    }

    public function title(): string
    {
        return 'Account Statement';
    }

    public function styles(Worksheet $sheet)
    {
        $sheet->setAutoFilter('A1:H1');
        return [
            // Style the first row as bold text.
            // 1    => ['font' => ['bold' => true]],
            // 2    => ['font' => ['bold' => true]],

            // Styling a specific cell by coordinate.
            // 'B2' => ['font' => ['italic' => true]],

            // Styling an entire column.
            // 'C'  => ['font' => ['size' => 16]],
 
        ];
    }

    public function columnWidths(): array
    {
        return [
            'E' => 16,
            'F' => 16,
            'G' => 16,
        ];
    }
}
