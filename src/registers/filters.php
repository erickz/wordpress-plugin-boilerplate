<?php

namespace WordpressPluginBoilerplate\Registers;

use WordpressPluginBoilerplate\Registers\hookTraits;

class Filters
{
    protected $filters;

    use hookTraits;

    public function __construct()
    {
        $this->filters = array();
    }

    public function add($hook = '', $component = '', $callback = '', $priority = 99, $accepted_args = '')
    {
        $this->addHook($this->filters, $hook, $component, $callback, $priority, $accepted_args);
    }

    public function run()
    {
        if (! $this->filters){
            return;
        }

        $this->runHooks($this->filters, 'filter');
    }
}