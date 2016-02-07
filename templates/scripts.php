<?php
$path = 'wpenq_scripts_path';
$path_option = get_option($path);
?>
<p>
    <button class="button wpenq-add-script">Add script:</button>
</p>
<div class="wpenq-scripts-wrap">
    <?php
    // get all scripts
    $scripts = scan_for_files('js');
    for ($i = 0; $path_value = (isset($path_option[$i])) ? esc_attr($path_option[$i]) : ''; $i++) :
        ?>
        <div class="wrap">
            <select name="<?= $path ?>[]" class="path-select">
                <?php
                foreach ($scripts as $script) :
                    $selected = ($path_value == $script['full']) ? 'selected' : '';
                    ?>
                    <option value="<?= $script['full'] ?>" <?= $selected ?>>
                        <?= $script['short'] ?>
                    </option>
                    <?php
                endforeach; ?>
            </select>
            <button class="button wpenq-remove">&#10006;</button>
        </div>
        <?php
    endfor;
    ?>
</div>
<?php // template for 'Add script' button ?>
<template class="wpenq-scripts-tpl">
    <div class="wrap">
        <select name="<?= $path ?>[]" class="path-select">
            <?php
            foreach ($scripts as $script) :
                ?>
                <option value="<?= $script['full'] ?>"><?= $script['short'] ?></option>
                <?php
            endforeach; ?>
        </select>
        <button class="button wpenq-remove">&#10006;</button>
    </div>
</template>