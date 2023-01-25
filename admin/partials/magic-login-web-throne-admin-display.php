<?php

/**
 * Provide a admin area view for the plugin
 *
 * This file is used to markup the admin-facing aspects of the plugin.
 *
 * @link       https://web-throne.org
 * @since      1.0.0
 *
 * @package    Magic_Login_Web_Throne
 * @subpackage Magic_Login_Web_Throne/admin/partials
 */
?>

<!-- This file should primarily consist of HTML with a little bit of PHP. -->
<div class="wrap">
    <h1>Magic link login</h1>
    <form method="post" action="options.php">
        <?php settings_fields( 'mll-option-group' ); ?>
        <?php do_settings_sections( 'mll-option-group' ); ?>
        <table class="form-table">

            <tr valign="top">
                <th scope="row">Email (must inherit SMTP class later)</th>
                <td><input type="email" name="smtp_mail" value="<?php echo esc_attr( get_option('smtp_mail') ); ?>" /></td>
            </tr>

            <tr valign="top">
                <th scope="row">Password (must inherit SMTP class later)</th>
                <td><input type="password" name="smtp_password" value="<?php echo esc_attr( get_option('smtp_password') ); ?>" /></td>
            </tr>

        </table>
        
        <?php submit_button(); ?>
    </form>
</div>