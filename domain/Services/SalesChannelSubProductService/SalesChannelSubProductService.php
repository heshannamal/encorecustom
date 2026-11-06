<?php

namespace domain\Services\SalesChannelSubProductService;

use App\Models\SalesChannelSubProduct;
use App\Models\SubProduct;
use Carbon\Carbon;

class SalesChannelSubProductService
{
    protected $sales_channel_sub_product;

    public function __construct()
    {
        $this->sales_channel_sub_product = new SalesChannelSubProduct();
    }

    public function getAllByChannel($salesChannelId)
    {
        return $this->sales_channel_sub_product->where('sales_channel_id', $salesChannelId)->get();
    }

    public function getAllActiveByChannel($salesChannelId)
    {
        return $this->sales_channel_sub_product->where('sales_channel_id', $salesChannelId)
            ->where('is_active', 1)
            ->get();
    }

    public function getById($id)
    {
        return $this->sales_channel_sub_product->find($id);
    }

    public function storeSalesChannelSubProduct($data)
    {
        // Check if the relationship already exists
        $existing = $this->sales_channel_sub_product
            ->where('sales_channel_id', $data['sales_channel_id'])
            ->where('sub_product_id', $data['sub_product_id'])
            ->first();

        if ($existing) {
            throw new \Exception('This sub product is already assigned to this sales channel.');
        }

        // Set default is_active if not provided
        if (!isset($data['is_active'])) {
            $data['is_active'] = 1;
        }

        $this->sales_channel_sub_product->create($data);
    }

    public function updateSalesChannelSubProduct($data, $id)
    {
        $channelSubProduct = $this->getById($id);
        
        // Check if updating would create a duplicate
        if (isset($data['sales_channel_id']) && isset($data['sub_product_id'])) {
            $existing = $this->sales_channel_sub_product
                ->where('sales_channel_id', $data['sales_channel_id'])
                ->where('sub_product_id', $data['sub_product_id'])
                ->where('id', '!=', $id)
                ->first();

            if ($existing) {
                throw new \Exception('This sub product is already assigned to this sales channel.');
            }
        }

        $channelSubProduct->update($data);
        return $channelSubProduct;
    }

    public function destroySalesChannelSubProduct($id)
    {
        $channelSubProduct = $this->getById($id);
        $channelSubProduct->delete();
    }

    public function getSubProductsForSelect($salesChannelId = null)
    {
        $query = SubProduct::with('product');
        
        if ($salesChannelId) {
            // Get sub product IDs already assigned to this channel
            $assignedIds = $this->sales_channel_sub_product
                ->where('sales_channel_id', $salesChannelId)
                ->pluck('sub_product_id')
                ->toArray();
            
            // Exclude already assigned sub products
            $query->whereNotIn('id', $assignedIds);
        }
        
        return $query->select('id', 'sub_product_no', 'product_name', 'parent_product_id')
            ->get()
            ->map(function($subProduct) {
                $name = $subProduct->product_name ?? $subProduct->sub_product_no ?? 'N/A';
                return [
                    'id' => $subProduct->id,
                    'text' => $name . ' (' . $subProduct->sub_product_no . ')'
                ];
            });
    }
}

