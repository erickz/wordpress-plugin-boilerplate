<?php

namespace WordpressPluginBoilerplate\App\Helpers\Globals;

if ( ! defined( 'ABSPATH' ) ) exit;

/**
 * The config helper is responsible for sharing the plugin`s information across the modules
 * and here you can also include functions related to Its info.
 *
 * Class Config
 * @package WordpressPluginBoilerplate\App\Helpers\Globals
 */
class Config
{
    public static $config;

    public static function setConfig($config = '')
    {
        self::$config = $config;
    }

    public static function getPluginsName()
    {
        return self::$config['name'];
    }

    public static function getDir()
    {
        return self::$config['dir'];
    }

    public static function getModules()
    {
        return self::$config['modules'];
    }
}