<?php

namespace WordpressPluginBoilerplate\Registers;

if ( ! defined( 'ABSPATH' ) ) exit;

/**
 * Actions and filters are just two different types of the same thing (hooks),
 * so they share some functions like add and run which will be executed in the same way.
 *
 * Trait hookTraits
 * @package WordpressPluginBoilerplate\Registers
 */
trait hookTraits
{
    /**
     * Add the hook`s info into the given array
     *
     * @param array $hooks
     * @param string $hook
     * @param string $component
     * @param string $callback
     * @param int $priority
     * @param string $accepted_args
     * @return array
     */
    public function addHook(&$hooks = array(), $hook = '', $component = '', $callback = '', $priority = 99, $accepted_args = '')
    {
        $hooks[] = array(
            'hook'          => $hook,
            'component'     => $component,
            'callback'      => $callback,
            'priority'      => $priority,
            'accepted_args' => $accepted_args
        );

        return $hooks;
    }

    /**
     * Register the hooks on Wordpress and execute them.
     *
     * @param array $hooks
     * @param string $type
     * @return array|bool|void
     */
    public function runHooks($hooks = array(), $type = 'action')
    {
        if(! $type){
            return;
        }

        //If the hook is no action or filter, quit.
        if ($type !== 'action' && $type !== 'filter'){
            return;
        }

        if (! function_exists('add_' . $type)){
            return false;
        }

        $executed = [];

        //Register and execute the hooks
        foreach($hooks as $hook){
            $executed[] = call_user_func('add_' . $type, $hook['hook'], $hook['component'], $hook['callback'], $hook['priority'], $hook['accepted_args']);
        }

        return $executed;
    }
}