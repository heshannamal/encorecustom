<?php

namespace domain\Facades\UserFacade;

use domain\Services\UserService\CustomerService;
use Illuminate\Support\Facades\Facade;

class CustomerFacade extends Facade
{
    protected static function getFacadeAccessor()
    {
        return CustomerService::class;
    }
}
