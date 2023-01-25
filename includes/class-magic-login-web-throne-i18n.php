<?php

/**
 * Define the internationalization functionality
 *
 * Loads and defines the internationalization files for this plugin
 * so that it is ready for translation.
 *
 * @link       https://web-throne.org
 * @since      1.0.0
 *
 * @package    Magic_Login_Web_Throne
 * @subpackage Magic_Login_Web_Throne/includes
 */

/**
 * Define the internationalization functionality.
 *
 * Loads and defines the internationalization files for this plugin
 * so that it is ready for translation.
 *
 * @since      1.0.0
 * @package    Magic_Login_Web_Throne
 * @subpackage Magic_Login_Web_Throne/includes
 * @author     WebThrone <web-throne@gmail.com>
 */
class Magic_Login_Web_Throne_i18n {


	/**
	 * Load the plugin text domain for translation.
	 *
	 * @since    1.0.0
	 */
	public function load_plugin_textdomain() {

		load_plugin_textdomain(
			'magic-login-web-throne',
			false,
			dirname( dirname( plugin_basename( __FILE__ ) ) ) . '/languages/'
		);

	}



}
