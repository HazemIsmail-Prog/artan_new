<?php

namespace App\Exports;

use Illuminate\Contracts\View\View;
use Maatwebsite\Excel\Concerns\FromView;
use Maatwebsite\Excel\Concerns\ShouldAutoSize;
use Maatwebsite\Excel\Concerns\WithColumnWidths;
use Maatwebsite\Excel\Concerns\WithStyles;
use Maatwebsite\Excel\Concerns\WithTitle;
use PhpOffice\PhpSpreadsheet\Worksheet\Worksheet;

class VoucherTemplateExport implements FromView, WithTitle, ShouldAutoSize, WithStyles, WithColumnWidths
{
    protected $accounts;
    
    function __construct($accounts)
    {
        $this->accounts = $accounts;
    }
    public function view() :View
    {
        return view('livewire.vouchers._template', ['accounts' => $this->accounts]);

    }

    public function title(): string
    {
        return 'Voucher Template';
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
            // 'C' => 10,
            // 'D' => 10,
            // 'E' => 10,
            // 'F' => 10,
            // 'G' => 10,

        ];
    }
}
