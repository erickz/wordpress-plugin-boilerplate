<?php

namespace WordpressPluginBoilerplate\App\Modules;

if ( ! defined( 'ABSPATH' ) ) exit;

use WordpressPluginBoilerplate\App\BaseController;
use WordpressPluginBoilerplate\Loaders\View;

/**
 * Class SettingsController
 * @package WordpressPluginBoilerplate\App\Modules
 */
class SettingsController extends BaseController
{
    /**
     * The hooks should all be called here in the construct
     *
     * SettingsPage constructor.
     * @param \WordpressPluginBoilerplate\Registers\Actions $actions
     * @param \WordpressPluginBoilerplate\Registers\Filters $filters
     */
    public function __construct($actions, $filters)
    {
        $actions->add('admin_menu', array($this, 'addMenu'));
    }

    /**
     * A simple function to add a menu into wp_admin
     */
    public function addMenu()
    {
        add_menu_page( 'Settings of Custom Plugin',
            'Settings of <br /> Custom Plugin',
            'manage_options',
            'settings_custom_plugin',
            array($this, 'settingsPage'));
    }

    /**
     * Return the settings page registered at the wp_admin menu
     * @return bool|mixed
     */
    public function settingsPage()
    {
        return View::load( 'settings', $this->getModulePath(__FILE__));
    }
}