<?php

// load scripts test
function load_scripts() {
    $handle = 'wpenq_scripts_handle';
    $path = 'wpenq_scripts_path';

    $handle_option = get_option($handle);
    $path_option = get_option($path);

    $index = 0; // TODO multiple scripts

    $path_value = (isset($path_option[$index])) ? esc_attr($path_option[$index]) : '';

    if ($path_value) {
        wp_enqueue_script('wpenq_script', get_template_directory_uri() . $path_value);
    }
}

add_action('wp_enqueue_scripts', 'load_scripts');