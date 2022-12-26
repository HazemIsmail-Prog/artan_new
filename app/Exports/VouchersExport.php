<?php

namespace App\Exports;

use App\Models\Voucher;
use Maatwebsite\Excel\Concerns\FromView;
use Illuminate\Contracts\View\View;
use Maatwebsite\Excel\Concerns\ShouldAutoSize;
use Maatwebsite\Excel\Concerns\WithStyles;
use Maatwebsite\Excel\Concerns\WithTitle;
use PhpOffice\PhpSpreadsheet\Worksheet\Worksheet;

class VouchersExport implements FromView, WithTitle, ShouldAutoSize, WithStyles
{
    protected $type;
    protected $file_name;
    protected $vouchers;

    function __construct($vouchers,$type,$file_name)
    {
        $this->type = $type;
        $this->file_name = $file_name;
        $this->vouchers = $vouchers;

    }
    
    public function view(): View
    {

        return view('livewire.vouchers._excel', ['vouchers' => $this->vouchers]);
    }

    public function title(): string
    {
        return $this->file_name;
    }

    public function styles(Worksheet $sheet)
    {
        return [
            // Style the first row as bold text.
            1    => ['font' => ['bold' => true]],

            // Styling a specific cell by coordinate.
            // 'B2' => ['font' => ['italic' => true]],

            // Styling an entire column.
            // 'C'  => ['font' => ['size' => 16]],
        ];
    }
}
