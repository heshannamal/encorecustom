<?php

namespace domain\Services\OrderService;

use App\Models\Cart;
use App\Models\ColorMaster;
use App\Models\CustomerDetail;
use App\Models\MasterStock;
use App\Models\Order;
use App\Models\OrderBillingDetail;
use App\Models\OrderItem;
use App\Models\Product;
use App\Models\SalesChannelSubProduct;
use App\Models\Size;
use App\Models\SubProduct;
use App\Models\SubProductColor;
use App\Models\SubProductPrice;
use App\Models\TempOrderBillingDetail;
use App\Models\User;
use Carbon\Carbon;
use domain\Services\InventoryService\InventoryNoteService;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;
use domain\Facades\InventoryFacade\InventoryNoteFacade;
use App\Models\SubProductDbModel;
use App\Services\DailyBalanceService;

class OrderService
{
    protected $order;
    protected $order_item;
    protected $master_stock;
    protected $inventory_note_service;
    protected $product;
    protected $sub_product;
    protected $sub_product_color;
    protected $sub_product_price;
    protected $color_master;
    protected $size;
    protected $sales_channel_sub_product;
    protected $cart;
    protected $temp_order_billing_detail;
    protected $order_billing_detail;



    public function __construct()
    {
        $this->order = new Order();
        $this->order_item = new OrderItem();
        $this->master_stock = new MasterStock();
        $this->inventory_note_service = new InventoryNoteService();
        $this->product = new Product();
        $this->sub_product = new SubProduct();
        $this->sub_product_color = new SubProductColor();
        $this->sub_product_price = new SubProductPrice();
        $this->color_master = new ColorMaster();
        $this->size = new Size();
        $this->sales_channel_sub_product = new SalesChannelSubProduct();
        $this->cart = new Cart();
        $this->temp_order_billing_detail = new TempOrderBillingDetail();
        $this->order_billing_detail = new OrderBillingDetail();
    }

    public function getAllOrders()
    {
        return $this->order->all();
    }

    public function getAllOrdersCount()
    {
        return $this->order->count();
    }

    public function getPaginatedOrders($request, $limit = 25)
    {
        $orderQry = $this->order;
        if (auth()->user()->hasAnyRole(['super_admin', 'admin'])) {
            if (isset($request->inventory_id)) {
                $orderQry->where('inventory_id', $request->inventory_id);
            }
        } else {
            $orderQry->where('inventory_id', auth()->user()->inventory_id);
        }
        $orders = $orderQry->orderBy('id', 'DESC')->paginate($limit);
        return $orders;
    }

    public function getOrdersForApi($request, $limit = 15)
    {
        $query = $this->order->with(['userDetails', 'shippingMethodDetail']);

        if ($request->has('start_date') && !empty($request->start_date)) {
            $query->whereDate('created_at', '>=', $request->start_date);
        }

        if ($request->has('end_date') && !empty($request->end_date)) {
            $query->whereDate('created_at', '<=', $request->end_date);
        }

        if ($request->has('sales_channel') && $request->sales_channel !== 'all' && $request->sales_channel !== '') {
            $query->where('sales_channel_id', $request->sales_channel);
        }

        if ($request->has('payment_status') && $request->payment_status !== 'all' && $request->payment_status !== '') {
            $query->where('payment_status', $request->payment_status);
        }

        if ($request->has('status') && $request->status !== 'all' && $request->status !== '') {
            $query->where('fulfillment_status', $request->status);
        }

        if ($request->has('delivery_method') && $request->delivery_method !== 'all' && $request->delivery_method !== '') {
            $query->where('shipping_method_id', $request->delivery_method);
        }

        if ($request->has('search') && !empty($request->search)) {
            $search = $request->search;
            $orderId = (int) preg_replace('/\D/', '', $search);

            // Pre-fetch matching IDs from mysql2 tables (cross-DB: can't use orWhereHas)
            $matchingProductIds = $this->product->where('product_name', 'LIKE', "%{$search}%")
                ->orWhere('product_no', 'LIKE', "%{$search}%")
                ->pluck('id');

            $matchingSubProductIds = $this->sub_product->where('product_name', 'LIKE', "%{$search}%")
                ->orWhere('sub_product_no', 'LIKE', "%{$search}%")
                ->pluck('id');

            $matchingColorIds = $this->color_master->where('pantone_code', 'LIKE', "%{$search}%")
                ->orWhere('hex', 'LIKE', "%{$search}%")
                ->pluck('id');

            $matchingSizeIds = $this->size->where('size_name', 'LIKE', "%{$search}%")
                ->pluck('id');

            // Collect all matching order_item IDs from the primary DB
            $matchingOrderItemOrderIds = $this->order_item->where(function ($iq) use (
                $matchingProductIds, $matchingSubProductIds, $matchingColorIds, $matchingSizeIds
            ) {
                $iq->whereIn('product_id', $matchingProductIds)
                   ->orWhereIn('sub_product_id', $matchingSubProductIds)
                   ->orWhereIn('color_master_id', $matchingColorIds)
                   ->orWhereIn('size_id', $matchingSizeIds);
            })->pluck('order_id');

            $query->where(function ($q) use ($search, $orderId, $matchingOrderItemOrderIds) {
                $q->where('id', $search)
                  ->orWhere('id', $orderId)
                  ->orWhere('sub_total', 'LIKE', "%{$search}%")
                  ->orWhereHas('userDetails', function ($uq) use ($search) {
                      $uq->where('email', 'LIKE', "%{$search}%")
                         ->orWhere('name', 'LIKE', "%{$search}%");
                  })
                  ->orWhereIn('id', $matchingOrderItemOrderIds);
            });
        }

        $query->orderBy('id', 'DESC');

        return $query->paginate($limit);
    }

