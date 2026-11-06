<?php

namespace App\Exports;

use App\Models\OrderPaymentDetail;
use Carbon\Carbon;
use Maatwebsite\Excel\Concerns\FromCollection;
use Maatwebsite\Excel\Concerns\WithHeadings;
use Maatwebsite\Excel\Concerns\WithMapping;
use Maatwebsite\Excel\Concerns\WithStyles;
use Maatwebsite\Excel\Concerns\WithColumnWidths;
use PhpOffice\PhpSpreadsheet\Worksheet\Worksheet;
use PhpOffice\PhpSpreadsheet\Style\Fill;
use PhpOffice\PhpSpreadsheet\Style\Alignment;

class PaymentReportExport implements FromCollection, WithHeadings, WithMapping, WithStyles, WithColumnWidths
{
    protected $startDate;
    protected $endDate;
    protected $paymentStatus;
    protected $paymentMethod;
    protected $deliveryMethod;
    protected $search;

    public function __construct(
        $startDate = null,
        $endDate = null,
        $paymentStatus = null,
        $paymentMethod = null,
        $deliveryMethod = null,
        $search = null
    ) {
        $this->startDate = $startDate;
        $this->endDate = $endDate;
        $this->paymentStatus = $paymentStatus;
        $this->paymentMethod = $paymentMethod;
        $this->deliveryMethod = $deliveryMethod;
        $this->search = $search;
    }

    public function collection()
    {
        $baseQuery = OrderPaymentDetail::with(['order.shippingMethodDetail']);

        if ($this->paymentStatus !== null && $this->paymentStatus !== 'all') {
            $baseQuery->whereHas('order', function ($q) {
                $q->where('payment_status', $this->paymentStatus);
            });
        }

        if ($this->paymentMethod !== null && $this->paymentMethod !== 'all') {
            $baseQuery->where('transaction_account_type', $this->paymentMethod);
        }

        if ($this->deliveryMethod !== null && $this->deliveryMethod !== 'all') {
            $baseQuery->whereHas('order', function ($q) {
                $q->where('shipping_method_id', $this->deliveryMethod);
            });
        }

        if (!empty($this->search)) {
            $search = $this->search;
            $baseQuery->where(function($q) use ($search) {
                $q->where('order_id', 'LIKE', "%{$search}%")
                  ->orWhere('transaction_account_type', 'LIKE', "%{$search}%")
                  ->orWhere('sub_total', 'LIKE', "%{$search}%")
                  ->orWhere('invoice_total', 'LIKE', "%{$search}%");
            });
        }

        if (!empty($this->startDate)) {
            $baseQuery->whereDate('created_at', '>=', $this->startDate);
        }

        if (!empty($this->endDate)) {
            $baseQuery->whereDate('created_at', '<=', $this->endDate);
        }

        return $baseQuery->orderBy('created_at', 'desc')->get();
    }

    public function headings(): array
    {
        return [
            'Order ID',
            'Order Date',
            'Payment Method',
            'Payment Status',
            'Delivery Method',
            'Sub Total',
            'Shipping Fee',
            'Tax',
            'Invoice Total',
            'Processing Fee',
            'Paid Amount',
        ];
    }

    public function map($payment): array
    {
        $order = $payment->order;
        
        $status_name = 'Pending';
        if($order) {
            if ($order->payment_status == 1) {
                $status_name = 'Paid';
            } elseif ($order->payment_status == 2) {
                $status_name = 'Failed';
            }
        }

        $payment_method_val = $payment->transaction_account_type ?: 'Unknown';
        
        $shipping_fee = $order && $order->shipping_fee ? number_format($order->shipping_fee, 2, '.', '') : '0.00';
        $tax = $order && $order->sales_tax ? number_format($order->sales_tax, 2, '.', '') : '0.00';
        $deliveryMethod = $order && $order->shippingMethodDetail ? $order->shippingMethodDetail->name : '-';

        return [
            $payment->order_id ? '#' . $payment->order_id : '-',
            Carbon::parse($payment->created_at)->format('Y-m-d H:i:s'),
            $payment_method_val,
            $status_name,
            $deliveryMethod,
            number_format($payment->sub_total, 2, '.', ''),
            $shipping_fee,
            $tax,
            number_format($payment->invoice_total, 2, '.', ''),
            number_format($payment->processing_fee, 2, '.', ''),
            number_format($payment->paid_amount, 2, '.', ''),
        ];
    }

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

    public function columnWidths(): array
    {
        return [
            'A' => 15, // Order ID
            'B' => 20, // Order Date
            'C' => 18, // Payment Method
            'D' => 18, // Payment Status
            'E' => 20, // Delivery Method
            'F' => 15, // Sub Total
            'G' => 15, // Shipping Fee
            'H' => 15, // Tax
            'I' => 15, // Invoice Total
            'J' => 15, // Processing Fee
            'K' => 15, // Paid Amount
        ];
    }
}
