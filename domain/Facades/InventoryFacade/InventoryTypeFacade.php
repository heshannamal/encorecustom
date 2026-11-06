<?php

namespace domain\Facades\InventoryFacade;

use domain\Services\InventoryService\InventoryTypeService;
use Illuminate\Support\Facades\Facade;

class InventoryTypeFacade extends Facade
{
    protected static function getFacadeAccessor()
    {
        return InventoryTypeService::class;
    }
}
