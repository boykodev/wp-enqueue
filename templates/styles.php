<?php
$path = 'wpenq_styles_path';
$path_option = get_option($path);
$cond = 'wpenq_styles_cond';
$cond_option = get_option($cond);
$conditions = array('admin', 'IE 10', 'IE 9', 'IE 8');
?>
<p>
    <button class="button wpenq-add-style">Add style:</button>
</p>
<div class="wpenq-wrap wpenq-styles-wrap">
    <?php
    // get all scripts
    $files = scan_for_files('css');
    for ($i = 0; $path_value = (isset($path_option[$i])) ? esc_attr($path_option[$i]) : ''; $i++) :
        include('single-wrap.php');
    endfor;
    ?>
</div>
<?php // template for 'Add script' button ?>
<template class="wpenq-styles-tpl">
    <?php
    include('single-wrap.php'); ?>
</template>