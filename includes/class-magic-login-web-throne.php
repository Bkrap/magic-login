<?php

/**
 * The file that defines the core plugin class
 *
 * A class definition that includes attributes and functions used across both the
 * public-facing side of the site and the admin area.
 *
 * @link       https://web-throne.org
 * @since      1.0.0
 *
 * @package    Magic_Login_Web_Throne
 * @subpackage Magic_Login_Web_Throne/includes
 */

/**
 * The core plugin class.
 *
 * This is used to define internationalization, admin-specific hooks, and
 * public-facing site hooks.
 *
 * Also maintains the unique identifier of this plugin as well as the current
 * version of the plugin.
 *
 * @since      1.0.0
 * @package    Magic_Login_Web_Throne
 * @subpackage Magic_Login_Web_Throne/includes
 * @author     WebThrone <web-throne@gmail.com>
 */
class Magic_Login_Web_Throne {

	/**
	 * The loader that's responsible for maintaining and registering all hooks that power
	 * the plugin.
	 *
	 * @since    1.0.0
	 * @access   protected
	 * @var      Magic_Login_Web_Throne_Loader    $loader    Maintains and registers all hooks for the plugin.
	 */
	protected $loader;

	/**
	 * The unique identifier of this plugin.
	 *
	 * @since    1.0.0
	 * @access   protected
	 * @var      string    $plugin_name    The string used to uniquely identify this plugin.
	 */
	protected $plugin_name;

	/**
	 * The current version of the plugin.
	 *
	 * @since    1.0.0
	 * @access   protected
	 * @var      string    $version    The current version of the plugin.
	 */
	protected $version;

	/**
	 * Define the core functionality of the plugin.
	 *
	 * Set the plugin name and the plugin version that can be used throughout the plugin.
	 * Load the dependencies, define the locale, and set the hooks for the admin area and
	 * the public-facing side of the site.
	 *
	 * @since    1.0.0
	 */
	public function __construct() {
		if ( defined( 'MAGIC_LOGIN_WEB_THRONE_VERSION' ) ) {
			$this->version = MAGIC_LOGIN_WEB_THRONE_VERSION;
		} else {
			$this->version = '1.0.0';
		}
		$this->plugin_name = 'magic-login-web-throne';

		$this->load_dependencies();
		// $this->define_globals();
		$this->set_locale();
		$this->define_admin_hooks();
		$this->define_public_hooks();

	}

	// private function define_globals() {

	// 	$plugin_globals = new Magic_Login_Web_Throne_Globals();

	// 	$this->loader->add_action('init', $plugin_globals, 'get_js_globals');

	// }

	/**
	 * Load the required dependencies for this plugin.
	 *
	 * Include the following files that make up the plugin:
	 *
	 * - Magic_Login_Web_Throne_Loader. Orchestrates the hooks of the plugin.
	 * - Magic_Login_Web_Throne_i18n. Defines internationalization functionality.
	 * - Magic_Login_Web_Throne_Admin. Defines all hooks for the admin area.
	 * - Magic_Login_Web_Throne_Public. Defines all hooks for the public side of the site.
	 *
	 * Create an instance of the loader which will be used to register the hooks
	 * with WordPress.
	 *
	 * @since    1.0.0
	 * @access   private
	 */
	private function load_dependencies() {
		
		/**
		 * The class responsible for globals such as admin ajax path, etc.
		 * @since 1.0.1
		 */
		require_once plugin_dir_path( dirname( __FILE__ ) ) . 'includes/class-magic-login-web-throne-globals.php';

		/**
		 * The class responsible for orchestrating the actions and filters of the
		 * core plugin.
		 */
		require_once plugin_dir_path( dirname( __FILE__ ) ) . 'includes/class-magic-login-web-throne-loader.php';

		/**
		 * The class responsible for defining internationalization functionality
		 * of the plugin.
		 */
		require_once plugin_dir_path( dirname( __FILE__ ) ) . 'includes/class-magic-login-web-throne-i18n.php';

		/**
		 * The class responsible for defining all actions that occur in the admin area.
		 */
		require_once plugin_dir_path( dirname( __FILE__ ) ) . 'admin/class-magic-login-web-throne-admin.php';

		/**
		 * The class responsible for defining all actions that occur in the public-facing
		 * side of the site.
		 */
		require_once plugin_dir_path( dirname( __FILE__ ) ) . 'public/class-magic-login-web-throne-public.php';

		$this->loader = new Magic_Login_Web_Throne_Loader();

	}

