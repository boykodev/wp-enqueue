<?php
/*
Plugin Name: WP Enqueue
Description: WordPress plugin to enqueue scripts and styles.
Version: 1.0.0
Author: Serge Boyko
Author URI: http://www.boykodev.com
*/

// create options page menu
function wpenq_create_menu() {
    // generate wp-enqueue menu
    add_options_page('WP Enqueue', 'WP Enqueue', 'manage_options', 'wpenq-menu', 'wpenq_menu');

    // activate custom settings
    add_action('admin_init', 'wpenq_custom_settings');
}

add_action('admin_menu', 'wpenq_create_menu');

function wpenq_custom_settings() {
    /* Register settings */
    register_setting('wpenq-settings-group', 'wpenq_scripts_handle');
    register_setting('wpenq-settings-group', 'wpenq_scripts_path');
    register_setting('wpenq-settings-group', 'wpenq_styles_handle');
    register_setting('wpenq-settings-group', 'wpenq_styles_path');

    /* Add sections */
    add_settings_section('wpenq-scripts', 'WP Enqueue Scripts', 'wpenq_scripts', 'wpenq-menu');
    add_settings_section('wpenq-styles', 'WP Enqueue Styles', 'wpenq_styles', 'wpenq-menu');
}

/* callback functions with content */
include_once('callbacks.php');

// load scripts test
function load_scripts() {
    $handle = 'wpenq_scripts_handle';
    $path = 'wpenq_scripts_path';

    $handle_option = get_option($handle);
    $path_option = get_option($path);

    $index = 0; // TODO multiple scripts

    $handle_value = (isset($handle_option[$index])) ? esc_attr($handle_option[$index]) : '';
    $path_value = (isset($path_option[$index])) ? esc_attr($path_option[$index]) : '';

    if ($handle_value && $path_value) {
        wp_enqueue_script($handle_value, get_template_directory_uri() . $path_value);
    }
}

add_action('wp_enqueue_scripts', 'load_scripts');