<?php

namespace domain\Services\InventoryService;

use App\Models\InventoryOrder;
use App\Models\InventoryOrderItem;
use App\Models\InventoryAddedOrder;
use App\Models\EcOrder;
use App\Models\EcOrderItem;
use App\Models\EcOrderItemDetail;
use App\Models\MasterStock;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class InventoryOrderService
{
    protected $inventory_order;
    protected $inventory_order_item;
    protected $master_stock;
    protected $inventory_note_service;

    public function __construct()
    {
        $this->inventory_order = new InventoryOrder();
        $this->inventory_order_item = new InventoryOrderItem();
        $this->master_stock = new MasterStock();
        $this->inventory_note_service = new InventoryNoteService();
    }

    public function getAllOrders()
    {
        return $this->inventory_order->all();
    }

    public function getPaginatedOrders($request, $limit = 25)
    {
        $orderQry = $this->inventory_order->query()->with(['inventoryType', 'createdBy', 'ecOrder']);

        if (auth()->user() && auth()->user()->hasAnyRole(['super_admin', 'admin'])) {
            if (isset($request->inventory_type_id) && $request->inventory_type_id !== '') {
                $orderQry->where('inventory_type_id', $request->inventory_type_id);
            }
        } else {
            if (auth()->user() && auth()->user()->inventory_id) {
                $orderQry->where('inventory_type_id', auth()->user()->inventory_id);
            }
        }

        if (isset($request->type) && $request->type !== '' && $request->type !== 'all') {
            $orderQry->where('type', $request->type);
        }

        if (isset($request->status) && $request->status !== '') {
            $orderQry->where('status', $request->status);
        }

        if (isset($request->start_date) && $request->start_date !== '') {
            $orderQry->whereDate('created_at', '>=', $request->start_date);
        }

        if (isset($request->end_date) && $request->end_date !== '') {
            $orderQry->whereDate('created_at', '<=', $request->end_date);
        }

        if (isset($request->search_input) && $request->search_input !== '') {
            $search = $request->search_input;
            $orderQry->where(function ($query) use ($search) {
                $query->where('description', 'like', "%{$search}%")
                      ->orWhere('id', 'like', "%" . ltrim($search, '#') . "%");
                
                $query->orWhereHas('createdBy', function ($userQuery) use ($search) {
                    $userQuery->where('name', 'like', "%{$search}%");
                });
            });
        }

        $orders = $orderQry->orderBy('created_at', 'desc')->paginate($limit)->withQueryString();
        return $orders;
    }

    public function getOrderById($id)
    {
        return $this->inventory_order->with(['inventoryType', 'createdBy', 'ecOrder', 'inventoryOrderItems.product.subProducts'])->find($id);
    }

    public function getOrderItemsByOrderId($id)
    {
        return $this->inventory_order_item->where('inventory_order_id', $id)
            ->with(['product.subProducts', 'subProduct', 'size', 'color', 'inventoryType'])
            ->get();
    }

    public function getNoColorOrderItemsByOrderId($id)
    {
        return $this->inventory_order_item->where('inventory_order_id', $id)
            ->whereNull('color_master_id')
            ->get();
    }

    public function getOrderItemDetailsByItemId($id)
    {

    }

    public function storeOrder($data)
    {
        return $this->inventory_order->create($data);
    }

    public function updateOrder($data, $id)
    {
        try {
            DB::beginTransaction();
            $order = $this->getOrderById($id);
            if ($order) {
                $order->update([
                    'description' => $data['description'] ?? null,
                    'inventory_type_id' => $data['inventory_type_id'] ?? $order->inventory_type_id
                ]);

                if ($order->type == 2) {
                    // Custom order update logic

                    // 1. Delete items that were removed
                    if (isset($data['deleted_items']) && is_array($data['deleted_items'])) {
                        foreach ($data['deleted_items'] as $deletedItemId) {
                            $orderItem = $this->inventory_order_item->where('inventory_order_id', $id)->find($deletedItemId);
                            if ($orderItem) {
                                $orderItem->delete();
                            }
                        }
                    }

                    // 2. Update existing items
                    if (isset($data['items']) && is_array($data['items'])) {
                        foreach ($data['items'] as $item) {
                            $orderItem = $this->inventory_order_item->where('inventory_order_id', $id)->find($item['id']);
                            if ($orderItem) {
                                $orderItem->update([
                                    'product_id' => $item['product_id'],
                                    'sub_product_id' => $item['sub_product_id'],
                                    'size_id' => $item['size_id'],
                                    'color_master_id' => $item['color_master_id'] ?? null,
                                    'qty' => $item['qty'],
                                    'unit_price' => $item['unit_price'],
                                    'inventory_type_id' => $data['inventory_type_id'] ?? $order->inventory_type_id,
                                ]);
                            }
                        }
                    }

                    // 3. Create new items
                    if (isset($data['new_items']) && is_array($data['new_items'])) {
                        foreach ($data['new_items'] as $newItem) {
                            $this->inventory_order_item->create([
                                'inventory_order_id' => $order->id,
                                'product_id' => $newItem['product_id'],
                                'sub_product_id' => $newItem['sub_product_id'],
                                'size_id' => $newItem['size_id'],
                                'color_master_id' => $newItem['color_master_id'] ?? null,
                                'inventory_type_id' => $data['inventory_type_id'] ?? $order->inventory_type_id,
                                'qty' => $newItem['qty'],
                                'unit_price' => $newItem['unit_price'],
                                'created_by' => auth()->id(),
                            ]);
                        }
                    }
                } else {
                    // System order update logic (original behavior)
                    if (isset($data['items']) && is_array($data['items'])) {
                        foreach ($data['items'] as $item) {
                            $orderItem = $this->inventory_order_item->find($item['id']);
                            if ($orderItem) {
                                $orderItem->update(['color_master_id' => $item['color_master_id']]);
                            }
                        }
                    }
                }
            }
            DB::commit();
            return $order;
        } catch (\Throwable $th) {
            DB::rollBack();
            throw $th;
        }
    }

    public function destroyOrder($id)
    {
        $order = $this->getOrderById($id);
        if ($order) {
            $order->delete();
        }
    }

    // System Inventory Order Methods
    public function getSystemInventoryAddedOrders($request, $limit = 25)
    {
        $query = InventoryAddedOrder::where('status', 1)
            ->with(['ecOrder']);

        if (auth()->user() && !auth()->user()->hasAnyRole(['super_admin', 'admin'])) {
            if (auth()->user()->inventory_id) {
                $query->where('inventory_id', auth()->user()->inventory_id);
            }
        }

        $inventoryAddedOrder = $query->orderBy('created_at', 'desc')->paginate($limit);
        return $inventoryAddedOrder;
    }

    public function getEcOrderById($id)
    {
        return EcOrder::with('orderItems')->find($id);
    }

    public function getEcOrderItemsByOrderId($id)
    {
        return EcOrderItem::where('order_id', $id)
            ->with(['ecOrderItemDetails', 'product', 'subProduct.retailPrice', 'size', 'color'])
            ->get();
    }

    public function getEcOrderItemDetailsByItemId($id)
    {
        return EcOrderItemDetail::where('order_item_id', $id)
            ->with(['size'])
            ->where(function($qr){
                $qr->where('qty', '>', 0)
                ->orWhere('blanks', '>', 0);
            })
            ->get();
    }

    public function acceptSystemOrder($data)
    {
        try {
            DB::beginTransaction();

            // Create inventory order
            $inventoryOrder = $this->inventory_order->create([
                'inventory_type_id' => $data['inventory_type_id'],
                'type' => 1, // System
                'ec_order_id' => $data['ec_order_id'],
                'description' => $data['description'] ?? null,
                'created_by' => auth()->id(),
            ]);

            $orderItems = $this->getEcOrderItemsByOrderId($data['ec_order_id']);
            // Create inventory order items from EC order items
            if (isset($orderItems) && count($orderItems) > 0) {
                foreach ($orderItems as $item) {
                    foreach ($item->ecOrderItemDetails as $itemDetail) {
                        $qty = 0;
                        if($itemDetail->qty > 0){
                            $qty = $itemDetail->qty;
                        } else if($itemDetail->blanks > 0){
                            $qty = $itemDetail->blanks;
                        }
                        $this->inventory_order_item->create([
                            'inventory_order_id' => $inventoryOrder->id,
                            'product_id' => $item->product_id,
                            'sub_product_id' => $item->subProduct->id,
                            'size_id' => $itemDetail->size_id,
                            'inventory_type_id' => $data['inventory_type_id'],
                            'qty' => $qty,
                            'unit_price' => $item->subProduct->retailPrice->price ?? '0.00',
                            'created_by' => auth()->id(),
                        ]);

                        // $masterStock = $this->master_stock->where('product_id', $item->product_id)->where('sub_product_id', $item->subProduct->id)->where('size_id', $itemDetail->size_id)->where('inventory_type_id', $data['inventory_type_id'])->first();
                        // if($masterStock){
                        //     $masterStock->update([
                        //         'stock_qty' => $masterStock->stock_qty + $qty,
                        //     ]);
                        // } else {
                        //     $this->master_stock->create([
                        //         'product_id' => $item->product_id,
                        //         'sub_product_id' => $item->subProduct->id,
                        //         'size_id' => $itemDetail->size_id,
                        //         'inventory_type_id' => $data['inventory_type_id'],
                        //         'stock_qty' => $qty,
                        //         'unit_price' => $item->subProduct->retailPrice->price ?? '0.00',
                        //     ]);
                        // }
                    }
                }
            }

            // Update inventory_added_order status
            $inventoryAddedOrder = InventoryAddedOrder::where('order_id', $data['ec_order_id'])
                ->where('status', 1)
                ->first();

            if ($inventoryAddedOrder) {
                $inventoryAddedOrder->update([
                    'status' => 2, // Accepted
                    'responded_by' => auth()->id(),
                ]);
            }
            DB::commit();
            return $inventoryOrder;

        } catch (\Throwable $th) {
            DB::rollBack();
            throw $th;
        }

    }

    public function rejectSystemOrder($ecOrderId, $reason = null)
    {
        $inventoryAddedOrder = InventoryAddedOrder::where('order_id', $ecOrderId)
            ->where('status', 1)
            ->first();

        if ($inventoryAddedOrder) {
            $inventoryAddedOrder->update([
                'status' => 0, // Rejected
                'responded_by' => auth()->id(),
            ]);
        }

        return $inventoryAddedOrder;
    }

    // Custom Inventory Order Methods
    public function storeCustomOrder($data)
    {
        try {
            DB::beginTransaction();
            // Create inventory order
            $inventoryOrder = $this->inventory_order->create([
                'inventory_type_id' => $data['inventory_type_id'],
                'type' => 2, // Custom
                'ec_order_id' => null,
                'description' => $data['description'] ?? null,
                'created_by' => auth()->id(),
            ]);

            // Create inventory order items
            if (isset($data['items']) && is_array($data['items'])) {
                foreach ($data['items'] as $item) {
                    $this->inventory_order_item->create([
                        'inventory_order_id' => $inventoryOrder->id,
                        'product_id' => $item['product_id'],
                        'sub_product_id' => $item['sub_product_id'],
                        'size_id' => $item['size_id'],
                        'color_master_id' => $item['color_master_id'],
                        'inventory_type_id' => $data['inventory_type_id'],
                        'qty' => $item['qty'],
                        'unit_price' => $item['unit_price'],
                        'created_by' => auth()->id(),
                    ]);

                    // $masterStock = $this->master_stock->where('product_id', $item['product_id'])->where('sub_product_id', $item['sub_product_id'])->where('size_id', $item['size_id'])->where('inventory_type_id', $data['inventory_type_id'])->first();
                    // if($masterStock){
                    //     $masterStock->update([
                    //         'stock_qty' => $masterStock->stock_qty + $item['qty'],
                    //     ]);
                    // } else {
                    //     $this->master_stock->create([
                    //         'product_id' => $item['product_id'],
                    //         'sub_product_id' => $item['sub_product_id'],
                    //         'size_id' => $item['size_id'],
                    //         'color_master_id' => $item['color_master_id'],
                    //         'inventory_type_id' => $data['inventory_type_id'],
                    //         'stock_qty' => $item['qty'],
                    //         'unit_price' => $item['unit_price'],
                    //     ]);
                    // }
                }
            }

            DB::commit();
            return $inventoryOrder;
        } catch (\Throwable $th) {
            DB::rollBack();
            throw $th;
        }

    }

    public function addToStock($id)
    {
        try {
            DB::beginTransaction();
            $inventoryTransferId = $this->inventory_note_service->getTransactionTypeId('inventory_order_in');
            $inventoryOrder = $this->inventory_order->find($id);
            if($inventoryOrder){
                $inventoryOrderItems = $this->inventory_order_item->where('inventory_order_id', $id)->get();
                foreach($inventoryOrderItems as $item)
                {
                    $masterStockQry = $this->master_stock->where('product_id', $item->product_id)->where('sub_product_id', $item->sub_product_id)->where('size_id', $item->size_id)->where('inventory_type_id', $item->inventory_type_id);
                    if(isset($item->color_master_id)){
                        $masterStockQry->where('color_master_id', $item->color_master_id);
                    }
                    $masterStock = $masterStockQry->first();
                    if($masterStock){
                        $fromStockQty = (int)($masterStock->stock_qty ?? 0);
                        $qty = $item->qty;

                        $masterStock->update([
                            'stock_qty' => $masterStock->stock_qty + $item->qty,
                        ]);

                    } else {
                        $fromStockQty = 0;
                        $qty = $item->qty;

                        $masterStock = $this->master_stock->create([
                                        'product_id' => $item->product_id,
                                        'sub_product_id' => $item->sub_product_id,
                                        'size_id' => $item->size_id,
                                        'color_master_id' => $item->color_master_id,
                                        'inventory_type_id' => $item->inventory_type_id,
                                        'stock_qty' => $item->qty,
                                        'unit_price' => $item->unit_price,
                                    ]);
                    }

                    $this->inventory_note_service->logTransaction(
                        $inventoryTransferId,
                        $masterStock,
                        $fromStockQty,
                        $masterStock->stock_qty,
                        $qty,
                        $inventoryOrder->id,
                        'inventory_orders'
                    );
                }
                $inventoryOrder->update(['status'=>1]);
            }

            DB::commit();
            return $inventoryOrder;
        } catch (\Throwable $th) {
            DB::rollBack();
            throw $th;
        }
    }
}

