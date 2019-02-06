<?php
/*
Plugin Name: Primary Category
Plugin URI: https://getbutterfly.com/
Description: Set a primary category for all posts, including custom posts.
Author: Cameron Farquharson
Author URI: https://getbutterfly.com/
Version: 0.1
Text Domain: primary-category
*/

if (!defined('ABSPATH')) exit; // Exit if plugin is accessed directly

/**
 * Include meta box to be placed on post pages.
 */

include 'includes/category-meta.php';
//include 'includes/category-settings.php';

/**
 * Load JS
 * We only want primary categories to be available when the user edits a post or
 * creates a new post. Exits if not on appropriate page.
 */
function load_style($hook) {
    if (!in_array($hook, array('post.php', 'post-new.php'))) {
        return;
    }

    wp_enqueue_script('primary-category', plugins_url('js/functions.js', __FILE__), array('jquery'));
}
add_action('admin_enqueue_scripts', 'load_style');

/**
 * Create plugin options menu
 */
// function wppc_plugin_menu() {
//     add_options_page(__('Primary Category', 'wp-primary-category'), __('Primary Category', 'wp-primary-category'), 'manage_options', 'wppc_settings', 'wppc_settings');
// }
// add_action('admin_menu', 'wppc_plugin_menu');

/**
 * Install and set default options.
 */
function wppc_install() {
    add_option('wppc_primary_category', '');
}
register_activation_hook(__FILE__, 'wppc_install');
