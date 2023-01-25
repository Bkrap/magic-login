<?php


/**
 * Set global paths for JS like admin ajax and etc..
 *
 * @since      1.0.1
 * @package    Magic_Login_Web_Throne
 * @subpackage Magic_Login_Web_Throne/includes
 * @author     WebThrone <web-throne@gmail.com>
 */


class Mll_Ajax_Form {

    public function __construct() {
        add_action('wp_ajax_hihi', 'hihi'); 
        add_action('wp_ajax_nopriv_hihi', 'hihi'); 
    }
    public function hihi() {
        // print_r("heii! :)");
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