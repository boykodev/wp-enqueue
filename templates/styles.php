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
</p>
<div class="wpenq-wrap wpenq-styles-wrap">
    <?php
    // get all files in theme
    $files = WP_Enqueue_Helper::scan_for_files('css');
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