    public function getOrderById($id)
    {
        return $this->order->with('orderItems', 'shippingLabel')->find($id);
    }

    public function getCustomerOrderById($id)
    {
        return $this->order->with('orderItems', 'shippingLabel')->where('user_id', auth()->user()->id)->where('id', $id)->first();
    }

    public function getOrderItemsByOrderId($id)
    {
        return $this->order_item->where('order_id', $id)->get();
    }

    public function getOrderItemDetailsById($id)
    {
        return $this->order_item->find($id);
    }

    public function storeOrder($data)
    {
        $inventoryTransferId = $data['inventory_transfer_id'];
        $items = $data['items'] ?? [];
        unset($data['items']);

        // Calculate total amount and items count
        $totalAmount = 0;
        $itemsCount = 0;
        foreach ($items as $item) {
            $quantity = $item['quantity'] ?? 0;
            $unitPrice = $item['unit_price'] ?? 0;
            $totalPrice = $quantity * $unitPrice;
            $totalAmount += $totalPrice;
            $itemsCount += $quantity;
        }

        $customer = CustomerDetail::where('user_id', $data['user_id'])->first();
        if ($customer) {
            if (!$customer->address || !$customer->country || !$customer->postal_code) {
                throw new \Exception('Customer details (address, country, postal code) need to be updated');
            }
        } else {
            throw new \Exception('Customer not found');
        }

        // Create order
        $orderData = [
            'user_id' => $data['user_id'],
            'inventory_type_id' => $data['inventory_type_id'],
            'sales_channel_id' => $data['sales_channel_id'],
            'sub_total' => $totalAmount,
            'items_count' => $itemsCount,
            'payment_status' => 1,
            'payment_method_id' => $data['payment_method_id'],
            'fulfillment_status' => $data['fulfillment_status'],
            'shipping_fee' => $data['shipping'] ?? 0,
            'sales_tax' => $data['sales_tax'] ?? 0,
            'invoice_total' => $data['invoice_total'] ?? $totalAmount,
            'other_fee' => $data['other_fee'] ?? 0,
            'balance_invoice' => $data['balance_invoice'] ?? $totalAmount,
            'processing_fee' => $data['processing_fee'] ?? 0,
            'paid_amount' => $data['amount_to_pay'] ?? $totalAmount,
            'shipping_method_id' => $data['shipping_method_id'],
            'shipping_address' => $customer->address ?? null,
            'shipping_street' => $customer->street ?? null,
            'shipping_city' => $customer->city ?? null,
            'shipping_state' => $customer->state ?? null,
            'shipping_country' => $customer->country ?? null,
            'shipping_postal_code' => $customer->postal_code ?? null,
            'shipping_phone' => $customer->phone_number ?? null,
        ];

        $order = $this->order->create($orderData);

        // Create order items
        foreach ($items as $item) {
            $quantity = $item['quantity'] ?? 0;
            $unitPrice = $item['unit_price'] ?? 0;
            $totalPrice = $quantity * $unitPrice;

            $productId = $this->sub_product->find($item['sub_product_id'])->parent_product_id;

            $orderItemData = [
                'order_id' => $order->id,
                'inventory_type_id' => $data['inventory_type_id'],
                'sales_channel_id' => $data['sales_channel_id'],
                'product_id' => $productId,
                'sub_product_id' => $item['sub_product_id'],
                'size_id' => $item['size_id'],
                'color_master_id' => $item['color_master_id'] ?? null,
                'quantity' => $quantity,
                'unit_price' => $unitPrice,
                'total_price' => $totalPrice,
                'is_active' => 1,
            ];

            $this->order_item->create($orderItemData);

            $masterStockQry = $this->master_stock->where('product_id', $productId)->where('sub_product_id', $item['sub_product_id'])->where('size_id', $item['size_id'])->where('inventory_type_id', $data['inventory_type_id']);
            if (isset($item['color_master_id'])) {
                $masterStockQry->where('color_master_id', $item['color_master_id']);
            }
            $masterStock = $masterStockQry->first();
            if ($masterStock) {
                $fromStockQty = (int) ($masterStock->stock_qty ?? 0);

                $masterStock->update([
                    'stock_qty' => $masterStock->stock_qty - $quantity,
                ]);

                $this->inventory_note_service->logTransaction(
                    $inventoryTransferId,
                    $masterStock,
                    $fromStockQty,
                    $masterStock->stock_qty,
                    -$quantity,
                    $order->id,
                    'orders'
                );
            }

        }

        return $order;
    }

