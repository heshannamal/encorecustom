<?php

namespace App\Exports;


use Illuminate\Contracts\View\View;
use Maatwebsite\Excel\Concerns\FromView;
use Maatwebsite\Excel\Concerns\ShouldAutoSize;
use Maatwebsite\Excel\Concerns\WithStyles;
use PhpOffice\PhpSpreadsheet\Worksheet\Worksheet;
use Maatwebsite\Excel\Concerns\WithColumnWidths;
use Maatwebsite\Excel\Concerns\WithEvents;
use Maatwebsite\Excel\Events\AfterSheet;
use PhpOffice\PhpSpreadsheet\Style\NumberFormat;

class PosReportExport implements FromView, ShouldAutoSize, WithStyles, WithColumnWidths
{
    protected $orders;
    protected $summary;

    public function __construct($orders, $summary)
    {
        $this->orders = $orders;
        $this->summary = $summary;
    }

    public function view(): View
    {
        return view('pages.pos.reports.download.pos_report_excel', [
            'orders' => $this->orders,
            'summary' => $this->summary
        ]);
    }

    // OPTIONAL: Better spacing + readable columns
    public function styles(Worksheet $sheet)
    {
        return [
            1  => ['font' => ['bold' => true, 'size' => 14]],
        ];
    }

    public function columnWidths(): array
    {
        return [
            'A' => 35,  // Order #
            'B' => 15,  // Date
            'C' => 12,  // Payment
            'D' => 10,
            'E' => 10,  // Size
            'F' => 12,  // Color
            'G' => 8,   // Qty
            'H' => 15,  // Unit Price
            'I' => 15,  // Line Total
            'J' => 12,  // Other Fee
            'K' => 12,  // Discount
            'L' => 15,  // Total
        ];
    }

    public function registerEvents(): array
    {
        return [
            AfterSheet::class => function (AfterSheet $event) {

                // ONLY B9 cell format
                $event->sheet->getDelegate()
                    ->getStyle('B9')
                    ->getNumberFormat()
                    ->setFormatCode(NumberFormat::FORMAT_NUMBER_00);

            },
        ];
    }
}
