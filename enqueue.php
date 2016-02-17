<?php

function enqueue_frontend() {
    global $wpenq;

    $scripts = $wpenq->get_option_map('scripts');
    if ($scripts) {
        $index = 0;

        foreach ((array)$scripts as $key => $values) {
            foreach ((array)$values as $value) {

                $value = WP_Enqueue_Helper::get_full_url($value);
                if ($key != 'admin') $index++; // admin scripts don't affect counter
                if ($key == 'head') wp_enqueue_script("wpenq-script-$index", $value);
                if ($key == 'home' && is_home()) wp_enqueue_script("wpenq-script-$index", $value);
                if ($key == 'page' && is_page()) wp_enqueue_script("wpenq-script-$index", $value);
                if ($key == 'single' && is_single()) wp_enqueue_script("wpenq-script-$index", $value);
                if ($key == 'archive' && is_archive()) wp_enqueue_script("wpenq-script-$index", $value);
                if ($key == 'category' && is_category()) wp_enqueue_script("wpenq-script-$index", $value);
                if ($key == 'footer') wp_enqueue_script("wpenq-script-$index", $value, false, false, true);

                $condition = explode(' ', $key);
                if (count($condition) >= 2) {
                    if (strcasecmp($condition[0], 'page') === 0) {
                        if (strcasecmp($condition[1], 'footer') === 0) {
                            if (is_page()) wp_enqueue_script("wpenq-script-$index", $value, false, false, true);
                        } elseif (is_page($condition[1])) {
                            if (isset($condition[2]) && $condition[2] == 'footer') {
                                wp_enqueue_script("wpenq-script-$index", $value, false, false, true);
                            } else {
                                wp_enqueue_script("wpenq-script-$index", $value);
                            }
                        }
                    } elseif (strcasecmp($condition[0], 'single') === 0) {
                        if (strcasecmp($condition[1], 'footer') === 0) {
                            if (is_single()) wp_enqueue_script("wpenq-script-$index", $value, false, false, true);
                        } elseif (is_single($condition[1])) {
                            if (isset($condition[2]) && $condition[2] == 'footer') {
                                wp_enqueue_script("wpenq-script-$index", $value, false, false, true);
                            } else {
                                wp_enqueue_script("wpenq-script-$index", $value);
                            }
                        }
                    } elseif (strcasecmp($condition[0], 'category') === 0) {
                        if (strcasecmp($condition[1], 'footer') === 0) {
                            if (is_category()) wp_enqueue_script("wpenq-script-$index", $value, false, false, true);
                        } elseif (is_category($condition[1])) {
                            if (isset($condition[2]) && $condition[2] == 'footer') {
                                wp_enqueue_script("wpenq-script-$index", $value, false, false, true);
                            } else {
                                wp_enqueue_script("wpenq-script-$index", $value);
                            }
                        }
                    } elseif (strcasecmp($condition[0], 'home') === 0) {
                        if (strcasecmp($condition[1], 'footer') === 0 && is_home()) {
                            wp_enqueue_script("wpenq-script-$index", $value, false, false, true);
                        }
                    } elseif (strcasecmp($condition[0], 'archive') === 0) {
                        if (strcasecmp($condition[1], 'footer') === 0 && is_archive()) {
                            wp_enqueue_script("wpenq-script-$index", $value, false, false, true);
                        }
                    } elseif (strcasecmp($condition[0], 'IE') === 0) {
                        if (isset($condition[2]) && $condition[2] == 'footer') {
                            wp_enqueue_script("wpenq-script-$index", $value, false, false, true);
                        } else {
                            wp_enqueue_script("wpenq-script-$index", $value);
                        }
                        wp_script_add_data("wpenq-script-$index",
                            'conditional', 'lt ' . $condition[0] . ' ' . $condition[1]);
                    }
                }

            }
        }

    }

    $styles = $wpenq->get_option_map('styles');
    if ($styles) {
        $index = 0;

        foreach ((array)$styles as $key => $values) {
            foreach ((array)$values as $value) {

                $value = WP_Enqueue_Helper::get_full_url($value);
                if ($key != 'admin') $index++; // admin styles don't affect counter
                if ($key == 'head') wp_enqueue_style("wpenq-style-$index", $value);
                if ($key == 'home' && is_home()) wp_enqueue_style("wpenq-style-$index", $value);
                if ($key == 'page' && is_page()) wp_enqueue_style("wpenq-style-$index", $value);
                if ($key == 'single' && is_single()) wp_enqueue_style("wpenq-style-$index", $value);
                if ($key == 'archive' && is_archive()) wp_enqueue_style("wpenq-style-$index", $value);
                if ($key == 'category' && is_category()) wp_enqueue_style("wpenq-style-$index", $value);

                $condition = explode(' ', $key);
                if (count($condition) >= 2) {
                    if (strcasecmp($condition[0], 'page') === 0) {
                        if (is_page($condition[1])) {
                            wp_enqueue_style("wpenq-style-$index", $value);
                        }
                    } elseif (strcasecmp($condition[0], 'single') === 0) {
                        if (is_single($condition[1])) {
                            wp_enqueue_style("wpenq-style-$index", $value);
                        }
                    } elseif (strcasecmp($condition[0], 'category') === 0) {
                        if (is_category($condition[1])) {
                            wp_enqueue_style("wpenq-style-$index", $value);
                        }
                    } elseif (strcasecmp($condition[0], 'IE') === 0) {
                        wp_enqueue_style("wpenq-style-$index", $value);
                        wp_style_add_data("wpenq-style-$index",
                            'conditional', 'lt ' . $condition[0] . ' ' . $condition[1]);
                    }
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

                $value = WP_Enqueue_Helper::get_full_url($value);
                if ($key == 'admin') {
                    $index++; // increment only for admin scripts
                    wp_enqueue_script("wpenq-admin-script-$index", $value);
                }

                $condition = explode(' ', $key);
                if (count($condition) >= 2) {
                    if (strcasecmp($condition[0], 'admin') === 0) {
                        if (strcasecmp($condition[1], 'footer') === 0) {
                            $index++; // increment only for admin scripts
                            wp_enqueue_script("wpenq-admin-script-$index", $value, false, false, true);
                        }
                    }
                }

            }
        }

    }

    if ($styles = $wpenq->get_option_map('styles')) {
        $index = 0;

        foreach ((array)$styles as $key => $values) {
            foreach ((array)$values as $value) {

                $value = WP_Enqueue_Helper::get_full_url($value);
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