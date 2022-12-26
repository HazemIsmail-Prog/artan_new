<?php

namespace App\Exports;

use Illuminate\Contracts\View\View;
use Maatwebsite\Excel\Concerns\FromView;
use Maatwebsite\Excel\Concerns\ShouldAutoSize;
use Maatwebsite\Excel\Concerns\WithColumnWidths;
use Maatwebsite\Excel\Concerns\WithStyles;
use Maatwebsite\Excel\Concerns\WithTitle;
use PhpOffice\PhpSpreadsheet\Worksheet\Worksheet;

class BalanceSheetExport implements FromView, WithTitle, ShouldAutoSize, WithStyles, WithColumnWidths
{
    protected $assets_groups, $liabilities_groups, $equity_group, $profit, $page_title;

    function __construct($assets_groups, $liabilities_groups, $equity_group, $profit, $page_title)
    {
        $this->assets_groups =           $assets_groups;
        $this->liabilities_groups =      $liabilities_groups;
        $this->equity_group =            $equity_group;
        $this->profit =                  $profit;
        $this->page_title =              $page_title;
    }
    public function view(): View
    {

        return view('pages.financial.reports.balance_sheet.excel', [
            'assets_groups' => $this->assets_groups,
            'liabilities_groups' => $this->liabilities_groups,
            'equity_group' => $this->equity_group,
            'profit' => $this->profit,
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
