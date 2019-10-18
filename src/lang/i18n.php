<?php

namespace WordpressPluginBoilerplate\Lang;

if ( ! defined( 'ABSPATH' ) ) exit;

class i18n
{
    /**
     * Load the plugin text domain for translation.
     */
    public function load($pluginName = '', $dir = '') {

        load_plugin_textdomain(
            $pluginName,
            false,
            $dir . 'src/app/languages'
        );

    }
}