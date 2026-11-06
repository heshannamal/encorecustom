<?php

namespace domain\Services\InventoryService;

use App\Models\InventoryType;
use Carbon\Carbon;

class InventoryTypeService
{
    protected $inventory_type;

    public function __construct()
    {
        $this->inventory_type = new InventoryType();
    }

    public function getAllTypes()
    {
        return $this->inventory_type->all();
    }

    public function getAllActiveTypes()
    {
        return $this->inventory_type->where('is_active', 1)->get();
    }

    public function getTypeById($id)
    {
        return $this->inventory_type->find($id);
    }

    public function storeInventoryType($data)
    {
        $this->inventory_type->create($data);
    }

    public function updateInventoryType($data, $id)
    {
        $type = $this->getTypeById($id);
        $type->update($data);
        return $type;
    }

    public function destroyInventoryType($id)
    {
        $type = $this->getTypeById($id);
        $type->delete();
    }
}
