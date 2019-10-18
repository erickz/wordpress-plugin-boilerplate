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
class ConfigHelper
{
    public static $config;

    public static function setConfig($config = '')
    {
        self::$config = $config;
    }

    /**
     * Get any info you've added into your config`s file
     * @param $index
     * @return String
     */
    public static function get($index = null)
    {
        if (! $index || ! isset(self::$config[$index])){
            return false;
        }

        return self::$config[$index];
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