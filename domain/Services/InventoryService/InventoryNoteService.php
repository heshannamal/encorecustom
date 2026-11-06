<?php

namespace domain\Services\InventoryService;

use App\Models\InventoryTransactionLog;
use App\Models\InventoryTransactionType;
use App\Models\MasterStock;
use Illuminate\Support\Facades\Auth;

class InventoryNoteService
{
    protected array $transactionTypeCache = [];

    public function getTransactionTypeId(string $slug, ?string $fallbackName = null): ?int
    {
        if (isset($this->transactionTypeCache[$slug])) {
            return $this->transactionTypeCache[$slug];
        }

        $type = InventoryTransactionType::firstOrCreate(
            ['slug' => $slug],
            ['name' => $fallbackName ?? ucfirst(str_replace('_', ' ', $slug)), 'is_active' => true]
        );

        $this->transactionTypeCache[$slug] = $type->id;
        return $type->id;
    }

    public function logTransaction(
        ?int $transactionTypeId,
        $stockRow,
        int $qtyBefore,
        int $qtyAfter,
        int $qtyChange,
        ?int $referenceId = null,
        ?string $referenceType = null,
        ?string $note = null
    ): InventoryTransactionLog {
        return InventoryTransactionLog::create([
            'transaction_type_id' => $transactionTypeId,
            'reference_id' => $referenceId,
            'reference_type' => $referenceType,
            'product_id' => $stockRow->product_id,
            'sub_product_id' => $stockRow->sub_product_id,
            'inventory_type_id' => $stockRow->inventory_type_id,
            'color_master_id' => $stockRow->color_master_id,
            'size_id' => $stockRow->size_id,
            'qty_before' => $qtyBefore,
            'qty_after' => $qtyAfter,
            'qty_change' => $qtyChange,
            'unit_price' => $stockRow->unit_price ?? 0,
            'performed_by' => Auth::id(),
            'note' => $note,
        ]);
    }

    public function getLogsForStock(
        int $subProductId,
        int $inventoryTypeId,
        ?int $colorMasterId = null,
        ?int $sizeId = null
    ) {
        $query = InventoryTransactionLog::where('sub_product_id', $subProductId)
            ->where('inventory_type_id', $inventoryTypeId);

        if ($colorMasterId === null) {
            $query->whereNull('color_master_id');
        } else {
            $query->where('color_master_id', $colorMasterId);
        }

        if ($sizeId !== null) {
            $query->where('size_id', $sizeId);
        }

        return $query->orderByDesc('created_at')->get();
    }
}


