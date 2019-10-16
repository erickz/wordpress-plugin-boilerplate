<?php

namespace WordpressPluginBoilerplate\Registers;

use WordpressPluginBoilerplate\Registers\hookTraits;

class Actions
{
    protected $actions;

    use hookTraits;

    public function __construct()
    {
        $this->actions = array();
    }

    public function add($hook = '', $component = '', $callback = '', $priority = 99, $accepted_args = '')
    {
        return $this->addHook($this->actions, $hook, $component, $callback, $priority, $accepted_args);
    }

    public function run()
    {
        if (! $this->actions){
            return;
        }

        $this->runHooks($this->actions);
    }
}