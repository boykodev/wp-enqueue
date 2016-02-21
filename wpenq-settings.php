<?php

// create options page menu
function wpenq_create_menu() {
    global $wpenq_page;
    // generate wp-enqueue menu
    $wpenq_page = add_options_page('WP Enqueue', 'WP Enqueue', 'manage_options', 'wpenq-menu', 'wpenq_menu');

    // activate custom settings
    add_action('admin_init', 'wpenq_custom_settings');
}

add_action('admin_menu', 'wpenq_create_menu');

function wpenq_custom_settings() {
    /* Register settings */
    register_setting('wpenq-settings-group', 'wpenq_scripts_path');
    register_setting('wpenq-settings-group', 'wpenq_scripts_cond');
    register_setting('wpenq-settings-group', 'wpenq_styles_path');
    register_setting('wpenq-settings-group', 'wpenq_styles_cond');

    /* Add sections */
    add_settings_section('wpenq-scripts', 'WP Enqueue Scripts', 'wpenq_scripts', 'wpenq-menu');
    add_settings_section('wpenq-styles', 'WP Enqueue Styles', 'wpenq_styles', 'wpenq-menu');
}

/* callback functions with content */
function wpenq_menu() {
    require_once('templates/menu.php');
}

function wpenq_scripts() {
    require_once('templates/scripts.php');
}

function wpenq_styles() {
    require_once('templates/styles.php');
}