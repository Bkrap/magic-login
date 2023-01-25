<?php

/**
 * Set global paths for JS like admin ajax and etc..
 *
 * @since      1.0.1
 * @package    Magic_Login_Web_Throne
 * @subpackage Magic_Login_Web_Throne/includes
 * @author     WebThrone <web-throne@gmail.com>
 */
class Magic_Login_Web_Throne_Globals {

    public function get_js_globals() { ?>

        <script type="text/javascript" id="magic_login_web_throne_globals">
            var magic_login_web_throne_homeUrl = '<?php echo get_template_directory_uri(); ?>';
            // var magic_login_web_throne_curr_post_id = '<?php // echo $post->ID; ?>';
            var magic_login_web_throne_admin_ajax = '<?php echo admin_url('admin-ajax.php'); ?>';
            //var totalHeight = jQuery('header').height() + jQuery('#post-list').height();
        </script>

    <?php
    }

}
