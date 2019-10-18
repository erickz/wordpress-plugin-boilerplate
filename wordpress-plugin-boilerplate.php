<?php

/**
 * The plugin bootstrap file
 *
 * This file is read by WordPress to generate the plugin information in the plugin
 * admin area. This file also includes all of the dependencies used by the plugin,
 * registers the activation and deactivation functions, and defines a function
 * that starts the plugin.
 *
 * @link              http://example.com
 * @since             1.0.0
 * @package           Wordpress Plugin Boilerplate
 *
 * @wordpress-plugin
 * Plugin Name:       Wordpress Plugin Boilerplate
 * Plugin URI:
 * Description:       This is a plugin boilerplate which serves as a model and has some functions to help the developing of wordpress plugins
 * Version:           1.0.0
 * Author:            Erick C. de São Miguel
 * Author URI:        http://github.com/erickz
 * License:           GPL-2.0+
 * License URI:       http://www.gnu.org/licenses/gpl-2.0.txt
 * Text Domain:       wordpress-plugin-boilerplate
 */

// If this file is called directly, abort.
if ( ! defined( 'WPINC' ) ) {
    die;
}

//Loads the current directory of the plugin
$thisDir = plugin_dir_path( __FILE__ );

$config = false;

//Load the configs
if (file_exists($thisDir . 'config.php')){
    $config = include($thisDir . 'config.php');

    //The plugin file which is executed by wordpress to fire the plugin
    $config['file'] = __FILE__ ;

    $config['dir'] = $thisDir;
}

//If the configs aren't set, then
if (! $config){
    die;
}

require $config['dir'] . 'vendor/autoload.php';
require $config['dir'] . 'src/bootstrap/app.php';

$pluginApp = new PluginApp($config);
$pluginApp->execute();

unset($config);