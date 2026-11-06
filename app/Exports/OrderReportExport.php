<?php

namespace App\Exports;

use App\Models\Order;
use App\Models\Product;
use App\Models\SubProduct;
use App\Models\User;
use Carbon\Carbon;
use Maatwebsite\Excel\Concerns\FromCollection;
use Maatwebsite\Excel\Concerns\WithHeadings;
use Maatwebsite\Excel\Concerns\WithMapping;
use Maatwebsite\Excel\Concerns\WithStyles;
use Maatwebsite\Excel\Concerns\WithColumnWidths;
use PhpOffice\PhpSpreadsheet\Worksheet\Worksheet;
use PhpOffice\PhpSpreadsheet\Style\Fill;
use PhpOffice\PhpSpreadsheet\Style\Alignment;

class OrderReportExport implements FromCollection, WithHeadings, WithMapping, WithStyles, WithColumnWidths
{
    protected $startDate;
    protected $endDate;
    // protected $customerId;
    protected $search;
    protected $salesChannelId;
    // protected $paymentStatus;
    protected $fulfillmentStatus;
    protected $shippingMethodId;
    protected $productId;
    protected $subProductId;

    public function __construct(
        $startDate = null,
        $endDate = null,
        // $customerId = null,
        $search = null,
        $salesChannelId = null,
        // $paymentStatus = null,
        $fulfillmentStatus = null,
        $shippingMethodId = null,
        $productId = null,
        $subProductId = null
    ) {
        $this->startDate = $startDate;
        $this->endDate = $endDate;
        // $this->customerId = $customerId;
        $this->search = $search;
        $this->salesChannelId = $salesChannelId;
        // $this->paymentStatus = $paymentStatus;
        $this->fulfillmentStatus = $fulfillmentStatus;
        $this->shippingMethodId = $shippingMethodId;
        // $this->productId = $productId;
        // $this->subProductId = $subProductId;
    }

    /**
     * Build a flattened collection of order + item rows for export.
     *
     * @return \Illuminate\Support\Collection
     */
    public function collection()
    {
        $query = Order::with([
            'userDetails',
            'shippingMethodDetail',
            'paymentMethodDetail',
            'inventoryType',
            'salesChannel',
            'orderItems.productDetail',
            'orderItems.subProductDetail',
            'orderItems.sizeDetail',
            'orderItems.colorDetail',
        ])->orderBy('created_at', 'desc');

        if ($this->startDate && $this->endDate) {
            $start = Carbon::parse($this->startDate)->startOfDay();
            $end = Carbon::parse($this->endDate)->endOfDay();
            $query->whereBetween('created_at', [$start, $end]);
        }

        if ($this->search) {
            $customerSrIds = User::where('name', 'like', '%' . $this->search . '%')
                ->orWhere('email', 'like', '%' . $this->search . '%')
                ->pluck('id');

            $productSrIds = Product::where('product_name', 'like', '%' . $this->search . '%')
                ->pluck('id');

            $subProductSrIds = SubProduct::where('product_name', 'like', '%' . $this->search . '%')
                ->pluck('id');

            $query->where(function ($q) use ($customerSrIds, $productSrIds, $subProductSrIds) {
                if ($customerSrIds) {
                    $q->orWhereIn('user_id', $customerSrIds);
                }
                if ($productSrIds) {
                    $q->orWhereHas('orderItems', function ($q) use ($productSrIds) {
                        $q->whereIn('product_id', $productSrIds);
                    });
                }
                if ($subProductSrIds) {
                    $q->orWhereHas('orderItems', function ($q) use ($subProductSrIds) {
                        $q->whereIn('sub_product_id', $subProductSrIds);
                    });
                }
            });
        }

        if ($this->salesChannelId) {
            $query->where('sales_channel_id', $this->salesChannelId);
        }

        // if ($this->paymentStatus !== null && $this->paymentStatus !== '') {
        //     $query->where('payment_status', (int) $this->paymentStatus);
        // }

        if ($this->fulfillmentStatus !== null && $this->fulfillmentStatus !== '') {
            $query->where('fulfillment_status', (int) $this->fulfillmentStatus);
        }

        if ($this->shippingMethodId) {
            $query->where('shipping_method_id', $this->shippingMethodId);
        }

        // if ($this->productId) {
        //     $query->whereHas('orderItems', function ($q) {
        //         $q->where('product_id', $this->productId);
        //     });
        // }

        // if ($this->subProductId) {
        //     $query->whereHas('orderItems', function ($q) {
        //         $q->where('sub_product_id', $this->subProductId);
        //     });
        // }

        $orders = $query->get();

        $rows = collect();

        foreach ($orders as $order) {
            // If the order has items, create one row per item
            if ($order->orderItems && $order->orderItems->count() > 0) {
                foreach ($order->orderItems as $item) {
                    $rows->push((object) [
                        'order' => $order,
                        'item'  => $item,
                    ]);
                }
            } else {
                // Otherwise create a single row with no item details
                $rows->push((object) [
                    'order' => $order,
                    'item'  => null,
                ]);
            }
        }

        return $rows;
    }

