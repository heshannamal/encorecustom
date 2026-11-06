<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class ProductDbModel extends Model
{
    protected $connection = 'mysql2';
    protected $table = 'products';
    public $timestamps = false;

    public function productSizes()
    {
        return $this->hasMany(ProductSizeDbModel::class, 'product_id');
    }

    public function productFabrics()
    {
        return $this->hasMany(ProductFabricDbModel::class, 'product_id');
    }

    public function productFabric()
    {
        return $this->belongsTo(ProductFabricMasterDbModel::class, 'fabric_id');
    }

    public function productEmbellishmentTypes()
    {
        return $this->hasMany(ProductEmbellishmentTypeDbModel::class, 'product_id');
    }

    public function productCategories()
    {
        return $this->hasMany(ProductCategoryListDbModel::class, 'product_id');
    }

    public function productSport()
    {
        return $this->hasOne(ProductSportDbModel::class, 'product_id');
    }

    public function productAttributes()
    {
        return $this->hasMany(ProductAttributeDbModel::class, 'product_id');
    }

    public function productFactories()
    {
        return $this->hasMany(ProductFactoryDbModel::class, 'product_id');
    }

    public function productMainCategories()
    {
        return $this->hasMany(ProductMainCategoryDbModel::class, 'product_id');
    }
}
