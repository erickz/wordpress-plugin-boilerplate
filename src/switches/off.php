<?php

namespace WordpressPluginBoilerplate\Switches;

if ( ! defined( 'ABSPATH' ) ) exit;

/**
 * Fired when plugin is deactivated
 */
class Off
{
    /**
     *
     */
    protected $mainClassFile = '';

    function __construct($mainClassFile)
    {
        $this->mainClassFile = $mainClassFile;
    }

    public function register_in_wp()
    {
        register_deactivation_hook( $this->mainClassFile, array($this, 'deactivate'));
    }

    public static function deactivate()
    {

    }
}