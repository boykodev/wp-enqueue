<?php

class WP_Enqueue_Helper {

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
     * @return array Relative file path.
     */
    public static function scan_for_files($ext) {
        $root = $_SERVER['DOCUMENT_ROOT'];

        $theme_uri = get_template_directory_uri();

        $theme_dir = preg_replace('/https?:\/\/[^\/]+/i', '', $theme_uri);

        $files = self::rglob($root . $theme_dir . "/*.$ext");
        $result = array();
        $root_preg = preg_quote($root, '/');
        $theme_preg = preg_quote($theme_dir, '/');

        foreach ((array)$files as $file) {
            $strip_root = preg_replace("/$root_preg/", '', $file, 1);
            $path = preg_replace("/$theme_preg/", '', $strip_root, 1);
            $temp = array('path' => $path);
            $result[] = $temp;
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

    // recursive glob function
    private static function rglob($pattern, $flags = 0) {
        $files = glob($pattern, $flags);
        foreach (glob(dirname($pattern) . '/*', GLOB_ONLYDIR | GLOB_NOSORT) as $dir) {
            $files = array_merge($files, self::rglob($dir . '/' . basename($pattern), $flags));
        }
        return $files;
    }
}

// enqueue plugin assets
function plugin_assets($hook) {
    global $wpenq_page;
    // enqueue only for wp-enqueue page
    if ($hook != $wpenq_page) return;

    $url = plugin_dir_url(__FILE__);
    wp_enqueue_style('wpenq_style', $url . 'assets/style.css');
    wp_enqueue_script('wpenq_script', $url . 'assets/script.js');
    // 3-rd party assets
    wp_enqueue_style('editable-select', $url . 'assets/jquery.editable-select.min.css');
    wp_enqueue_script('editable-select-js', $url . 'assets/jquery.editable-select.min.js');
}

add_action('admin_enqueue_scripts', 'plugin_assets');