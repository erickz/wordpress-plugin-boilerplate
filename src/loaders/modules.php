<?php

namespace WordpressPluginBoilerplate\Loaders;

if ( ! defined( 'ABSPATH' ) ) exit;

use WordpressPluginBoilerplate\App\Helpers\Globals\Strings;

class Modules
{
    protected $baseDir;
    protected $modules;
    protected $loadedControllers;
    protected $actions;
    protected $filters;

    public function __construct($baseDir = '', $modules = array(), $actions = null, $filters = null)
    {
        $this->baseDir = $baseDir;
        $this->modules = $modules;
        $this->actions = $actions;
        $this->filters = $filters;

        $this->load();
    }

    /**
     * If the module has more than one word, then the pattern for the controller will be:
     * {theFirstWord}-controller.php
     * @return String
     */
    public function getControllersName($module = '')
    {
        $controller = ucfirst($module);
        $arModulesName = explode('-', $module);

        if (count($arModulesName) > 1){
            $controller = ucfirst($arModulesName[0]);
        }

        $controller .= 'Controller';

        return $controller;
    }

    public function load()
    {
        foreach ($this->modules as $arModule)
        {
            $module = $arModule['name'];
            $controller = $this->getControllersName($module);
            $fullPath = $this->baseDir . 'src/app/modules/' . $module . '/' . $controller . '.php';

            if(isset($arModule['is_admin'])){
                $isAdmin = $arModule['is_admin'];

                //If It requires to be in the admin page and the page loaded It's not on It, then It skip
                if ($isAdmin && ! is_admin()){
                    continue;
                }
            }

            if ( file_exists( $fullPath ) ) {

                require_once $fullPath;

                $this->loadedControllers[] = $controller;
            }
        }
    }

    public function instantiate()
    {
        $instantiateds = [];

        foreach($this->loadedControllers as $controller){
            $baseNamespace = '\WordpressPluginBoilerplate\App\Modules\\';
            $class = $baseNamespace . $controller;

            if (class_exists($class)){
                new $class($this->actions, $this->filters);

                $instantiateds[] = $controller;
            }
        }

        return $instantiateds;
    }

    public function run()
    {
        return $this->instantiate();
    }
}