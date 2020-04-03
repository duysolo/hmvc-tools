<?php

namespace HMVCTools\Facades;

use HMVCTools\Support\PageTitleSupport;
use Illuminate\Support\Facades\Facade;

class PageTitleFacade extends Facade
{
    /**
     * @return string
     */
    protected static function getFacadeAccessor()
    {
        return PageTitleSupport::class;
    }
}
