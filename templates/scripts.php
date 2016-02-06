<?php
$handle = 'wpenq_scripts_handle';
$handle_option = get_option($handle);
$path = 'wpenq_scripts_path';
$path_option = get_option($path);
$index = 0; // TODO multiple inputs
?>
<p>Add script:</p>

<?php $handle_value = (isset($handle_option[$index])) ? esc_attr($handle_option[$index]) : '' ?>
<input type="text" name="<?= $handle ?>[]" value="<?= $handle_value ?>" placeholder="Add handle">

<?php $path_value = (isset($path_option[$index])) ? esc_attr($path_option[$index]) : '' ?>
<select name="<?= $path ?>[]" id="path-select">
    <?php
    $scripts = scan_for_files();
    foreach ($scripts as $script) :
        ?>
        <option value="<?= $script['full'] ?>" <?= ($path_value == $script['full']) ? 'selected' : '' ?>><?= $script['short'] ?></option>
        <?php
    endforeach; ?>
</select>
<?php  ?>