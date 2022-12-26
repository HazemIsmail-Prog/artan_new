<?php

namespace App\Exports;

use Illuminate\Contracts\View\View;
use Maatwebsite\Excel\Concerns\FromView;
use Maatwebsite\Excel\Concerns\ShouldAutoSize;
use Maatwebsite\Excel\Concerns\WithColumnWidths;
use Maatwebsite\Excel\Concerns\WithStyles;
use Maatwebsite\Excel\Concerns\WithTitle;
use PhpOffice\PhpSpreadsheet\Worksheet\Worksheet;

class TrialBalanceExport implements FromView, WithTitle, ShouldAutoSize, WithStyles, WithColumnWidths
{
    protected $accounts;

    function __construct($groups)
    {
        $this->groups = $groups;
    }
    public function view(): View
    {
        return view('pages.financial.reports.trial_balance.excel', ['groups' => $this->groups]);
    }

    public function title(): string
    {
        return 'Trial Balance';
    }

    public function styles(Worksheet $sheet)
    {
        return [
            // Style the first row as bold text.
            1    => ['font' => ['bold' => true]],
            2    => ['font' => ['bold' => true]],

            // Styling a specific cell by coordinate.
            // 'B2' => ['font' => ['italic' => true]],

            // Styling an entire column.
            // 'C'  => ['font' => ['size' => 16]],
 
        ];
    }

    public function columnWidths(): array
    {
        return [
            'B' => 16,
            'C' => 16,
            'D' => 16,
            'E' => 16,
            'F' => 16,
            'G' => 16,
        ];
    }
}
