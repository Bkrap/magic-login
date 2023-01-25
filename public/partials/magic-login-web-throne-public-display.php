<?php

/**
 * Provide a public-facing view for the plugin
 *
 * This file is used to markup the public-facing aspects of the plugin.
 *
 * @link       https://web-throne.org
 * @since      1.0.0
 *
 * @package    Magic_Login_Web_Throne
 * @subpackage Magic_Login_Web_Throne/public/partials
 */
?>

<!-- This file should primarily consist of HTML with a little bit of PHP. -->
<form method="POST" class="login-ajax-form needs-validation" style="margin-top: 200px;">
    <!-- <input type="hidden" id="g-recaptcha-response" name="g-recaptcha-response">
    <input type="hidden" name="action" value="validate_captcha"> -->
    <div class="col-12 col-md-6">
        <input type="email" required class="form-control email form-control" id="magic-email" name="email" placeholder="" value="">
        <input type="hidden" id="clickedUrl" value="" name="clicked-url">
    </div>

    <div class="col-12 col-md-10 d-flex">
        <div class="btn-wrapper">
            <input type="submit" class="login btn btn-primary" name="login" value="Submit" />
        </div>
        <div id="loading">
            <img src="" />  
        </div>
    </div>
</form>