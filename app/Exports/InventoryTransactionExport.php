<?php

namespace App\Exports;

use App\Models\InventoryTransactionLog;
use Maatwebsite\Excel\Concerns\FromCollection;
use Maatwebsite\Excel\Concerns\WithHeadings;
use Maatwebsite\Excel\Concerns\WithMapping;
use Maatwebsite\Excel\Concerns\WithStyles;
use Maatwebsite\Excel\Concerns\WithColumnWidths;
use PhpOffice\PhpSpreadsheet\Worksheet\Worksheet;
use PhpOffice\PhpSpreadsheet\Style\Fill;
use PhpOffice\PhpSpreadsheet\Style\Alignment;
use Carbon\Carbon;

class InventoryTransactionExport implements FromCollection, WithHeadings, WithMapping, WithStyles, WithColumnWidths
{
    protected $startDate;
    protected $endDate;
    protected $transactionTypeId;
    protected $inventoryTypeId;
    protected $productId;
    protected $subProductId;
    protected $performedById;

    public function __construct(
        $startDate = null,
        $endDate = null,
        $transactionTypeId = null,
        $inventoryTypeId = null,
        $productId = null,
        $subProductId = null,
        $performedById = null
    )
    {
        $this->startDate = $startDate;
        $this->endDate = $endDate;
        $this->transactionTypeId = $transactionTypeId;
        $this->inventoryTypeId = $inventoryTypeId;
        $this->productId = $productId;
        $this->subProductId = $subProductId;
        $this->performedById = $performedById;
    }

    /**
     * @return \Illuminate\Support\Collection
     */
    public function collection()
    {
        $query = InventoryTransactionLog::with([
            'transactionType',
            'product',
            'subProduct',
            'inventoryType',
            'colorMaster',
            'size',
            'performedBy'
        ])
        ->orderBy('created_at', 'desc');

        // Apply date filter
        if ($this->startDate && $this->endDate) {
            $start = Carbon::parse($this->startDate)->startOfDay();
            $end = Carbon::parse($this->endDate)->endOfDay();
            $query->whereBetween('created_at', [$start, $end]);
        }

        // Apply additional filters
        if ($this->transactionTypeId) {
            $query->where('transaction_type_id', $this->transactionTypeId);
        }

        if ($this->inventoryTypeId) {
            $query->where('inventory_type_id', $this->inventoryTypeId);
        }

        if ($this->productId) {
            $query->where('product_id', $this->productId);
        }

        if ($this->subProductId) {
            $query->where('sub_product_id', $this->subProductId);
        }

        if ($this->performedById) {
            $query->where('performed_by', $this->performedById);
        }

        return $query->get();
    }

    /**
     * @return array
     */
    public function headings(): array
    {
        return [
            'Transaction Date',
            'Transaction Type',
            'Ref Type',
            'Ref ID',
            'Product',
            'Sub Product',
            'Inventory Type',
            'Color Master',
            'Size',
            'Stock Before',
            'Stock After',
            'Quantity Change',
            'Unit Price ($)',
            'Performed By',
            'Note'
        ];
    }

    /**
     * @param mixed $transaction
     * @return array
     */
    public function map($transaction): array
    {
        $transactionDate = Carbon::parse($transaction->created_at)->format('Y-m-d H:i:s');
        $transactionType = $transaction->transactionType ? $transaction->transactionType->name : '-';
        $refType = $transaction->reference_type ?? '-';
        $refId = $transaction->reference_id ? '#' . $transaction->reference_id : '-';

        $product = '-';
        if ($transaction->product) {
            $product = $transaction->product->product_name ?? '-';
        }

        $subProduct = '-';
        if ($transaction->subProduct) {
            $subProduct = $transaction->subProduct->product_name ?? '-';
        }

        $inventoryType = $transaction->inventoryType ? $transaction->inventoryType->name : '-';

        $colorMaster = '-';
        if ($transaction->colorMaster) {
            $colorMaster = $transaction->colorMaster->pantone_code ?? '-';
        }

        $size = '-';
        if ($transaction->size) {
            $size = $transaction->size->name ?? $transaction->size->size_name ?? '-';
        }

        $stockBefore = $transaction->qty_before ?? 0;
        $stockAfter = $transaction->qty_after ?? 0;
        $qtyChange = $transaction->qty_change ?? 0;
        $unitPrice = number_format($transaction->unit_price ?? 0, 2, '.', '');

        $performedBy = '-';
        if ($transaction->performedBy) {
            $performedBy = $transaction->performedBy->name ?? '-';
        }

        $note = $transaction->note ?? '-';

        return [
            $transactionDate,
            $transactionType,
            $refType,
            $refId,
            $product,
            $subProduct,
            $inventoryType,
            $colorMaster,
            $size,
            $stockBefore,
            $stockAfter,
            $qtyChange,
            $unitPrice,
            $performedBy,
            $note
        ];
    }

    /**
     * @param Worksheet $sheet
     * @return array
     */
    public function styles(Worksheet $sheet)
    {
        return [
            // Style the first row as bold text with background color
            1 => [
                'font' => ['bold' => true, 'color' => ['rgb' => 'FFFFFF']],
                'fill' => [
                    'fillType' => Fill::FILL_SOLID,
                    'startColor' => ['rgb' => '333F48']
                ],
                'alignment' => [
                    'horizontal' => Alignment::HORIZONTAL_CENTER,
                    'vertical' => Alignment::VERTICAL_CENTER
                ]
            ],
        ];
    }

    /**
     * @return array
     */
    public function columnWidths(): array
    {
        return [
            'A' => 20, // Transaction Date
            'B' => 20, // Transaction Type
            'C' => 15, // Ref Type
            'D' => 12, // Ref ID
            'E' => 25, // Product
            'F' => 25, // Sub Product
            'G' => 18, // Inventory Type
            'H' => 15, // Color Master
            'I' => 12, // Size
            'J' => 15, // Stock Before
            'K' => 15, // Stock After
            'L' => 18, // Quantity Change
            'M' => 15, // Unit Price
            'N' => 20, // Performed By
            'O' => 30, // Note
        ];
    }
}

