<?php

namespace domain\Facades\ShippingFacade;

use domain\Services\ShippingService\USPShippingService;
use Illuminate\Support\Facades\Facade;

class USPShippingFacade extends Facade
{
    protected static function getFacadeAccessor()
    {
        return USPShippingService::class;
    }
}
