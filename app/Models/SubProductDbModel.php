<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class SubProductDbModel extends Model
{
    protected $connection = 'mysql2';
    protected $table = 'sub_products';
    public $timestamps = false;

    public function productDetails()
    {
        return $this->belongsTo(
            ProductDbModel::class,
            'parent_product_id', // FK in sub_products table
            'id'                 // PK in products table
        )->with([
            'productSizes',
            'productFabrics',
            'productFabric',
            'productEmbellishmentTypes',
            'productCategories.categories',
            'productSport.sport',
            'productAttributes',
            'productFactories',
            'productMainCategories.mainCategory'
        ]);
    }

    public function embellishmentTypes()
    {
        return $this->hasMany(SubProductEmbellishmentOptionsDbModel::class, 'sub_product_id')->with('embellishmentDetails');
    }

    /**
     * MasterStock entries (stock_qty > 0) for this sub product,
     * each carrying its ColorMaster details via the existing color() relation.
     * Use ->with('availableColors.color') to eager-load full color details.
     */
    public function availableColors()
    {
        return $this->hasMany(MasterStock::class, 'sub_product_id', 'id')
            ->where('stock_qty', '>', 0)
            ->with('color')
            ->distinct('color_master_id')
            ->select('sub_product_id', 'color_master_id');
    }

    public function masterStock()
    {
        return $this->hasMany(MasterStock::class, 'sub_product_id');
    }
}
