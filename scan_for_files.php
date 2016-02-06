<?php

function scan_for_files() {
    $root = $_SERVER['DOCUMENT_ROOT'];

    $theme_uri = get_template_directory_uri();

    $theme_dir = preg_replace('/https?:\/\/[^\/]+/i', '', $theme_uri);

    $files = rglob($root . $theme_dir . '/*.js');
    $scripts = array();
    $root_preg = preg_quote($root, '/');
    $theme_preg = preg_quote($theme_dir, '/');

    foreach ($files as $file) {
        $strip_root = preg_replace("/$root_preg/", '', $file, 1);
        $full_path = home_url() . $strip_root;
        $short_path = preg_replace("/$theme_preg/", '', $strip_root, 1);
        $temp = array('full' => $full_path, 'short' => $short_path);
        $scripts[] = $temp;
    }

    return $scripts;
}

// recursive glob function
function rglob($pattern, $flags = 0) {
    $files = glob($pattern, $flags);
    foreach (glob(dirname($pattern).'/*', GLOB_ONLYDIR|GLOB_NOSORT) as $dir) {
        $files = array_merge($files, rglob($dir.'/'.basename($pattern), $flags));
    }
    return $files;
}