    public function storeOnlineOrder($data)
    {
        $cartIds = json_decode($data['cart_ids']);

        $inventoryTransactionId = $data['inventory_transaction_id'];
        $items = $this->cart->with('subProduct.retailPrice')->whereIn('id', $cartIds)->get();

        $shippingDetails = [];
        $tempOrderBillingDetail = $this->temp_order_billing_detail->where('user_id', $data['user_id'])->first();
        if($tempOrderBillingDetail->is_shipping_address_available == 1){
            $shippingDetails['address'] = $tempOrderBillingDetail->shipping_address ?? null;
            $shippingDetails['street'] = $tempOrderBillingDetail->shipping_street ?? null;
            $shippingDetails['city'] = $tempOrderBillingDetail->shipping_city ?? null;
            $shippingDetails['state'] = $tempOrderBillingDetail->shipping_state ?? null;
            $shippingDetails['country'] = $tempOrderBillingDetail->shipping_country ?? null;
            $shippingDetails['postal_code'] = $tempOrderBillingDetail->shipping_postal_code ?? null;
            $shippingDetails['phone'] = $tempOrderBillingDetail->shipping_phone ?? null;
        } else {
            $shippingDetails['address'] = $tempOrderBillingDetail->address ?? null;
            $shippingDetails['street'] = $tempOrderBillingDetail->street ?? null;
            $shippingDetails['city'] = $tempOrderBillingDetail->city ?? null;
            $shippingDetails['state'] = $tempOrderBillingDetail->state ?? null;
            $shippingDetails['country'] = $tempOrderBillingDetail->country ?? null;
            $shippingDetails['postal_code'] = $tempOrderBillingDetail->postal_code ?? null;
            $shippingDetails['phone'] = $tempOrderBillingDetail->phone ?? null;
        }

        // Create order
        $orderData = [
            'user_id' => $data['user_id'],
            'inventory_type_id' => $data['inventory_type_id'],
            'sales_channel_id' => $data['sales_channel_id'],
            'sub_total' => $data['sub_total'],
            'items_count' => $data['total_item_qty'],
            'payment_status' => 0,
            'payment_method_id' => $data['payment_method_id'],
            'fulfillment_status' => $data['fulfillment_status'],
            'shipping_fee' => $data['shipping_fee'],
            'sales_tax' => $data['sales_tax'],
            'invoice_total' => $data['invoice_total'],
            'other_fee' => $data['other_fee'],
            'balance_invoice' => $data['balance_invoice'],
            'processing_fee' => $data['processing_fee'],
            'paid_amount' => $data['amount_to_pay'],
            'shipping_method_id' => $data['shipping_method_id'],
            'shipping_address' => $shippingDetails['address'],
            'shipping_street' => $shippingDetails['street'],
            'shipping_city' => $shippingDetails['city'],
            'shipping_state' => $shippingDetails['state'],
            'shipping_country' => $shippingDetails['country'],
            'shipping_postal_code' => $shippingDetails['postal_code'],
            'shipping_phone' => $shippingDetails['phone'],
        ];

        $order = $this->order->create($orderData);

        // Create order billing detail & delete temp order billing detail
        $orderBillingDetaildata = $tempOrderBillingDetail->toArray();
        unset($orderBillingDetaildata['id']);
        unset($orderBillingDetaildata['created_at']);
        unset($orderBillingDetaildata['updated_at']);
        $orderBillingDetaildata['order_id'] = $order->id;
        $this->order_billing_detail->create($orderBillingDetaildata);
        $tempOrderBillingDetail->delete();

        // Create order items
        foreach ($items as $item) {
            $quantity = $item->quantity ?? 0;
            $unitPrice = $item->subProduct->retailPrice->price ?? $item->subProduct->default_price ?? 0;
            $totalPrice = $quantity * $unitPrice;

            $productId = $this->sub_product->find($item->sub_product_id)->parent_product_id;

            $orderItemData = [
                'order_id' => $order->id,
                'inventory_type_id' => $data['inventory_type_id'],
                'sales_channel_id' => $data['sales_channel_id'],
                'product_id' => $productId,
                'sub_product_id' => $item->sub_product_id,
                'size_id' => $item->size_id,
                'color_master_id' => $item->color_id ?? null,
                'quantity' => $quantity,
                'unit_price' => $unitPrice,
                'total_price' => $totalPrice,
                'is_active' => 1,
            ];

            $this->order_item->create($orderItemData);

            $masterStockQry = $this->master_stock->where('product_id', $productId)->where('sub_product_id', $item->sub_product_id)->where('size_id', $item->size_id)->where('inventory_type_id', $data['inventory_type_id']);
            if (isset($item->color_id)) {
                $masterStockQry->where('color_master_id', $item->color_id);
            }
            $masterStock = $masterStockQry->first();
            if ($masterStock) {
                $fromStockQty = (int) ($masterStock->stock_qty ?? 0);

                // update master stock
                $masterStock->update([
                    'stock_qty' => $masterStock->stock_qty - $quantity,
                ]);

                // log inventory transaction
                $this->inventory_note_service->logTransaction(
                    $inventoryTransactionId,
                    $masterStock,
                    $fromStockQty,
                    $masterStock->stock_qty,
                    -$quantity,
                    $order->id,
                    'orders'
                );
            }

            // mark cart item as purchased
            $item->update(['is_purchased' => 1]);
        }

        return $order;
    }

