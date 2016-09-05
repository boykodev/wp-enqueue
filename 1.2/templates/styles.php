<?php

global $wpenq;
$path = $wpenq->get_option_name('styles', 'path');
$path_option = $wpenq->get_option('styles', 'path');

$cond = $wpenq->get_option_name('styles', 'cond');
$cond_option = $wpenq->get_option('styles', 'cond');

$conditions = $wpenq->get_conditions('styles');
?>
<p>
    <button class="button wpenq-add-style">Add style:</button>
    <a href="#" class="wpenq-show-help" data-state="Hide">Show help</a>
</p>
<p class="wpenq-help">
    Click <code>Add style:</code> to add new CSS style<br>
    Double click on input to clear its value<br><br>
    <code>head</code> - enqueue in &lt;head&gt;<br>
    <code>admin</code> - enqueue in admin dashboard<br>
    <code>home</code> - enqueue only for homepage<br>
    <code>page</code> - enqueue for all pages<br>
    <code>page ...</code> - enqueue for a specific page<br>
    <code>single</code> - enqueue for all posts<br>
    <code>single ...</code> - enqueue for a specific post<br>
    <code>category</code> - enqueue for all categories<br>
    <code>category ...</code> - enqueue to a specific category<br>
    <code>archive</code> - enqueue for all archives<br><br>
    <code>page, single, category</code><br>
    - id or slug can be used<br>
</p>
<div class="wpenq-wrap wpenq-styles-wrap">
    <?php
    // get all files in plugin
    $files = WP_Enqueue_Helper::scan_for_files('css', 1);
    // get all files in theme
    $files = array_merge($files, WP_Enqueue_Helper::scan_for_files('css', 0));
    for ($i = 0; $path_value = (isset($path_option[$i])) ? esc_attr($path_option[$i]) : ''; $i++) :
        include('single-wrap.php');
    endfor;
    ?>
</div>
<?php // template for 'Add style' button ?>
<template class="wpenq-styles-tpl">
    <?php
    include('single-wrap.php'); ?>
</template>