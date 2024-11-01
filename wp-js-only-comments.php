<?php

/*
Plugin Name: WP JS Only Comments
Plugin URI:  http://jurnal.drona.ro
Description: This plugin allows comments to be posted only with Javascript. This way you can prevent 99.9999999% of SPAM comments to be posted.
Version:     1.0
Author:      Maxim Ioan
Author URI:  maxim_ioan@yahoo.com
License:     MIT
License URI: https://opensource.org/licenses/MIT
Domain Path: /languages
Text Domain: wp-js-only-comments
*/

defined( 'ABSPATH' ) or die( 'No script kiddies please!' );

class wp_js_only_comments {
    
    // Render a hidden form field in the comments form. Also add js to populate field just before submit.
    static function render_hidden_comments_form_field() {
        echo '<script type="text/javascript">';
        echo '<!--', "\n";
        echo 'jQuery("#commentform").on("submit", function(event) {';
        echo '    jQuery("#wp-js-only-comments-field").val("dhgdgfh3453dfg");';
        echo '    console.log("submit done")';
        echo '});';
        echo "\n", '//--></script>';
        echo '<p class="comment-form-wp-js-only-comments-field" style="display:none"> <input id="wp-js-only-comments-field" name="wp-js-only-comments-field" type="text" value="" size="30"></p>';
    }
    
    // Check the hidden field is populated. This means js was executed and so only comments posted with js enabled will pass.
    // This will prevent post from SPAM robots.
    static function check_hidden_comments_form_field() {
        if ( $_POST['wp-js-only-comments-field'] !== 'dhgdgfh3453dfg') {
            wp_die('Go back.');
        };
    }
    
    
};

add_action('comment_form_before_fields', array('wp_js_only_comments', 'render_hidden_comments_form_field'));
add_action('pre_comment_on_post', array('wp_js_only_comments', 'check_hidden_comments_form_field'));
?>