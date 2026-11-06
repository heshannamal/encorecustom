<?php

namespace App\Traits;

trait BarcodeHelper
{
    public function getBarcodeTextBySubProductNo($sub_product_no, $sizeId, $colorId)
    {
        // Remove 'PRO-' prefix if present
        $cleanSubProductNo = str_replace('PRO-', '', $sub_product_no);

        // Split by period to extract product ID and sub product variant
        $parts = explode('.', $cleanSubProductNo);
        $productId = isset($parts[0]) ? trim($parts[0]) : '0';
        $variantId = isset($parts[1]) ? trim($parts[1]) : '0';

        // Clean size and color IDs
        $sizeId = trim((string) $sizeId);
        $colorId = trim((string) $colorId);

        // Pad components to the required lengths:
        // - Product ID: 3 characters
        // - Sub product variant: 2 characters
        // - Size ID: 2 characters
        // - Color ID: 4 characters
        $paddedProductId = str_pad($productId, 3, '0', STR_PAD_LEFT);
        $paddedVariantId = str_pad($variantId, 2, '0', STR_PAD_LEFT);
        $paddedSizeId = str_pad($sizeId, 2, '0', STR_PAD_LEFT);
        $paddedColorId = str_pad($colorId, 4, '0', STR_PAD_LEFT);

        return $paddedProductId . $paddedVariantId . $paddedSizeId . $paddedColorId;
    }
}
