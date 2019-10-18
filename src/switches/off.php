<?php

namespace WordpressPluginBoilerplate\Switches;

if ( ! defined( 'ABSPATH' ) ) exit;

/**
 * Fired when plugin is deactivated
 */
class Off
{
    protected $mainClassFile = '';

    //The register of deactivation hook requires the main file to be passed as a parameter
    function __construct($mainClassFile)
    {
        $this->mainClassFile = $mainClassFile;
    }

    public function register_in_wp()
    {
        register_deactivation_hook( $this->mainClassFile, array($this, 'deactivate'));
    }

    //It's executed when the plugin is activated
    public static function deactivate()
    {

    }
}