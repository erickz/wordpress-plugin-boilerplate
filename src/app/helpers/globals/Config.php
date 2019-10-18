<?php

namespace WordpressPluginBoilerplate\App\Helpers\Globals;

if ( ! defined( 'ABSPATH' ) ) exit;

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