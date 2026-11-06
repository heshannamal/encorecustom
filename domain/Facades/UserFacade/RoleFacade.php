<?php

namespace domain\Facades\UserFacade;

use domain\Services\UserService\RoleService;
use Illuminate\Support\Facades\Facade;

class RoleFacade extends Facade
{
    protected static function getFacadeAccessor()
    {
        return RoleService::class;
    }
}
