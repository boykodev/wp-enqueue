<?php

// load styles
function wpenq_load_styles() {
    $path = 'wpenq_styles_path';
    $cond = 'wpenq_styles_cond';
    $path_option = get_option($path);
    $cond_option = get_option($cond);

    // prevent empty options warning
    if ($path_option && $cond_option) {

        $result = array_map_duplicates($path_option, $cond_option);

        foreach ($result as $key => $values) {
            foreach ($values as $value) {
                if ($key == 'admin') {
                    // enq admin
                } elseif (strpos($key, 'IE') !== false) {
                    // enq ie
                }
            }
        }

    }
}

// load scripts
function wpenq_load_scripts() {
    $path = 'wpenq_styles_path';
    $cond = 'wpenq_styles_cond';
    $path_option = get_option($path);
    $cond_option = get_option($cond);

    // prevent empty options warning
    if ($path_option && $cond_option) {

        $result = array_map_duplicates($path_option, $cond_option);

        foreach ($result as $key => $values) {
            foreach ($values as $value) {
                if ($key == 'head') {
                    // enq head
                } elseif ($key == 'footer') {
                    // enq footer
                } elseif ($key == 'admin') {
                    // enq admin
                } elseif (strpos($key, 'IE') !== false) {
                    // enq ie
                }
            }
        }

    }
}

function wpenq_load() {
    wpenq_load_styles();
    wpenq_load_scripts();
}

add_action('wp_enqueue_scripts', 'wpenq_load');

/**
 * Map values of one array to another,
 * preserving duplicate keys.
 *
 * @return array Mapped array.
 */
function array_map_duplicates($arr_vals, $arr_keys) {
    $result = array();
    foreach ($arr_keys as $key => $value) {
        $result[$value][] = $arr_vals[$key];
    }
    return $result;
}