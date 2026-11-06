<?php

namespace domain\Facades\InventoryFacade;

use domain\Services\InventoryService\InventoryStockService;
use Illuminate\Support\Facades\Facade;

class InventoryStockFacade extends Facade
{
    protected static function getFacadeAccessor()
    {
        return InventoryStockService::class;
    }
}


