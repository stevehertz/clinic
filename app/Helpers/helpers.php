<?php

use Illuminate\Support\Facades\Route;
use Illuminate\Support\Facades\Request;

if(!function_exists('getPageTitle'))
{
    function getPageTitle()
    {
        $currentRouteName = Route::currentRouteName();
        $currentRouteName = ucwords(str_replace('.', ' ', $currentRouteName));
        return $currentRouteName;
    }
}

if(!function_exists('urlTree'))
{
    function urlTree($delimiter = ' > ')
    {
        $segments = Request::segments();
        $urlTree = [];
        $url = '';
        foreach ($segments as $i => $segment) {
            $url .= '/' . $segment;
            $urlTree[] = [
                'url' => $url,
                'label' => ucfirst($segment) // You can customize how names are displayed
            ];
        }
        return $urlTree;
    }
}