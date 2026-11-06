<?php

namespace domain\Facades\InventoryFacade;

use domain\Services\InventoryService\InventoryOrderService;
use Illuminate\Support\Facades\Facade;

class InventoryOrderFacade extends Facade
{
    protected static function getFacadeAccessor()
    {
        return InventoryOrderService::class;
    }
}

