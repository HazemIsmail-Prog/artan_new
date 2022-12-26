<?php

namespace App\Exports;

use Illuminate\Contracts\View\View;
use Maatwebsite\Excel\Concerns\FromView;
use Maatwebsite\Excel\Concerns\ShouldAutoSize;
use Maatwebsite\Excel\Concerns\WithColumnWidths;
use Maatwebsite\Excel\Concerns\WithStyles;
use Maatwebsite\Excel\Concerns\WithTitle;
use PhpOffice\PhpSpreadsheet\Worksheet\Worksheet;

class ProfitLossExport implements FromView, WithTitle, ShouldAutoSize, WithStyles, WithColumnWidths
{
    protected $income_groups, $expenses_groups, $page_title;

    function __construct($income_groups, $expenses_groups, $page_title)
    {
        $this->income_groups =           $income_groups;
        $this->expenses_groups =      $expenses_groups;
        $this->page_title =              $page_title;
    }
    public function view(): View
    {

        return view('pages.financial.reports.profit_loss.excel', [
            'income_groups' => $this->income_groups,
            'expenses_groups' => $this->expenses_groups,
            'page_title' => $this->page_title,
        ]);
    }

    public function title(): string
    {
        return $this->page_title;
    }

    public function styles(Worksheet $sheet)
    {
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
            'A' => 12,
            'B' => 25,
            'C' => 24,
            'D' => 24,
            'E' => 15,
        ];
    }
}
