<?php

function plugin_assets($hook) {
    global $wpenq_page;
    // enqueue only for wp-enqueue page
    if ($hook != $wpenq_page) return;

    $url = plugin_dir_url(__FILE__);
    wp_enqueue_script('wpenq_script', $url . 'assets/script.js');
    wp_enqueue_style('wpenq_style', $url . 'assets/style.css');
}

add_action('admin_enqueue_scripts', 'plugin_assets');