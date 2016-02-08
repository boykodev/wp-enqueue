<?php
$path = 'wpenq_scripts_path';
$path_option = get_option($path);
$pos = 'wpenq_scripts_pos';
$pos_option = get_option($pos);
?>
<p>
    <button class="button wpenq-add-script">Add script:</button>
</p>
<div class="wpenq-scripts-wrap">
    <?php
    // get all scripts
    $scripts = scan_for_files('js');
    for ($i = 0; $path_value = (isset($path_option[$i])) ? esc_attr($path_option[$i]) : ''; $i++) :
        include('scripts-wrap.php');
    endfor;
    ?>
</div>
<?php // template for 'Add script' button ?>
<template class="wpenq-scripts-tpl">
    <?php
    include('scripts-wrap.php'); ?>
</template>