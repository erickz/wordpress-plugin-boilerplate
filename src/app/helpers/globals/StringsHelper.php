<?php

namespace WordpressPluginBoilerplate\App\Helpers\Globals;

if ( ! defined( 'ABSPATH' ) ) exit;

/**
 * Helper responsible for handling the treatment of Strings
 *
 * Class Strings
 * @package WordpressPluginBoilerplate\App\Helpers\Globals
 */
class StringsHelper
{
    /**
     * Convert the given string from snake_case to CamelCase
     *
     * @param null $string
     * @return bool|string
     */
    public static function fromSnakeToCamel($string = null)
    {
        if (! $string){
            return false;
        }

        //Check if given string has a snake_case characteristic
        if (! strpos($string, '-') ){
            return false;
        }

        return ucfirst(str_replace('-', '', lcfirst(ucwords($string, '-'))));
    }

    /**
     * Check if the given string has Its first letter capitalized
     * @param $string
     * @return String
     */
    public static function isUpper($string)
    {
        $chr = mb_substr ($string, 0, 1, "UTF-8");
        return mb_strtolower($chr, "UTF-8") != $chr;
    }
}