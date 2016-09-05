<?php

class WP_Enqueue_Helper {

    private static $theme_url;
    private static $plugin_url;
    private static $default_scripts;

    public static function init() {
        self::$theme_url = get_template_directory_uri();
        self::$plugin_url = plugin_dir_url(__FILE__);
    }

    /**
     * Map values of one array to another,
     * preserving duplicate keys.
     *
     * @return array Mapped array.
     */
    public static function array_map_duplicates($arr_vals, $arr_keys) {
        $result = array();
        foreach ((array)$arr_keys as $key => $value) {
            $result[$value][] = $arr_vals[$key];
        }
        return $result;
    }

    /**
     * This function scans theme folder for files.
     *
     * @param $ext string File extension to scan
     * @param $mode int 0 - theme, 1 - plugin
     * @return array Relative file path.
     */
    public static function scan_for_files($ext, $mode = 0) {
        $root = $_SERVER['DOCUMENT_ROOT'];

        switch ($mode) {
            case 0:
                $url = get_template_directory_uri();
                break;
            case 1:
                $url = plugin_dir_url(__FILE__) . 'assets/custom';
                break;
            default:
                $url = get_template_directory_uri();
                break;
        }

        if (is_multisite() && !is_main_site()) {
            $dir = preg_replace('/https?:\/\/[^\/]+\/[^\/]+/i', '', $url);
        } else {
            $dir = preg_replace('/https?:\/\/[^\/]+/i', '', $url);
        }

        $files = self::rglob($root . $dir . "/*.$ext");
        $result = array();
        $root_preg = preg_quote($root, '/');
        $path_preg = preg_quote($dir, '/');

        foreach ((array)$files as $file) {
            $strip_root = preg_replace("/$root_preg/", '', $file, 1);
            $path = preg_replace("/$path_preg/", '', $strip_root, 1);
            if ($mode == 1) {
                $result[] = array('path' => 'custom' . $path);
            } else {
                $result[] = array('path' => $path);
            }
        }

        return $result;
    }

    /**
     * This function prevents 'Undefined index' notice
     *
     * @param $array array Array to check
     * @param $index mixed Index or indices
     * @param $default array Default value
     * @return array Default or passed array
     */
    public static function isset_array($array, $index, $default = array()) {
        if (is_array($index)) {
            if (count($index) == 1) {
                if (isset($array[$index[0]])) return $array[$index[0]];
            }
            if (count($index) == 2) {
                if (isset($array[$index[0]][$index[1]])) return $array[$index[0]][$index[1]];
            }
            if (count($index) == 3) {
                if (isset($array[$index[0]][$index[1]][$index[2]])) return $array[$index[0]][$index[1]][$index[2]];
            }
        } else {
            if (isset($array[$index])) return $array[$index];
        }
        return $default;
    }

    /**
     * Get full asset URL
     * @param $value string Short asset URL
     * @return string Full asset URL
     */
    public static function get_full_url($value) {
        if (mb_stripos($value, 'custom') === 0) {
            return self::$plugin_url . 'assets/' . $value;
        } else {
            return self::$theme_url . $value;
        }
    }

    public static function set_default_scripts($scripts) {
        self::$default_scripts = $scripts;
    }

    public static function get_default_scripts() {
        return self::$default_scripts;
    }

    // recursive glob function
    private static function rglob($pattern, $flags = 0) {
        $files = glob($pattern, $flags);
        foreach (glob(dirname($pattern) . '/*', GLOB_ONLYDIR | GLOB_NOSORT) as $dir) {
            $files = array_merge($files, self::rglob($dir . '/' . basename($pattern), $flags));
        }
        return $files;
    }
}

// static variables init
WP_Enqueue_Helper::init();
include_once('templates/default_scripts.php');
WP_Enqueue_Helper::set_default_scripts($default_scripts);

// enqueue plugin assets
function plugin_assets($hook) {
    global $wpenq_page;
    // enqueue only for wp-enqueue page
    if ($hook != $wpenq_page) return;

    $url = plugin_dir_url(__FILE__);
    wp_enqueue_style('wpenq_style', $url . 'assets/plugin/style.css');
    wp_enqueue_script('wpenq_script', $url . 'assets/plugin/script.js');
    // 3-rd party assets
    wp_enqueue_style('editable-select', $url . 'assets/plugin/jquery.editable-select.min.css');
    wp_enqueue_script('editable-select-js', $url . 'assets/plugin/jquery.editable-select.min.js');
}

add_action('admin_enqueue_scripts', 'plugin_assets');