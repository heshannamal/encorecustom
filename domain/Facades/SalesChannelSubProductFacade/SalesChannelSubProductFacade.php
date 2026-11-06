<?php

namespace domain\Facades\SalesChannelSubProductFacade;

use domain\Services\SalesChannelSubProductService\SalesChannelSubProductService;
use Illuminate\Support\Facades\Facade;

class SalesChannelSubProductFacade extends Facade
{
    protected static function getFacadeAccessor()
    {
        return SalesChannelSubProductService::class;
    }
}

