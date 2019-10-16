<?php

namespace WordpressPluginBoilerplate\Loaders;

class Views
{
    public static function load($view = '')
    {
        if(! $view){
            return false;
        }

        if(! is_file($view)){
            return false;
        }

        ob_start();

        $viewLoaded = include($view);

        ob_end_flush();

        return $viewLoaded;
    }
}