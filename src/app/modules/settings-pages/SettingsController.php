<?php

namespace WordpressPluginBoilerplate\App\Modules;

if ( ! defined( 'ABSPATH' ) ) exit;

use WordpressPluginBoilerplate\Loaders\Views;

class SettingsController
{
    /**
     * SettingsPage constructor.
     * @param \WordpressPluginBoilerplate\Registers\Actions $actions
     * @param \WordpressPluginBoilerplate\Registers\Filters $filters
     */
    public function __construct($actions, $filters)
    {
        $actions->add('admin_menu', array($this, 'addMenu'));
    }

    public function addMenu()
    {
        add_menu_page( 'Settings of Custom Plugin',
            'Settings of <br /> Custom Plugin',
            'manage_options',
            'settings_custom_plugin',
            array($this, 'settingsPage'));
    }

    public function settingsPage()
    {
        return Views::load(plugin_dir_path( __FILE__ ) . 'templates/SettingsView.php');
    }
}