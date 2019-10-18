<?php

namespace WordpressPluginBoilerplate\Loaders;

if ( ! defined( 'ABSPATH' ) ) exit;

class Module
{
    protected $baseDir;
    protected $modules;
    protected $loadedControllers;
    protected $actions;
    protected $filters;

    /**
     * Modules constructor
     *
     * @param string $baseDir
     * @param array $modules
     * @param null $actions
     * @param null $filters
     */
    public function __construct($baseDir = '', $modules = array(), $actions = null, $filters = null)
    {
        $this->baseDir = $baseDir;
        $this->modules = $modules;
        $this->actions = $actions;
        $this->filters = $filters;

        $this->load();
    }

    /**
     * Check first if the controller was mentioned in the modules config.
     * If the controller wasn't mentioned, build the controllers name into the following pattern:
     * {theFirstWord}-controller.php
     *
     * Whether the given parameter has more than a word or not,
     * retrieves the expected name of the controller.
     *
     * @return String
     */
    public function getControllersName($module = '')
    {
        if (isset($module['controller'])){
            return $module['controller'];
        }

        $module = $module['name'];
        $firstWord = ucfirst($module);
        $arModulesName = explode('-', $module);

        if (count($arModulesName) > 1){
            $firstWord = ucfirst($arModulesName[0]);
        }

        $controller = $firstWord . 'Controller';

        return $controller;
    }

    /**
     * It loads the modules registered in the config.php file
     * and save the successful ones in a array
     */
    public function load()
    {
        //If the controllers were loaded already, just return them.
        if ($this->loadedControllers){
            return $this->loadedControllers;
        }

        foreach ($this->modules as $arModule)
        {
            $module = $arModule['name'];
            $controller = $this->getControllersName($arModule);
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

        return $this->loadedControllers;
    }

    /**
     * Instantiate the loaded controllers and by doing so executing their hooks,
     * which should all be triggered at the controller`s __construct().
     *
     * @return array
     */
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

    /**
     * Execute the instantiation of controllers
     * @return array
     */
    public function run()
    {
        return $this->instantiate();
    }
}