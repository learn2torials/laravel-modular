<?php

use Illuminate\Support\Str;

/**
 * Created by PhpStorm.
 * User: spatel
 * Date: 06/01/19
 * Time: 9:21 AM
 */
if ( isset($_SERVER["HTTP_CF_CONNECTING_IP"]) )
{
    $_SERVER['REMOTE_ADDR'] = $_SERVER["HTTP_CF_CONNECTING_IP"];
}

if (!function_exists('langPrefix') )
{
    function langPrefix($prefix='')
    {
        return trim(config('langPrefix'). ($prefix ? '/' .$prefix : ''), '/');
    }
}

if (!function_exists('getModuleSlug') )
{
    function getModuleSlug($str, $delimiter='')
    {
        return str_replace(' ', $delimiter, ucwords(str_replace('-', ' ', Str::slug(trim($str), '-'))));
    }
}

if (!function_exists('getModuleSlugRaw') )
{
    function getModuleSlugRaw($str)
    {
        return str_replace('-', '_', Str::slug(trim($str), '-'));
    }
}

if (!function_exists('module_enabled') )
{
    function module_enabled($module)
    {
        return ($modules = config('console.modules')) && !empty($modules[$module]);
    }
}
