<?php
$path = 'wpenq_scripts_path';
$path_option = get_option($path);
$cond = 'wpenq_scripts_cond';
$cond_option = get_option($cond);
$conditions = array('head', 'footer', 'admin');
?>
<p>
    <button class="button wpenq-add-script">Add script:</button>
</p>
<div class="wpenq-wrap wpenq-scripts-wrap">
    <?php
    // get all scripts
    $files = scan_for_files('js');
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