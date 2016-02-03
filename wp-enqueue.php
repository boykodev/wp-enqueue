<?php
/*
Plugin Name: WP Enqueue
Description: WordPress plugin to enqueue scripts and styles.
Version: 1.0.0
Author: Serge Boyko
Author URI: http://www.boykodev.com
*/

// create options page menu
function wp_enqueue_create_menu() {
    // generate wp-enqueue menu
    add_options_page('WP Enqueue', 'WP Enqueue', 'manage_options', 'wp-enqueue-menu', 'wp_enqueue_menu_content');

    // activate custom settings
    add_action('admin_init', 'wp_enqueue_custom_settings');
}

add_action('admin_menu', 'wp_enqueue_create_menu');

function wp_enqueue_custom_settings() {
    register_setting('wp-enqueue-settings-group', 'name');
    add_settings_section('wp-enqueue-scripts', 'WP Enqueue Scripts', 'wp_enqueue_scripts_content', 'wp-enqueue-menu');
    add_settings_section('wp-enqueue-styles', 'WP Enqueue Styles', 'wp_enqueue_styles_content', 'wp-enqueue-menu');
}

/* callback functions with content */
function wp_enqueue_menu_content() {
    require_once('menu-template.php');
}

function wp_enqueue_scripts_content() {
    echo 'scripts';
}

function wp_enqueue_styles_content() {
    echo 'styles';
}

// load scripts test
function load_scripts() {
    wp_enqueue_script('script', get_template_directory_uri() . '/js/script.js');
}

add_action('wp_enqueue_scripts', 'load_scripts');