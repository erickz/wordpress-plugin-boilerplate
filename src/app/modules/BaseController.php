<?php

namespace WordpressPluginBoilerplate\App;

if ( ! defined( 'ABSPATH' ) ) exit;

class BaseController
{
    /**
     * Return the path of the current module
     * @return String
     */
    public function getModulePath($file = '')
    {
        return plugin_dir_path($file);
    }
}