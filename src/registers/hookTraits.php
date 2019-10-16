<?php

namespace WordpressPluginBoilerplate\Registers;

trait hookTraits
{
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

    public function runHooks($hooks = array(), $type = 'action')
    {
        if(! $type){
            return;
        }

        if ($type !== 'action' && $type !== 'filter'){
            return;
        }

        if (! function_exists('add_' . $type)){
            return false;
        }

        foreach($hooks as $hook){
            $daora = call_user_func('add_' . $type, $hook['hook'], $hook['component'], $hook['callback'], $hook['priority'], $hook['accepted_args']);
        }
    }
}