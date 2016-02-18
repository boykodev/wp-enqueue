<?php

function enqueue_frontend() {
    global $wpenq;

    $scripts = $wpenq->get_option_map('scripts');
    if ($scripts) {
        $default_scripts = WP_Enqueue_Helper::get_default_scripts();
        $index = 0;

        foreach ((array)$scripts as $key => $values) {
            foreach ((array)$values as $value) {

                if ($key != 'admin') $index++; // admin scripts don't affect counter

                if (in_array($value, $default_scripts)) {
                    $handle = $value;
                    $value = false;
                } else {
                    $handle = "wpenq-script-$index";
                    $value = WP_Enqueue_Helper::get_full_url($value);
                }

                if ($key == 'head') wp_enqueue_script($handle, $value);
                if ($key == 'home' && is_home()) wp_enqueue_script($handle, $value);
                if ($key == 'page' && is_page()) wp_enqueue_script($handle, $value);
                if ($key == 'single' && is_single()) wp_enqueue_script($handle, $value);
                if ($key == 'archive' && is_archive()) wp_enqueue_script($handle, $value);
                if ($key == 'category' && is_category()) wp_enqueue_script($handle, $value);
                if ($key == 'footer') wp_enqueue_script($handle, $value, false, false, true);

                $condition = explode(' ', $key);
                if (count($condition) >= 2) {
                    if (strcasecmp($condition[0], 'page') === 0) {
                        if (strcasecmp($condition[1], 'footer') === 0) {
                            if (is_page()) wp_enqueue_script($handle, $value, false, false, true);
                        } elseif (is_page($condition[1])) {
                            if (isset($condition[2]) && $condition[2] == 'footer') {
                                wp_enqueue_script($handle, $value, false, false, true);
                            } else {
                                wp_enqueue_script($handle, $value);
                            }
                        }
                    } elseif (strcasecmp($condition[0], 'single') === 0) {
                        if (strcasecmp($condition[1], 'footer') === 0) {
                            if (is_single()) wp_enqueue_script($handle, $value, false, false, true);
                        } elseif (is_single($condition[1])) {
                            if (isset($condition[2]) && $condition[2] == 'footer') {
                                wp_enqueue_script($handle, $value, false, false, true);
                            } else {
                                wp_enqueue_script($handle, $value);
                            }
                        }
                    } elseif (strcasecmp($condition[0], 'category') === 0) {
                        if (strcasecmp($condition[1], 'footer') === 0) {
                            if (is_category()) wp_enqueue_script($handle, $value, false, false, true);
                        } elseif (is_category($condition[1])) {
                            if (isset($condition[2]) && $condition[2] == 'footer') {
                                wp_enqueue_script($handle, $value, false, false, true);
                            } else {
                                wp_enqueue_script($handle, $value);
                            }
                        }
                    } elseif (strcasecmp($condition[0], 'home') === 0) {
                        if (strcasecmp($condition[1], 'footer') === 0 && is_home()) {
                            wp_enqueue_script($handle, $value, false, false, true);
                        }
                    } elseif (strcasecmp($condition[0], 'archive') === 0) {
                        if (strcasecmp($condition[1], 'footer') === 0 && is_archive()) {
                            wp_enqueue_script($handle, $value, false, false, true);
                        }
                    } elseif (strcasecmp($condition[0], 'IE') === 0) {
                        if (isset($condition[2]) && $condition[2] == 'footer') {
                            wp_enqueue_script($handle, $value, false, false, true);
                        } else {
                            wp_enqueue_script($handle, $value);
                        }
                        wp_script_add_data($handle,
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

                if ($key != 'admin') $index++; // admin styles don't affect counter

                $handle = "wpenq-style-$index";
                $value = WP_Enqueue_Helper::get_full_url($value);

                if ($key == 'head') wp_enqueue_style($handle, $value);
                if ($key == 'home' && is_home()) wp_enqueue_style($handle, $value);
                if ($key == 'page' && is_page()) wp_enqueue_style($handle, $value);
                if ($key == 'single' && is_single()) wp_enqueue_style($handle, $value);
                if ($key == 'archive' && is_archive()) wp_enqueue_style($handle, $value);
                if ($key == 'category' && is_category()) wp_enqueue_style($handle, $value);

                $condition = explode(' ', $key);
                if (count($condition) >= 2) {
                    if (strcasecmp($condition[0], 'page') === 0) {
                        if (is_page($condition[1])) {
                            wp_enqueue_style($handle, $value);
                        }
                    } elseif (strcasecmp($condition[0], 'single') === 0) {
                        if (is_single($condition[1])) {
                            wp_enqueue_style($handle, $value);
                        }
                    } elseif (strcasecmp($condition[0], 'category') === 0) {
                        if (is_category($condition[1])) {
                            wp_enqueue_style($handle, $value);
                        }
                    } elseif (strcasecmp($condition[0], 'IE') === 0) {
                        wp_enqueue_style($handle, $value);
                        wp_style_add_data($handle,
                            'conditional', 'lt ' . $condition[0] . ' ' . $condition[1]);
                    }
                }

            }
        }

    }
}

function enqueue_admin() {
    global $wpenq;

    $scripts = $wpenq->get_option_map('scripts');
    if ($scripts) {
        $default_scripts = WP_Enqueue_Helper::get_default_scripts();
        $index = 0;

        foreach ((array)$scripts as $key => $values) {
            foreach ((array)$values as $value) {

                // increment only for admin scripts
                if (mb_stripos($value, 'admin') === 0) $index++;

                if (in_array($value, $default_scripts)) {
                    $handle = $value;
                    $value = false;
                } else {
                    $handle = "wpenq-admin-script-$index";
                    $value = WP_Enqueue_Helper::get_full_url($value);
                }

                if ($key == 'admin') {
                    wp_enqueue_script($handle, $value);
                }

                $condition = explode(' ', $key);
                if (count($condition) >= 2) {
                    if (strcasecmp($condition[0], 'admin') === 0) {
                        if (strcasecmp($condition[1], 'footer') === 0) {
                            wp_enqueue_script($handle, $value, false, false, true);
                        }
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

                if ($key == 'admin') {
                    $index++; // increment only for admin styles

                    $handle = "wpenq-admin-style-$index";
                    $value = WP_Enqueue_Helper::get_full_url($value);

                    wp_enqueue_style($handle, $value);
                }

            }
        }

    }
}

add_action('wp_enqueue_scripts', 'enqueue_frontend');
add_action('admin_enqueue_scripts', 'enqueue_admin');