<?php

namespace App\Exports;

use App\Models\User;
use Maatwebsite\Excel\Concerns\FromCollection;
use Maatwebsite\Excel\Concerns\WithHeadings;
use Maatwebsite\Excel\Concerns\WithMapping;
use Maatwebsite\Excel\Concerns\WithStyles;
use Maatwebsite\Excel\Concerns\WithColumnWidths;
use PhpOffice\PhpSpreadsheet\Worksheet\Worksheet;
use PhpOffice\PhpSpreadsheet\Style\Fill;
use PhpOffice\PhpSpreadsheet\Style\Alignment;

class CustomerExport implements FromCollection, WithHeadings, WithMapping, WithStyles, WithColumnWidths
{
    protected $search_input;
    protected $country;
    protected $inventory_type_id;

    public function __construct($search_input = null, $country = null, $inventory_type_id = null)
    {
        $this->search_input = $search_input;
        $this->country = $country;
        $this->inventory_type_id = $inventory_type_id;
    }

    /**
     * @return \Illuminate\Support\Collection
     */
    public function collection()
    {
        $customerQry = User::with(['customerDetail', 'orderDetails', 'inventoryTypeDetail'])
            ->whereHas('roles', function($role) {
                $role->where('name', '=', 'customer');
            });

        // Search Input Filter
        if (!empty($this->search_input)) {
            $searchInput = $this->search_input;
            $customerQry->where(function ($q) use ($searchInput) {
                $q->where('name', 'like', "%{$searchInput}%")
                  ->orWhere('email', 'like', "%{$searchInput}%")
                  ->orWhereHas('customerDetail', function ($subQ) use ($searchInput) {
                      $subQ->where('first_name', 'like', "%{$searchInput}%")
                           ->orWhere('last_name', 'like', "%{$searchInput}%")
                           ->orWhere('phone_number', 'like', "%{$searchInput}%");
                  });
            });
        }

        // Country Filter
        if (!empty($this->country)) {
            $customerQry->whereHas('customerDetail', function ($q) {
                $q->where('country_id', $this->country);
            });
        }

        // Inventory Type Filter
        if (auth()->user() && auth()->user()->hasAnyRole(['super_admin', 'admin'])) {
            if (!empty($this->inventory_type_id)) {
                $customerQry->where('inventory_id', $this->inventory_type_id);
            }
        } else {
            if (auth()->user()) {
                $customerQry->where('inventory_id', auth()->user()->inventory_id);
            }
        }

        return $customerQry->orderBy('created_at', 'desc')->get();
    }

    /**
     * @return array
     */
    public function headings(): array
    {
        return [
            'Customer Email',
            'Inventory Type',
            'Orders Count',
            'Amount Spent ($)',
            'First Name',
            'Last Name',
            'Phone Number',
            'Address',
            'Street',
            'City',
            'State',
            'Postal Code',
            'Country',
            'Profile Complete',
            'Status',
        ];
    }

    /**
     * @param mixed $customer
     * @return array
     */
    public function map($customer): array
    {
        $detail = $customer->customerDetail;
        $orderSum = $customer->orderSummation;

        return [
            $customer->email,
            optional($customer->inventoryTypeDetail)->name ?? '-',
            $orderSum['orders_count'] ?? 0,
            number_format($orderSum['orders_amount'] ?? 0, 2, '.', ''),
            $detail->first_name ?? '-',
            $detail->last_name ?? '-',
            $detail->phone_number ?? '-',
            $detail->address ?? '-',
            $detail->street ?? '-',
            $detail->city ?? '-',
            $detail->state ?? '-',
            $detail->postal_code ?? '-',
            $detail->country ?? '-',
            $customer->is_profile_complete ? 'Yes' : 'No',
            $customer->is_active ? 'Active' : 'Inactive',
        ];
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
            'A' => 25, // Email
            'B' => 18, // Inventory Type
            'C' => 15, // Orders Count
            'D' => 18, // Amount Spent
            'E' => 15, // First Name
            'F' => 15, // Last Name
            'G' => 18, // Phone Number
            'H' => 25, // Address
            'I' => 20, // Street
            'J' => 15, // City
            'K' => 15, // State
            'L' => 15, // Postal Code
            'M' => 15, // Country
            'N' => 18, // Profile Complete
            'O' => 12, // Status
        ];
    }
}
