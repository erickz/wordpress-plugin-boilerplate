<?php

namespace WordpressPluginBoilerplate\Loaders;

if ( ! defined( 'ABSPATH' ) ) exit;

/**
 * Responsible for handling the loading of Views
 *
 * Class Views
 * @package WordpressPluginBoilerplate\Loaders
 */
class Views
{
    public static function load($view = '', $data = array(), $render = false)
    {
        if(! $view){
            return false;
        }

        if(! is_file($view)){
            return false;
        }

        //Prevent from rendering the view
        if (! $render){
            ob_start();
        }

        $viewLoaded = include($view);

        //Prevent from rendering the view
        if (! $render){
            ob_end_flush();
        }

        return $viewLoaded;
    }
}