    public function updateOrder($data, $id)
    {
        $type = $this->getOrderById($id);
        $type->update($data);
        return $type;
    }

    public function destroyOrder($id)
    {
        $type = $this->getOrderById($id);
        $type->delete();
    }

    public function getSubProdctIdsBySalesChannel($salesChannel)
    {
        $subProductIds = $this->sales_channel_sub_product->where('sales_channel_id', $salesChannel)
                                                            ->where('is_active', 1)
                                                            ->pluck('sub_product_id')
                                                            ->toArray();
        return $subProductIds;
    }

    public function getAvailableSubProductsBySalesChannel($salesChannel)
    {
        $subProductIds = $this->getSubProdctIdsBySalesChannel($salesChannel);
        $availableSubProductIds = $this->master_stock->whereIn('sub_product_id', $subProductIds)
                                                        ->where('is_active', 1)
                                                        ->where('stock_qty', '>', 0)
                                                        ->pluck('sub_product_id')
                                                        ->toArray();
        return $availableSubProductIds;
    }

    public function getAvailableSizeIdsBySubProductId($subProductId)
    {
       $availableSizeIds = $this->master_stock->where('sub_product_id', $subProductId)
                                                        ->where('is_active', 1)
                                                        ->where('stock_qty', '>', 0)
                                                        ->pluck('size_id')
                                                        ->toArray();
        return $availableSizeIds;
    }

