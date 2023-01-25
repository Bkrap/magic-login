<?php
class Mll_Custom_Form_Shortcode {

    public function __construct() {
        add_shortcode( 'mll-display-login-form', array( $this, 'mll_custom_form_shortcode' ) );
    }

    public function mll_custom_form_shortcode() {
		include PLUGIN_PATH . 'public/partials/magic-login-web-throne-public-display.php'; // konstantu promjeni
    }

}

