<?php

namespace domain\Facades\UserFacade;

use domain\Services\UserService\PermissionService;
use Illuminate\Support\Facades\Facade;

class PermissionFacade extends Facade
{
    protected static function getFacadeAccessor()
    {
        return PermissionService::class;
    }
}
