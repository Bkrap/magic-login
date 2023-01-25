<?php

/**
 * The public-facing functionality of the plugin.
 *
 * @link       https://web-throne.org
 * @since      1.0.0
 *
 * @package    Magic_Login_Web_Throne
 * @subpackage Magic_Login_Web_Throne/public
 */

/**
 * The public-facing functionality of the plugin.
 *
 * Defines the plugin name, version, and two examples hooks for how to
 * enqueue the public-facing stylesheet and JavaScript.
 *
 * @package    Magic_Login_Web_Throne
 * @subpackage Magic_Login_Web_Throne/public
 * @author     WebThrone <web-throne@gmail.com>
 */
class Magic_Login_Web_Throne_Public {

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
	 * @param      string    $plugin_name       The name of the plugin.
	 * @param      string    $version    The version of this plugin.
	 */
	public function __construct( $plugin_name, $version ) {

		$this->plugin_name = $plugin_name;
		$this->version = $version;

	}

	/**
	 * Register the stylesheets for the public-facing side of the site.
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

		wp_enqueue_style( $this->plugin_name, plugin_dir_url( __FILE__ ) . 'css/magic-login-web-throne-public.css', array(), $this->version, 'all' );

	}

	/**
	 * Register the JavaScript for the public-facing side of the site.
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

		wp_enqueue_script( $this->plugin_name, plugin_dir_url( __FILE__ ) . 'js/magic-login-web-throne-public.js', array( 'jquery' ), $this->version, false );
		wp_enqueue_script( $this->plugin_name . "-ajax", plugin_dir_url( __FILE__ ) . 'js/magic-login-web-throne-public-ajax.js', array( 'jquery' ), $this->version, false );

	}


	/**
	 * Initilaize form to login/register
	 *
	 * @since    1.0.0
	 */
	public function display_form() {

		include PLUGIN_PATH . 'public/partials/magic-login-web-throne-public-display.php';

	}


	/**
	 * Debug SMTP mail
	 *
	 * @since    1.0.0
	 */
	public function debug_wpmail( $result = false ) {

		if ( $result )
			return;

		global $ts_mail_errors, $phpmailer;

		if ( ! isset($ts_mail_errors) )
			$ts_mail_errors = array();

		if ( isset($phpmailer) )
			$ts_mail_errors[] = $phpmailer->ErrorInfo;

		print_r('<pre>');
		print_r($ts_mail_errors);
		print_r('</pre>');
	}


	/**
	 * Send Magic Login link
	 *
	 * @since    1.0.0
	 */
	public function sendMagicLogin( $emailTo, $token, $ServerURL, $redirect_link ) {
		$email_group = "www@test-online.biz";
		$mail_text_group = "hey";
		// $to = "brunokrapljan97@gmail.com";
		$subject = 'Studienwahl';
		$body =  "c";
		$headers = array('Content-Type: text/html; charset=UTF-8');
		$headers[] = "From: name <www@test-online.biz>";
	
		$res = wp_mail( $emailTo, $subject, $body, $headers );
		$this->debug_wpmail($res); // Will print_r array of errors
		die;
	}


	/**
	 * Check user if exists
	 *
	 * @since    1.0.0
	 */
	public function check_user() {

		$emailTo = $_POST['email'];
		$redirect_link =  ""; //$_POST['redirectLink'];
		//Generate Token
		$token = bin2hex(random_bytes(16));
		$ServerURL = home_url('/');
		/********************************************** */
		// create token column in DB
		global $wpdb;
		$queried_table = "{$wpdb->prefix}users";
		$query = $wpdb->get_results("SELECT mll_user_token FROM $queried_table");
	
		if( empty($query) ){
			$wpdb->query("ALTER TABLE $queried_table ADD mll_user_token TEXT DEFAULT ''");
		}
		$query = $wpdb->get_results( "SELECT * FROM $queried_table WHERE user_email='$emailTo'" );
		if (!empty( $query )) {
		    //If the Email is Present
		    // Insert Token into User Table
		    $wpdb->query( "UPDATE $queried_table SET mll_user_token='$token' WHERE user_email='$emailTo'" );
			// myErr("UPDATE $queried_table SET user_token='$token' WHERE user_email='$emailTo'");
			echo "user-exists";
		    $this->sendMagicLogin($emailTo, $token, $ServerURL, $redirect_link); // remove this debug to logic work
		} else {
			echo "user-not-exists";
		}
	
	
	}

}
