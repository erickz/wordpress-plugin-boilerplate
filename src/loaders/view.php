<?php

namespace WordpressPluginBoilerplate\Loaders;

if ( ! defined( 'ABSPATH' ) ) exit;

use WordpressPluginBoilerplate\App\Helpers\Globals\ConfigHelper;
use WordpressPluginBoilerplate\App\Helpers\Globals\StringsHelper;

/**
 * Responsible for handling the loading of Views
 *
 * Class Views
 * @package WordpressPluginBoilerplate\Loaders
 */
class View
{
    /**
     * Build the path for the view
     * @param $view
     * @return string
     */
    public static function buildThePath($view = '', $path = '')
    {
        $extension = '.php';
        $defaultFolder = 'views';

        return $path . $defaultFolder . '/' . $view . 'View' . $extension;
    }

    /**
     * Load the view of the requested module
     *
     * @param string $view
     * @param null $path
     * @param array $data
     * @param bool $render
     * @return bool|mixed
     */
    public static function load($view = '', $path = null, $data = array(), $render = false)
    {
        if(! $view){
            return false;
        }

        //Check if the first letter is capitalized
        if (! StringsHelper::isUpper($view)){
            $view = ucfirst($view);
        }

        $fullPath = self::buildThePath($view, $path);

        if(! is_file($fullPath)){
            return false;
        }

        //Prevent from rendering the view
        if (! $render){
            ob_start();
        }

        $viewLoaded = include($fullPath);

        //Prevent from rendering the view
        if (! $render){
            ob_end_flush();
        }

        return $viewLoaded;
    }
}