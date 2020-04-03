<?php

use HMVCTools\Facades\PageTitleFacade;
use HMVCTools\Support\PageTitleSupport;

if (!function_exists('json_encode_prettify')) {
    /**
     * @param array $files
     */
    function json_encode_prettify($data)
    {
        return json_encode($data, JSON_PRETTY_PRINT | JSON_UNESCAPED_SLASHES);
    }
}

if (!function_exists('page_title')) {
    /**
     * @return PageTitleSupport
     */
    function page_title()
    {
        return PageTitleFacade::getFacadeRoot();
    }
}
