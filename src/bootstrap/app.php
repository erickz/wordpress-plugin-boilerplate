<?php

if ( ! defined( 'ABSPATH' ) ) exit;

use WordpressPluginBoilerplate\Switches\On;
use WordpressPluginBoilerplate\Switches\Off;

use WordpressPluginBoilerplate\Loaders\Modules;

//use WordpressPluginBoilerplate\Lang\i18n;

use WordpressPluginBoilerplate\Registers\Actions;
use WordpressPluginBoilerplate\Registers\Filters;

class PluginApp
{
    protected $app;
    protected $actions;
    protected $filters;

    public function __construct($config = array())
    {
        $this->app = $config;

        if (is_admin()){
            //Register in WP the events when the plugin is activated and desactivated
            $this->register_switch_on();
            $this->register_switch_off();
        }

        //Instantiate filters and actions
        $this->actions = new Actions();
        $this->filters = new Filters();

        //Instantiate the Modules class which loads all modules
        $this->modules = new Modules($this->app['dir'], $this->app['modules'], $this->actions, $this->filters);
    }

    public function register_switch_on()
    {
        $on = new On($this->app['file']);
        $on->register_in_wp();
    }

    public function register_switch_off()
    {
        $off = new Off($this->app['file']);
        $off->register_in_wp();
    }

    public function runModules()
    {
        $this->modules->run();
    }

    public function runActions()
    {
        $this->actions->run();
    }

    public function runFilters()
    {
        $this->filters->run();
    }

    public function loadLanguages()
    {
        $lang = new i18n();
        $lang->load($this->app['name'], $this->app['dir']);
    }

    public function execute()
    {
        $this->runModules();

//        //$this->loadLanguages();

        $this->runActions();
        $this->runFilters();
    }
}



