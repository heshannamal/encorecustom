<?php

namespace domain\Facades\SalesChannelFacade;

use domain\Services\SalesChannelService\SalesChannelService;
use Illuminate\Support\Facades\Facade;

class SalesChannelFacade extends Facade
{
    protected static function getFacadeAccessor()
    {
        return SalesChannelService::class;
    }
}

