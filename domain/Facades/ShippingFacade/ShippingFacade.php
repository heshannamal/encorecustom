<?php

namespace domain\Facades\ShippingFacade;

use domain\Services\ShippingService\ShippingService;
use Illuminate\Support\Facades\Facade;

class ShippingFacade extends Facade
{
    protected static function getFacadeAccessor()
    {
        return ShippingService::class;
    }
}
