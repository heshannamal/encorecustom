<?php

namespace domain\Services\InventoryService;

use App\Models\InventoryType;
use App\Models\MasterStock;
use App\Models\StockAdjustment;
use App\Models\SubProduct;
use App\Models\SubProductPrice;
use Carbon\Carbon;

class InventoryStockService
{
    protected $stock_adjustment;
    protected $inventory_type;
    protected $master_stock;
    protected $sub_product;
    protected $sub_product_price;

    public function __construct()
    {
        $this->stock_adjustment = new StockAdjustment();
        $this->inventory_type = new InventoryType();
        $this->master_stock = new MasterStock();
        $this->sub_product = new SubProduct();
        $this->sub_product_price = new SubProductPrice();
    }

    public function addStockAdjustment($data, $stock){
        $adjustmentData = [
            'inventory_type_id' => $data['inventory_type_id'],
            'product_id' => $data['product_id'] ?? $stock['product_id'],
            'sub_product_id' => $data['sub_product_id'] ?? $stock['sub_product_id'],
            'size_id' => $data['size_id'] ?? $stock['size_id'],
            'color_master_id' => $data['color_master_id'] ?? $stock['color_master_id'] ?? null,
            'quantity' => $data['quantity'],
            'unit_price' => $data['unit_price'] ?? $stock['unit_price'] ?? 0.00,
            'reason' => $data['reason'] ?? null,
            'created_by' => auth()->user()->id,
        ];
        return $this->stock_adjustment->create($adjustmentData);
    }

    public function addStock($data)
    {
        $subProduct = $this->sub_product->where('id', $data['sub_product_id'])->first();
        if (isset($data['unit_price']) && $data['unit_price'] != null && $data['unit_price'] != '') {
            $unitPrice = $data['unit_price'];
        } else {
            $subProductPrice = $this->sub_product_price->where('sub_product_no', $subProduct->sub_product_no)->where('price_type', 1)->where('active', 1)->first();
            if ($subProductPrice) {
                $unitPrice = $subProductPrice->price;
            } else {
                $unitPrice = 0.00;
            }
        }
        $stockData = [
                    'product_id' => $subProduct->parent_product_id,
                    'sub_product_id' => $data['sub_product_id'],
                    'size_id' => $data['size_id'],
                    'color_master_id' => $data['color_master_id'],
                    'inventory_type_id' => $data['inventory_type_id'],
                    'stock_qty' => $data['stock_qty'],
                    'unit_price' => $unitPrice,
                ];
        return $this->master_stock->create($stockData);
    }
}
