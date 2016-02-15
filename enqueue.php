<?php

function enqueue_frontend() {
    global $wpenq;

    $scripts = $wpenq->get_option_map('scripts');
    if ($scripts) {
        $index = 0;

        foreach ((array)$scripts as $key => $values) {
            foreach ((array)$values as $value) {

                $value = get_template_directory_uri() . $value;
                if ($key != 'admin') $index++; // admin scripts don't affect counter
                if ($key == 'head') wp_enqueue_script("wpenq-script-$index", $value);
                if ($key == 'footer') wp_enqueue_script("wpenq-script-$index", $value, false, false, true);
                if (strpos($key, 'IE') !== false) {
                    wp_enqueue_script("wpenq-script-$index", $value);
                    wp_script_add_data("wpenq-script-$index", 'conditional', 'lt ' . $key);
                }

            }
        }

    }

    $styles = $wpenq->get_option_map('styles');
    if ($styles) {
        $index = 0;

        foreach ((array)$styles as $key => $values) {
            foreach ((array)$values as $value) {

                $value = get_template_directory_uri() . $value;
                if ($key != 'admin') $index++; // admin styles don't affect counter
                if ($key == 'head') wp_enqueue_style("wpenq-style-$index", $value);
                if (strpos($key, 'IE') !== false) {
                    wp_enqueue_style("wpenq-style-$index", $value);
                    wp_style_add_data("wpenq-style-$index", 'conditional', 'lt ' . $key);
                }

            }
        }

    }
}

function enqueue_admin() {
    global $wpenq;

    if ($scripts = $wpenq->get_option_map('scripts')) {
        $index = 0;

        foreach ((array)$scripts as $key => $values) {
            foreach ((array)$values as $value) {

                $value = get_template_directory_uri() . $value;
                if ($key == 'admin') {
                    $index++; // increment only for admin scripts
                    wp_enqueue_script("wpenq-admin-script-$index", $value);
                }

            }
        }

    }

    if ($styles = $wpenq->get_option_map('styles')) {
        $index = 0;

        foreach ((array)$styles as $key => $values) {
            foreach ((array)$values as $value) {

                $value = get_template_directory_uri() . $value;
                if ($key == 'admin') {
                    $index++; // increment only for admin styles
                    wp_enqueue_style("wpenq-admin-style-$index", $value);
                }

            }
        }

    }
}

add_action('wp_enqueue_scripts', 'enqueue_frontend');
add_action('admin_enqueue_scripts', 'enqueue_admin');