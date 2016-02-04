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
    add_options_page('WP Enqueue', 'WP Enqueue', 'manage_options', 'wpenq-menu', 'wpenq_menu_content');

    // activate custom settings
    add_action('admin_init', 'wpenq_custom_settings');
}

add_action('admin_menu', 'wpenq_create_menu');

function wpenq_custom_settings() {
    register_setting('wpenq-settings-group', 'wpenq_title');
    // scripts section
    add_settings_section('wpenq-scripts', 'WP Enqueue Scripts', 'wpenq_scripts_content', 'wpenq-menu');
    add_settings_field('wpenq-scripts-title', 'Script Title', 'wpenq_scripts_title_content', 'wpenq-menu', 'wpenq-scripts');
    // styles section TODO
    //add_settings_section('wpenq-styles', 'WP Enqueue Styles', 'wpenq_styles_content', 'wpenq-menu');
}

/* callback functions with content */
function wpenq_scripts_title_content() {
    $title = esc_attr(get_option('wpenq_title'));
    echo '<input type="text" name="wpenq_title" value="'.$title.'">';
}

function wpenq_menu_content() {
    require_once('menu-template.php');
}

function wpenq_scripts_content() {
    echo '<p>Add custom scripts here:</p>';
}

/* TODO
function wpenq_styles_content() {
    echo 'styles';
}*/

// load scripts test
function load_scripts() {
    wp_enqueue_script('script', get_template_directory_uri() . '/js/script.js');
}

add_action('wp_enqueue_scripts', 'load_scripts');