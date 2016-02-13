<?php

function enqueue_frontend() {
    global $wpenq;

    if ($scripts = $wpenq->get_option_map('scripts')) {
        $index = 0;

        foreach ($scripts as $key => $values) {
            foreach ($values as $value) {

                if ($key != 'admin') $index++; // admin scripts don't affect counter
                if ($key == 'head') wp_enqueue_script("wpenq-script-$index", $value);
                if ($key == 'footer') wp_enqueue_script("wpenq-script-$index", $value, false, false, true);

            }
        }

    }

    if ($styles = $wpenq->get_option_map('styles')) {
        $index = 0;

        foreach ($styles as $key => $values) {
            foreach ($values as $value) {

                if ($key != 'admin') $index++; // admin styles don't affect counter
                if ($key == 'head') wp_enqueue_style("wpenq-style-$index", $value);

            }
        }

    }
}

function enqueue_admin() {
    global $wpenq;

    if ($scripts = $wpenq->get_option_map('scripts')) {
        $index = 0;

        foreach ($scripts as $key => $values) {
            foreach ($values as $value) {

                if ($key == 'admin') {
                    $index++; // increment only for admin scripts
                    wp_enqueue_script("wpenq-admin-script-$index", $value);
                }

            }
        }

    }

    if ($styles = $wpenq->get_option_map('styles')) {
        $index = 0;

        foreach ($styles as $key => $values) {
            foreach ($values as $value) {

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