    public function getAvailableColorIdsBySubProductAndSizeId($subProductId, $sizeId)
    {
       $availableSizeIds = $this->master_stock->where('sub_product_id', $subProductId)
                                                        ->where('size_id', $sizeId)
                                                        ->where('is_active', 1)
                                                        ->where('stock_qty', '>', 0)
                                                        ->pluck('color_master_id')
                                                        ->toArray();
        return $availableSizeIds;
    }

    public function getAvailableQty($subProductId, $sizeId, $colorId)
    {
        $availableQty = $this->master_stock->where('sub_product_id', $subProductId)
                                                        ->where('size_id', $sizeId)
                                                        ->where('color_master_id', $colorId)
                                                        ->where('is_active', 1)
                                                        ->sum('stock_qty');
        return $availableQty;
    }

    public function getProduct($salesChannel, $request)
    {
            $search = $request->get('search', '');
            $query = $this->product;

            if ($search) {
                $query->where(function($q) use ($search) {
                    $q->where('product_no', 'like', "%{$search}%")
                        ->orWhere('product_name', 'like', "%{$search}%");
                });
            }

            $products = $query->select('id', 'product_no', 'product_name')
                ->limit(50)
                ->get()
                ->map(function($product) {
                    $name = $product->product_name ?? $product->product_no ?? 'N/A';
                    return [
                        'id' => $product->id,
                        'text' => $name . ' (' . $product->product_no . ')'
                    ];
                });

            return $products;
    }

    public function getSubProducts($salesChannel, $request)
    {
        $allowedSubproductsIds = $this->getAvailableSubProductsBySalesChannel($salesChannel);
        $search = $request->get('search', '');
        $query = $this->sub_product->select('id', 'sub_product_no', 'product_name');

        if ($search) {
            $query->where(function($q) use ($search) {
                $q->where('sub_product_no', 'like', "%{$search}%")
                    ->orWhere('product_name', 'like', "%{$search}%");
            });
        }

        $subProducts = $query->whereIn('id', $allowedSubproductsIds)
            ->limit(50)
            ->get()
            ->map(function($subProduct) {
                $name = $subProduct->product_name ?? $subProduct->sub_product_no ?? 'N/A';
                return [
                    'id' => $subProduct->id,
                    'text' => $name . ' (' . $subProduct->sub_product_no . ')'
                ];
            });

            return $subProducts;
    }

    public function getSizes($subProductId, $request)
    {
        $availableSizeIds = $this->getAvailableSizeIdsBySubProductId($subProductId);
        $search = $request->get('search', '');
        $query = $this->size;

        if ($search) {
            $query->where(function($q) use ($search) {
                $q->where('size_name', 'like', "%{$search}%");
            });
        }

        $sizes = $query->select('id', 'size_name')
            ->whereIn('id', $availableSizeIds)
            ->limit(50)
            ->get()
            ->map(function($size) {
                $name = $size->size_name ?? 'N/A';
                return [
                    'id' => $size->id,
                    'text' => $name
                ];
            });
        return $sizes;
    }

    public function getColors($subProductId, $sizeId, $request)
    {
        $availableColorIds = $this->getAvailableColorIdsBySubProductAndSizeId($subProductId, $sizeId);
        $search = $request->get('search', '');
        $query = $this->color_master->whereIn('id', $availableColorIds);

        if ($search) {
            $query->where(function($q) use ($search) {
                $q->where('pantone_code', 'like', "%{$search}%")
                    ->orWhere('hex', 'like', "%{$search}%");
            });
        }

        $colors = $query->select('id', 'pantone_code', 'hex')
            ->limit(50)
            ->get()
            ->map(function($color) {
                $name = $color->pantone_code ?? $color->hex ?? 'N/A';
                return [
                    'id' => $color->id,
                    'text' => $name . ' (' . $color->hex . ')'
                ];
            });
        return $colors;
    }

    public function getUnitPrice($subProductId)
    {
        $subProduct = SubProduct::find($subProductId);
        $subProductPrice = SubProductPrice::where('sub_product_no', $subProduct->sub_product_no)->where('price_type', 1)->where('active', 1)->first();
        if($subProductPrice){
            return $subProductPrice->price;
        } else {
            return 0.00;
        }
    }


