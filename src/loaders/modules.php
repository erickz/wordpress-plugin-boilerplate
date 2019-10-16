<?php

namespace WordpressPluginBoilerplate\Loaders;

use WordpressPluginBoilerplate\App\Helpers\Globals\Strings;

class Modules
{
    protected $baseDir;
    protected $modules;
    protected $loadedModules;
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

    public function load()
    {
        foreach ($this->modules as $module)
        {
            $moduleName = $module['name'];
            $file = $moduleName . '.php';
            $fullPath = $this->baseDir . 'src/app/modules/' . $moduleName . '/' . $file;

            if(isset($module['is_admin'])){
                $isAdmin = $module['is_admin'];

                //If It requires to be in the admin page and the page loaded It's not on It, then It skip
                if ($isAdmin && ! is_admin()){
                    continue;
                }
            }

            if ( file_exists( $fullPath ) ) {
                require_once $fullPath;

                $this->loadedModules[] = $moduleName;
            }
        }
    }

    public function instantiate()
    {
        $instantiateds = [];

        foreach($this->loadedModules as $module){
            $baseNamespace = '\WordpressPluginBoilerplate\App\Modules\\';
            $className = Strings::fromSnakeToCamel($module);
            $class = $baseNamespace . $className;

            if (class_exists($class)){
                new $class($this->actions, $this->filters);

                $instantiateds[] = $className;
            }
        }

        return $instantiateds;
    }

    public function run()
    {
        return $this->instantiate();
    }
}