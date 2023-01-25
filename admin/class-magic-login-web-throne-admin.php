<?php

/**
 * The admin-specific functionality of the plugin.
 *
 * @link       https://web-throne.org
 * @since      1.0.0
 *
 * @package    Magic_Login_Web_Throne
 * @subpackage Magic_Login_Web_Throne/admin
 */

/**
 * The admin-specific functionality of the plugin.
 *
 * Defines the plugin name, version, and two examples hooks for how to
 * enqueue the admin-specific stylesheet and JavaScript.
 *
 * @package    Magic_Login_Web_Throne
 * @subpackage Magic_Login_Web_Throne/admin
 * @author     WebThrone <web-throne@gmail.com>
 */
class Magic_Login_Web_Throne_Admin {

	/**
	 * The ID of this plugin.
	 *
	 * @since    1.0.0
	 * @access   private
	 * @var      string    $plugin_name    The ID of this plugin.
	 */
	private $plugin_name;

	/**
	 * The version of this plugin.
	 *
	 * @since    1.0.0
	 * @access   private
	 * @var      string    $version    The current version of this plugin.
	 */
	private $version;

	/**
	 * Initialize the class and set its properties.
	 *
	 * @since    1.0.0
	 * @param      string    $plugin_name       The name of this plugin.
	 * @param      string    $version    The version of this plugin.
	 */
	public function __construct( $plugin_name, $version ) {

		$this->plugin_name = $plugin_name;
		$this->version = $version;

	}

	/**
	 * Register the stylesheets for the admin area.
	 *
	 * @since    1.0.0
	 */
	public function enqueue_styles() {

		/**
		 * This function is provided for demonstration purposes only.
		 *
		 * An instance of this class should be passed to the run() function
		 * defined in Magic_Login_Web_Throne_Loader as all of the hooks are defined
		 * in that particular class.
		 *
		 * The Magic_Login_Web_Throne_Loader will then create the relationship
		 * between the defined hooks and the functions defined in this
		 * class.
		 */

		wp_enqueue_style( $this->plugin_name, plugin_dir_url( __FILE__ ) . 'css/magic-login-web-throne-admin.css', array(), $this->version, 'all' );

	}

	/**
	 * Register the JavaScript for the admin area.
	 *
	 * @since    1.0.0
	 */
	public function enqueue_scripts() {

		/**
		 * This function is provided for demonstration purposes only.
		 *
		 * An instance of this class should be passed to the run() function
		 * defined in Magic_Login_Web_Throne_Loader as all of the hooks are defined
		 * in that particular class.
		 *
		 * The Magic_Login_Web_Throne_Loader will then create the relationship
		 * between the defined hooks and the functions defined in this
		 * class.
		 */

		wp_enqueue_script( $this->plugin_name, plugin_dir_url( __FILE__ ) . 'js/magic-login-web-throne-admin.js', array( 'jquery' ), $this->version, false );

	}


	/**
	 * Create admin page
	 *
	 * @since    1.0.0
	 */
	public function testings() {

		/**
		 * This function is provided for demonstration purposes only.
		 *
		 * An instance of this class should be passed to the run() function
		 * defined in Magic_Login_Web_Throne_Loader as all of the hooks are defined
		 * in that particular class.
		 *
		 * The Magic_Login_Web_Throne_Loader will then create the relationship
		 * between the defined hooks and the functions defined in this
		 * class.
		 */

		echo "testing";
	}

	/**
	 * Register settings
	 * https://developer.wordpress.org/reference/functions/register_setting/
	 * @since    1.0.0
	 */
	public function register_mll_settings() {

		register_setting( 'mll-option-group', 'smtp_mail' );
		register_setting( 'mll-option-group', 'smtp_password' );

	}

	/**
	 * Create/Add admin menu page
	 * https://developer.wordpress.org/reference/functions/add_menu_page/
	 * @since    1.0.0
	 */
	public function mll_create_menu() {

		//create new top-level menu
		add_menu_page('Magic login options', 'Magic login', 'administrator', __FILE__, 'mll_settings_page_template' , 'dashicons-unlock' );
	
		function mll_settings_page_template() {
			include PLUGIN_PATH . 'admin/partials/magic-login-web-throne-admin-display.php';
		} 

	}

	/**
	 * Create new column in DB (wp_users) for token store
	 * Check later for /maybe_add_column( $queried_table, 'user_token', "ALTER TABLE $queried_table ADD user_token TEXT DEFAULT ''" );/
	 * @since    1.0.0
	 */
	public function mll_new_table_column() {

		global $wpdb;
		$queried_table = "{$wpdb->prefix}users";
		$query = $wpdb->get_results("SELECT mll_user_token FROM $queried_table");
	
		if( empty($query) ){
			$wpdb->query("ALTER TABLE $queried_table ADD mll_user_token TEXT DEFAULT ''");
		}
		// razmotrit mogucnost da se napravi posebna klasa za ove stvari
		// mogucnost za izbrisat columnu ako ne treba vise

	}


	public function debug_it () {

		var_dump(PLUGIN_PATH);

	}

}
