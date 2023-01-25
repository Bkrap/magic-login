<?php

/**
 * The plugin bootstrap file
 *
 * This file is read by WordPress to generate the plugin information in the plugin
 * admin area. This file also includes all of the dependencies used by the plugin,
 * registers the activation and deactivation functions, and defines a function
 * that starts the plugin.
 *
 * @link              https://web-throne.org
 * @since             1.0.0
 * @package           Magic_Login_Web_Throne
 *
 * @wordpress-plugin
 * Plugin Name:       Magic login WebThrone
 * Plugin URI:        https://web-throne.org
 * Description:       desc
 * Version:           1.0.0
 * Author:            WebThrone
 * Author URI:        https://web-throne.org
 * License:           GPL-2.0+
 * License URI:       http://www.gnu.org/licenses/gpl-2.0.txt
 * Text Domain:       magic-login-web-throne
 * Domain Path:       /languages
 */

// If this file is called directly, abort.
if ( ! defined( 'WPINC' ) ) {
	die;
}

/**
 * Currently plugin version.
 * Start at version 1.0.0 and use SemVer - https://semver.org
 * Rename this for your plugin and update it as you release new versions.
 */
define( 'MAGIC_LOGIN_WEB_THRONE_VERSION', '1.0.0' );
define( 'PLUGIN_PATH', plugin_dir_path( __FILE__ ) );

/**
 * The code that runs during plugin activation.
 * This action is documented in includes/class-magic-login-web-throne-activator.php
 */
function activate_magic_login_web_throne() {
	require_once plugin_dir_path( __FILE__ ) . 'includes/class-magic-login-web-throne-activator.php';
	Magic_Login_Web_Throne_Activator::activate();
}

/**
 * The code that runs during plugin deactivation.
 * This action is documented in includes/class-magic-login-web-throne-deactivator.php
 */
function deactivate_magic_login_web_throne() {
	require_once plugin_dir_path( __FILE__ ) . 'includes/class-magic-login-web-throne-deactivator.php';
	Magic_Login_Web_Throne_Deactivator::deactivate();
}

register_activation_hook( __FILE__, 'activate_magic_login_web_throne' );
register_deactivation_hook( __FILE__, 'deactivate_magic_login_web_throne' );

/**
 * The core plugin class that is used to define internationalization,
 * admin-specific hooks, and public-facing site hooks.
 */
require plugin_dir_path( __FILE__ ) . 'includes/class-magic-login-web-throne.php';

/**
 * Begins execution of the plugin.
 *
 * Since everything within the plugin is registered via hooks,
 * then kicking off the plugin from this point in the file does
 * not affect the page life cycle.
 *
 * @since    1.0.0
 */
function run_magic_login_web_throne() {

	$plugin = new Magic_Login_Web_Throne();
	$plugin->run();

}
run_magic_login_web_throne();
