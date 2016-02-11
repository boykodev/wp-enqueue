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
        foreach ($arr_keys as $key => $value) {
            $result[$value][] = $arr_vals[$key];
        }
        return $result;
    }

    /**
     * This function scans theme folder for files.
     *
     * @param $ext string File extension to scan
     * @return array Associative array of full and short file path.
     */
    public static function scan_for_files($ext) {
        $root = $_SERVER['DOCUMENT_ROOT'];

        $theme_uri = get_template_directory_uri();

        $theme_dir = preg_replace('/https?:\/\/[^\/]+/i', '', $theme_uri);

        $files = self::rglob($root . $theme_dir . "/*.$ext");
        $result = array();
        $root_preg = preg_quote($root, '/');
        $theme_preg = preg_quote($theme_dir, '/');

        foreach ($files as $file) {
            $strip_root = preg_replace("/$root_preg/", '', $file, 1);
            $full_path = home_url() . $strip_root;
            $short_path = preg_replace("/$theme_preg/", '', $strip_root, 1);
            $temp = array('full' => $full_path, 'short' => $short_path);
            $result[] = $temp;
        }

        return $result;
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