<?php

namespace domain\Facades\InventoryFacade;

use domain\Services\InventoryService\InventoryNoteService;
use Illuminate\Support\Facades\Facade;

class InventoryNoteFacade extends Facade
{
    protected static function getFacadeAccessor()
    {
        return InventoryNoteService::class;
    }
}