	/**
	 * Define the locale for this plugin for internationalization.
	 *
	 * Uses the Magic_Login_Web_Throne_i18n class in order to set the domain and to register the hook
	 * with WordPress.
	 *
	 * @since    1.0.0
	 * @access   private
	 */
	private function set_locale() {

		$plugin_i18n = new Magic_Login_Web_Throne_i18n();

		$this->loader->add_action( 'plugins_loaded', $plugin_i18n, 'load_plugin_textdomain' );

	}

	/**
	 * Register all of the hooks related to the admin area functionality
	 * of the plugin.
	 *
	 * @since    1.0.0
	 * @access   private
	 */
	private function define_admin_hooks() {

		$plugin_admin = new Magic_Login_Web_Throne_Admin( $this->get_plugin_name(), $this->get_version() );

		$this->loader->add_action( 'admin_enqueue_scripts', $plugin_admin, 'enqueue_styles' );
		$this->loader->add_action( 'admin_enqueue_scripts', $plugin_admin, 'enqueue_scripts' );

		// Register option menu
		$this->loader->add_action( 'admin_menu', $plugin_admin, 'mll_create_menu' );
		$this->loader->add_action( 'admin_init', $plugin_admin, 'register_mll_settings' );

		// SQL mainly
		$this->loader->add_action( 'admin_init', $plugin_admin, 'mll_new_table_column' );

		// Debugger offroad.
		//$this->loader->add_action( 'admin_init', $plugin_admin, 'debug_it' );

	}

	/**
	 * Register all of the hooks related to the public-facing functionality
	 * of the plugin.
	 *
	 * @since    1.0.0
	 * @access   private
	 */
	private function define_public_hooks() {

		$plugin_public = new Magic_Login_Web_Throne_Public( $this->get_plugin_name(), $this->get_version() );

		$this->loader->add_action( 'wp_enqueue_scripts', $plugin_public, 'enqueue_styles' );
		$this->loader->add_action( 'wp_enqueue_scripts', $plugin_public, 'enqueue_scripts' );

		/**
		 * Form hooks
	 	 * @since    1.0.1
		 */
		$this->loader->add_action('init', $plugin_public, 'display_form');

		/**
		 * Form ajax hooks
	 	 * @since    1.0.1
		 */
		$this->loader->add_action('wp_ajax_check_user', $plugin_public, 'check_user');
		$this->loader->add_action('wp_ajax_nopriv_check_user', $plugin_public, 'check_user');

	}

	/**
	 * Run the loader to execute all of the hooks with WordPress.
	 *
	 * @since    1.0.0
	 */
	public function run() {
		$this->loader->run();
	}

	/**
	 * The name of the plugin used to uniquely identify it within the context of
	 * WordPress and to define internationalization functionality.
	 *
	 * @since     1.0.0
	 * @return    string    The name of the plugin.
	 */
	public function get_plugin_name() {
		return $this->plugin_name;
	}

	/**
	 * The reference to the class that orchestrates the hooks with the plugin.
	 *
	 * @since     1.0.0
	 * @return    Magic_Login_Web_Throne_Loader    Orchestrates the hooks of the plugin.
	 */
	public function get_loader() {
		return $this->loader;
	}

	/**
	 * Retrieve the version number of the plugin.
	 *
	 * @since     1.0.0
	 * @return    string    The version number of the plugin.
	 */
	public function get_version() {
		return $this->version;
	}

}
