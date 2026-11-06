<?php

namespace domain\Facades\UserFacade;

use domain\Services\UserService\UserGroupService;
use Illuminate\Support\Facades\Facade;

class UserGroupFacade extends Facade
{
    protected static function getFacadeAccessor()
    {
        return UserGroupService::class;
    }
}