    public static function storePosOrder($data)
    {

        if (!DailyBalanceService::isSystemOpen()) {
            throw new \Exception("System is closed. Cannot place order.");
        }

        $items = $data['cart'] ?? [];
        if (empty($items)) {
            throw new \Exception("Cart is empty");
        }
        $total = 0;
        $qtyCount = 0;
        foreach ($items as $item) {
            $total += $item['price'] * $item['qty'];
            $qtyCount += $item['qty'];
        }
        $customer = CustomerDetail::where('user_id', $data['user_id'])->first();
        if (!$customer) {
            throw new \Exception("Customer not found");
        }
        // =========================
        // 1. CREATE ORDER
        // =========================
        $order = Order::create([

            'user_id' => $data['user_id'],

            'inventory_type_id' => $data['inventory_type_id'] ?? 5,

            'sales_channel_id' => $data['sales_channel_id'] ?? 3,

            'sub_total' => $total,

            'items_count' => $qtyCount,

            'payment_method_id' => $data['payment_method_id'],

            'payment_status' => 1,

            'fulfillment_status' => $data['fulfillment_status'] ?? 1,

            'shipping_method_id' => $data['shipping_method_id'] ?? 1,

            'other_fee' => $data['shipping_charge'] ?? 0,

            'invoice_total' => $data['final_total'] ?? $total,

            'balance_invoice' => $data['final_total'] ?? $total,

            'paid_amount' => $data['payment_method'] == 'cash'
                ? ($data['customer_cash'] ?? 0)
                : ($data['final_total'] ?? $total),

            // =========================
            // POS PAYMENT DATA
            // =========================

            'payment_method' => $data['payment_method'] ?? null,

            'customer_cash' => round($data['customer_cash'] ?? 0,2),

            'balance' => round($data['balance'] ?? 0,2),

            // DISCOUNT
            'discount_type' => $data['discount_type'] ?? null,

            'discount_value' => $data['discount_value'] ?? 0,

            'discount_amount' => round($data['discount_amount'] ?? 0,2),

            // CARD
            'card_type' => $data['card_type'] ?? null,

            'card_last_four' => $data['card_last_four'] ?? null,

            // CUSTOMER
            'shipping_address' => $customer->address,

            'shipping_country' => $customer->country,

            'shipping_postal_code' => $customer->postal_code,

            'shipping_phone' => $customer->phone_number,


        ]);
        // =========================
        // 2. ORDER ITEMS + STOCK UPDATE
        // =========================
        foreach ($items as $item) {
            $stock = MasterStock::where('id', $item['stock_id'] ?? null)
                ->orWhere('barcode', $item['barcode'] ?? null)
                ->first();
            if (!$stock) {
                throw new \Exception("Stock not found for item");
            }
            $totalPrice = $item['price'] * $item['qty'];

            $product = SubProductDbModel::find($item['id']);

            OrderItem::create([

                'order_id' => $order->id,

                'inventory_type_id' => $data['inventory_type_id'] ?? 5,

                'sales_channel_id' => $data['sales_channel_id'] ?? 3,

                'product_id' => $product->parent_product_id,

                'sub_product_id' => $item['id'],

                'size_id' => $item['size_id'] ?? null,

                'color_master_id' => $item['color_id'] ?? null,

                'quantity' => $item['qty'],

                'unit_price' => $item['price'],

                'total_price' => $totalPrice,

                'is_active' => 1,

            ]);
            // =========================
            // 3. STOCK UPDATE
            // =========================
            $oldQty = $stock->stock_qty;
            $stock->decrement('stock_qty', $item['qty']);
            InventoryNoteFacade::logTransaction(
                $data['inventory_transaction_id'],
                $stock,
                $oldQty,
                $stock->stock_qty,
                -$item['qty'],
                $order->id,
                'pos_orders'
            );
        }
        return $order;
    }


    public function fullfillOrder($orderId)
    {
        $order = $this->order->find($orderId);
        if($order){
            $order->fulfillment_status = 1;
            $order->update();
            return true;
        }else{
            return false;
        }
    }
}