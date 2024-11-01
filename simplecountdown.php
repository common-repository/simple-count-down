<?php
/**
 * @package simplecountdown
 * @author Michael Henke
 * @version 1.4.1
 */
/*
Plugin Name: Simple Count Down
Plugin URI: http://wordpress.org/extend/plugins/simple-count-down/
Description: Simple configurable widgetized count down plugin. Use the <a href="widgets.php">widgets options</a> to integrate the plugin and see the <a href="plugins.php?page=simple_count_down-config">administration panel</a> for further configuration.
Version: 1.4.1
Author: Michael Henke
Author URI: http://www.hasenha.us
*/

function simplecountdown_myFeature() {
    echo $_SESSION['simple_count_down_string'];
}

function simplecountdown_control() {

    $options = get_option("simplecountdown");

    if (!is_array( $options )) {
        $options = array(
            'title' => 'Countdown'
        );
    }

    if ($_POST['simplecountdown-submit']) {
        $options['title'] = htmlspecialchars($_POST['simplecountdown-title']);

        update_option("simplecountdown", $options);
    }
    
?>
<p>
<label for="simplecountdown-title">Title: </label><br />
<input class="widefat" type="text" id="simplecountdown-title" name="simplecountdown-title" value="<?php echo $options['title'];?>" />
<input type="hidden" id="simplecountdown-submit" name="simplecountdown-submit" value="1" />
<?php

    echo "<br />Please use the administration panel to further <a href=\"plugins.php?page=simple_count_down-config\">configure the plugin</a>.";
}

register_sidebar_widget ( "Simple Count Down", simplecountdown_myFeature );
register_widget_control ( "Simple Count Down", simplecountdown_control );

add_action('admin_menu', 'simplecountdown_config_page');

//add_menu_page(page_title, menu_title, capability, handle, [function], [icon_url]); 
function simplecountdown_config_page() {

    add_submenu_page('plugins.php', __('Simple Count Down'), __('Simple Count Down'), 'manage_options', 'simple_count_down-config', 'simple_count_down_options');
    
}

function simple_count_down_options() {

?><div class="wrap simple-count-down-wrap">
    <div class="simple-count-down-left" style="float: left;width:70%;">
    <div id="icon-options-general" class="icon32"><br></div>
    <h2>Simple Count Down Settings</h2>
    <form method="post" action="options.php"><?php wp_nonce_field('update-options'); ?>
        <table class="form-table">
            <tr valign="top">
                <th scope="row">Target Date</th>
                <td>
                    <input maxlength="2" size="2" type="text" name="simple-count-down-date-day" value="<?php echo get_option('simple-count-down-date-day'); ?>" />.
                    <input maxlength="2" size="2" type="text" name="simple-count-down-date-month" value="<?php echo get_option('simple-count-down-date-month'); ?>" />.
                    <input maxlength="4" size="4" type="text" name="simple-count-down-date-year" value="<?php echo get_option('simple-count-down-date-year'); ?>" />
                    <br />
                    Insert day, month and year.
                </td>
            </tr><tr>
                <th scope="row">Text String</th>
                <td>
                    <input type="text" name="simple-count-down-text-string" value="<?php echo get_option('simple-count-down-text-string'); ?>" />
                    <br />
                    %N or %n will be replaced with the resulting string. The result will become negative if the date is in the past.
                </td>
            </tr>
            <tr valign="top">
                <th scope="row">Example</th><td><em>Our Wedding will be in %N more days.</em> or
                    <br /><em>In %n days our baby will be born.</em></td>
            </tr>
        </table>
        <h2>Advanced Settings</h2>
        <table class="form-table">
            <tr valign="top">
                <th scope="row">Use Cache</th>
                <td><input type="checkbox" name="simple-count-down-use-cache" <?php if (get_option('simple-count-down-use-cache')) { echo ' checked'; } ?>/>
                           <br />
                           Caching will be used if available. If caching is not available, this option is ignored.<br />
                           Caching speeds up subsequent page hits but might result in false value.
            </tr>
        </table>

    <p class="submit">
    <input type="submit" class="button-primary" value="Save Changes" />
    <input type="reset" class="button" value="Reset" />
    </p>

    <input type="hidden" name="action" value="update" />
    <input type="hidden" name="page_options" value="simple-count-down-use-cache,simple-count-down-text-string,simple-count-down-date-day,simple-count-down-date-month,simple-count-down-date-year" />
    </form>
    </div>
    <div class="simple-count-down-right" style="float: right;width: 29%;">
        <h2>Donate</h2>
        <p>You can chip in to my wedding budget by donating some cents via <a href="https://www.paypal.com/cgi-bin/webscr?cmd=_s-xclick&hosted_button_id=EDYMBPA7PYGYG" target="_blank" title="Please Donate. Thank you!">Paypal</a>.</p>
        <div style="text-align: center;">
            <form action="https://www.paypal.com/cgi-bin/webscr" method="post">
                <input type="hidden" name="cmd" value="_s-xclick" />
                <input type="hidden" name="hosted_button_id" value="EDYMBPA7PYGYG" />
                <input type="image" src="<?php echo get_bloginfo('wpurl') . '/wp-content/plugins/simple-count-down/img/lapyap_etanod_GL.gif';?>" name="submit" alt="PayPal - The safer, easier way to pay online!" />
                <img alt="" border="0" src="https://www.paypal.com/en_US/i/scr/pixel.gif" width="1" height="1">
            </form>
        </div>
        <p>My fiancée and I are blogging (in german language) about our wedding at: <a href="http://www.hasenha.us/" target="_blank">www.hasenha.us</a></p>
        <p>This is also the blog this plugin was initally developed for.</p>
        <p align="center">
        <script type="text/javascript">
            var flattr_uid = "der_michael";
            var flattr_tle = "Wordpress Simple Count Down plugin";
            var flattr_dsc = "Simple configurable widgetized count down plugin.";
            var flattr_cat = "software";
            var flattr_tag = "wordpress,plugin,countdown";
            var flattr_url = "http://wordpress.org/extend/plugins/simple-count-down/";
        </script>
        <script src="http://api.flattr.com/button/load.js" type="text/javascript"></script>
        </p>
    </div>
    <div class="simple-count-down-bottom" style="clear: both;" width="100%">
        Version&nbsp;1.3
    </div>
    </div>
<?php
}

