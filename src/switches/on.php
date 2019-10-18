<?php

namespace WordpressPluginBoilerplate\Switches;

if ( ! defined( 'ABSPATH' ) ) exit;

/**
 * Fired when plugin is activated
 */
class On
{
    protected $mainClassFile = '';

    //The register of activation hook requires the main file to be passed as a parameter
    function __construct($mainClassFile)
    {
        $this->mainClassFile = $mainClassFile;
    }

    public function register_in_wp()
    {
        register_activation_hook( $this->mainClassFile, array($this, 'activate') );
    }

    //It's executed when the plugin is activated
    public static function activate()
    {

    }
}