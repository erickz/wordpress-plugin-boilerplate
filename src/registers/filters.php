<?php

namespace WordpressPluginBoilerplate\Registers;

if ( ! defined( 'ABSPATH' ) ) exit;

/**
 * It's responsible for registering and executing the Plugin`s filters
 *
 * Class Actions
 * @package WordpressPluginBoilerplate\Registers
 */
class Filters
{
    protected $filters;

    use hookTraits;

    public function __construct()
    {
        $this->filters = array();
    }

    /**
     * Add the filter hook into a array which will be executed later
     *
     * @param string $hook
     * @param string $component
     * @param string $callback
     * @param int $priority
     * @param string $accepted_args
     * @return array
     */
    public function add($hook = '', $component = '', $callback = '', $priority = 99, $accepted_args = '')
    {
        $this->addHook($this->filters, $hook, $component, $callback, $priority, $accepted_args);
    }

    /**
     * Executes all the stored filters of the plugin
     *
     * @return array|bool|void
     */
    public function run()
    {
        if (! $this->filters){
            return;
        }

        $this->runHooks($this->filters, 'filter');
    }
}