<?php

namespace WordpressPluginBoilerplate\Registers;

if ( ! defined( 'ABSPATH' ) ) exit;

/**
 * It's responsible for registering and executing the Plugin`s actions
 *
 * Class Actions
 * @package WordpressPluginBoilerplate\Registers
 */
class Actions
{
    protected $actions;

    use hookTraits;

    public function __construct()
    {
        $this->actions = array();
    }

    /**
     * Add the action hook into a array which will be executed later
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
        return $this->addHook($this->actions, $hook, $component, $callback, $priority, $accepted_args);
    }

    /**
     * Executes all the stored actions of the plugin
     *
     * @return array|bool|void
     */
    public function run()
    {
        if (! $this->actions){
            return;
        }

        return $this->runHooks($this->actions);
    }
}