function  addHeaderCode() {

    echo '<link type="text/css" rel="stylesheet" href="' . get_bloginfo('wpurl') . '/wp-content/plugins/simple-count-down/css/custom.css" />' . "\n";

    #if (function_exists('wp_enqueue_script')) {
    #    wp_enqueue_script('devlounge_plugin_series', get_bloginfo('wpurl') . '/wp-content/plugins/devlounge-plugin-series/js/devlounge-plugin-series.js', array('prototype'), '0.1');
    #}
}

function  addAdminHeaderCode() {

    echo '<link type="text/css" rel="stylesheet" href="' . get_bloginfo('wpurl') . '/wp-content/plugins/simple-count-down/css/admin-custom.css" />' . "\n";

    #if (function_exists('wp_enqueue_script')) {
    #    wp_enqueue_script('devlounge_plugin_series', get_bloginfo('wpurl') . '/wp-content/plugins/devlounge-plugin-series/js/devlounge-plugin-series.js', array('prototype'), '0.1');
    #}
}

add_action( 'wp_head', 'addHeaderCode' );
add_action( 'admin_head', 'addAdminHeaderCode' );

function precalculate() {

    if(!get_option('simple-count-down-use-cache') || ($_SESSION['simple_count_down_string'] == "")) {
        
        // int mktime  ([  int $hour = date("H")  [,  int $minute = date("i")  [,  int $second = date("s")  [,  int $month = date("n")  [,  int $day = date("j")  [,  int $year = date("Y")  [,  int $is_dst = -1  ]]]]]]] )
        $target_time_stamp = mktime(2,30,0,get_option('simple-count-down-date-month'),get_option('simple-count-down-date-day'),get_option('simple-count-down-date-year'));

        $seconds = $target_time_stamp - time();

        if ($seconds > 0) {

            $days = ceil($seconds / 60 / 60 / 24 );

            $string = preg_replace('/%[n|N]/', '<strong>'.$days.'</strong>', htmlentities(get_option('simple-count-down-text-string'), ENT_QUOTES, get_bloginfo('charset')));

            $options = get_option("simplecountdown");

            $_SESSION['simple_count_down_string'] = $before_widget .
                                                    $before_title .
                                                    $options['title'] .
                                                    $after_title .
                                                    '<ul><li id="simple-count-down-li">'. $string .'</li></ul>' .
                                                    $after_widget;
        } else {
            $_SESSION['simple_count_down_string'] = "";
        }
    }

    //echo $_SESSION['simple_count_down_string'];

}

add_action( 'get_header', 'precalculate' );


//Default Options
add_option('simple-count-down-date-day', 23);
add_option('simple-count-down-date-month', 11);
add_option('simple-count-down-date-year', 2010);
add_option('simple-count-down-use-cache', true);
add_option('simple-count-down-text-string', 'Our wedding will be in %n days.');

$options = get_option("simplecountdown");
if (!is_array( $options )) {
    $options = array(
        'title' => 'Countdown'
    );

    update_option("simplecountdown", $options);
}
?>
