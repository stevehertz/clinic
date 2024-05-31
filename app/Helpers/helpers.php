<?php

use Illuminate\Support\Facades\Route;

if(!function_exists('getPageTitle'))
{
    function getPageTitle()
    {
        $currentRouteName = Route::currentRouteName();
        $currentRouteName = ucwords(str_replace('.', ' ', $currentRouteName));
        return $currentRouteName;
    }
   
}