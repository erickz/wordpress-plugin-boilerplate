<?php

namespace WordpressPluginBoilerplate\App\Helpers\Globals;

if ( ! defined( 'ABSPATH' ) ) exit;

class Strings
{
    public static function fromSnakeToCamel($string = null)
    {
        if (! $string){
            return false;
        }

        return ucfirst(str_replace('-', '', lcfirst(ucwords($string, '-'))));
    }
}