<?php

namespace domain\Facades\EmailTemplateFacade;

use domain\Services\EmailTemplateService\EmailTemplateService;
use Illuminate\Support\Facades\Facade;

class EmailTemplateFacade extends Facade
{
    protected static function getFacadeAccessor()
    {
        return EmailTemplateService::class;
    }
}
