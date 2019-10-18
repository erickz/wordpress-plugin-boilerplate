<?php

namespace WordpressPluginBoilerplate\Switches;

if ( ! defined( 'ABSPATH' ) ) exit;

/**
 * Fired when plugin is activated
 */
class On
{
    protected $mainClassFile = '';

    function __construct($mainClassFile)
    {
        $this->mainClassFile = $mainClassFile;
    }

    public function register_in_wp()
    {
        register_activation_hook( $this->mainClassFile, array($this, 'activate') );
    }

    public static function activate()
    {

    }
}