<?php
global $wpenq;
$path = $wpenq->get_option_name('scripts', 'path');
$path_option = $wpenq->get_option('scripts', 'path');

$cond = $wpenq->get_option_name('scripts', 'cond');
$cond_option = $wpenq->get_option('scripts', 'cond');

$conditions = $wpenq->get_conditions('scripts');
?>
<p>
    <button class="button wpenq-add-script">Add script:</button>
</p>
<div class="wpenq-wrap wpenq-scripts-wrap">
    <?php
    // get all files in theme
    $files = WP_Enqueue_Helper::scan_for_files('js');
    for ($i = 0; $path_value = (isset($path_option[$i])) ? esc_attr($path_option[$i]) : ''; $i++) :
        include('single-wrap.php');
    endfor;
    ?>
</div>
<?php // template for 'Add script' button ?>
<template class="wpenq-scripts-tpl">
    <?php
    include('single-wrap.php'); ?>
</template>