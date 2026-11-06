<?php

namespace domain\Facades\PaymentFacade;

use domain\Services\PaymentService\PaymentService;
use Illuminate\Support\Facades\Facade;

class PaymentFacade extends Facade
{
    protected static function getFacadeAccessor()
    {
        return PaymentService::class;
    }
}

