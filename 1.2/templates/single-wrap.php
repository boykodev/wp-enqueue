<div class="wrap">
    <select name="<?= $path ?>[]" class="path-select">
        <?php
        $flag = false;
        foreach ((array)$files as $file) :
            $selected = ($path_value == $file['path']) ? 'selected' : '';
            if ($selected) $flag = true;
            ?>
            <option value="<?= $file['path'] ?>" <?= $selected ?>><?= $file['path'] ?></option>
            <?php
        endforeach;
        if (!$flag) echo "<option value='$path_value' selected>$path_value</option>";
        ?>
    </select>
    <select name="<?= $cond ?>[]" class="condition-select">
        <?php
        $flag = false;
        $cond_value = (isset($cond_option[$i])) ? $cond_option[$i] : '';
        foreach ((array)$conditions as $condition) :
            $selected = ($cond_value == $condition) ? 'selected' : '';
            if ($selected) $flag = true;
            ?>
            <option value="<?= $condition ?>" <?= $selected ?>><?= $condition ?></option>
            <?php
        endforeach;
        if (!$flag) echo "<option value='$cond_value' selected>$cond_value</option>";
        ?>
    </select>
    <button class="button wpenq-up">&#11014;</button>
    <button class="button wpenq-down">&#11015;</button>
    <button class="button wpenq-remove">&#10006;</button>
</div>