    /**
     * @return array
     */
    public function headings(): array
    {
        return [
            'Order ID',
            'Order Date',
            'Customer Name',
            'Customer Email',
            'Shipping Method',
            'Payment Method',
            'Payment Status',
            'Fulfillment Status',
            'Total Amount',
            'Items Count',
            'Sales Channel',
            'Shipping Country',
            'Shipping State',
            'Shipping City',
            'Shipping Postal Code',
            'Product',
            'Sub Product',
            'Size',
            'Color',
            'Quantity',
            'Unit Price',
            'Line Total',
        ];
    }

    /**
     * Map a flattened (order, item) row to a spreadsheet row.
     *
     * @param mixed $row
     * @return array
     */
    public function map($row): array
    {
        $order = $row->order;
        $item  = $row->item;

        $base = [
            '#' . $order->id,
            $order->created_at ? Carbon::parse($order->created_at)->format('Y-m-d H:i:s') : '-',
            optional($order->userDetails)->name ?? '-',
            optional($order->userDetails)->email ?? '-',
            optional($order->shippingMethodDetail)->name ?? '-',
            optional($order->paymentMethodDetail)->name ?? '-',
            $this->formatPaymentStatus($order->payment_status),
            $this->formatFulfillmentStatus($order->fulfillment_status),
            number_format($order->sub_total ?? 0, 2, '.', ''),
            $order->items_count ?? ($order->orderItems ? $order->orderItems->count() : 0),
            optional($order->salesChannel)->name ?? '-',
            $order->shipping_country ?? '-',
            $order->shipping_state ?? '-',
            $order->shipping_city ?? '-',
            $order->shipping_postal_code ?? '-',
        ];

        if (!$item) {
            return array_merge($base, [
                '-', // Product
                '-', // Sub Product
                '-', // Size
                '-', // Color
                0,   // Quantity
                number_format(0, 2, '.', ''), // Unit Price
                number_format(0, 2, '.', ''), // Line Total
            ]);
        }

        $product = optional($item->productDetail)->product_name ?? '-';
        $subProduct = optional($item->subProductDetail)->product_name ?? '-';
        $size = optional($item->sizeDetail)->size_name ?? '-';
        $color = optional($item->colorDetail)->pantone_code ?? '-';
        $qty = $item->quantity ?? 0;
        $unitPrice = number_format($item->unit_price ?? 0, 2, '.', '');
        $lineTotal = number_format($item->total_price ?? 0, 2, '.', '');

        return array_merge($base, [
            $product,
            $subProduct,
            $size,
            $color,
            $qty,
            $unitPrice,
            $lineTotal,
        ]);
    }

    protected function formatPaymentStatus($status): string
    {
        if ($status === null) {
            return 'Unknown';
        }

        switch ((int) $status) {
            case 0:
                return 'Pending';
            case 1:
                return 'Paid';
            case 2:
                return 'Refunded';
            default:
                return 'Unknown';
        }
    }

    protected function formatFulfillmentStatus($status): string
    {
        if ($status === null) {
            return 'Unknown';
        }

        switch ((int) $status) {
            case 0:
                return 'Unfulfilled';
            case 1:
                return 'Fulfilled';
            default:
                return 'Unknown';
        }
    }

    /**
     * @param Worksheet $sheet
     * @return array
     */
    public function styles(Worksheet $sheet)
    {
        return [
            1 => [
                'font' => ['bold' => true, 'color' => ['rgb' => 'FFFFFF']],
                'fill' => [
                    'fillType' => Fill::FILL_SOLID,
                    'startColor' => ['rgb' => '333F48'],
                ],
                'alignment' => [
                    'horizontal' => Alignment::HORIZONTAL_CENTER,
                    'vertical' => Alignment::VERTICAL_CENTER,
                ],
            ],
        ];
    }

    /**
     * @return array
     */
    public function columnWidths(): array
    {
        return [
            'A' => 12, // Order ID
            'B' => 20, // Order Date
            'C' => 20, // Customer Name
            'D' => 25, // Customer Email
            'E' => 18, // Shipping Method
            'F' => 18, // Payment Method
            'G' => 16, // Payment Status
            'H' => 18, // Fulfillment Status
            'I' => 15, // Total Amount
            'J' => 12, // Items Count
            'K' => 18, // Sales Channel
            'L' => 18, // Shipping Country
            'M' => 18, // Shipping State
            'N' => 18, // Shipping City
            'O' => 18, // Shipping Postal Code
            'P' => 25, // Product
            'Q' => 25, // Sub Product
            'R' => 12, // Size
            'S' => 12, // Color
            'T' => 12, // Quantity
            'U' => 15, // Unit Price
            'V' => 15, // Line Total
        ];
    }
}


