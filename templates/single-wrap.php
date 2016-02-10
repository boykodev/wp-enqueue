<div class="wrap">
    <select name="<?= $path ?>[]" class="path-select">
        <?php
        foreach ($files as $file) :
            $selected = ($path_value == $file['full']) ? 'selected' : '';
            ?>
            <option value="<?= $file['full'] ?>" <?= $selected ?>>
                <?= $file['short'] ?>
            </option>
            <?php
        endforeach; ?>
    </select>
    <select name="<?= $cond ?>[]" class="condition-select">
        <?php
        $cond_value = (isset($cond_option[$i])) ? $cond_option[$i] : '';
        foreach ($conditions as $condition) :
            $selected = ($cond_value == $condition) ? 'selected' : '';
            ?>
            <option value="<?= $condition ?>" <?= $selected ?>>
                <?= $condition ?>
            </option>
            <?php
        endforeach; ?>
    </select>
    <button class="button wpenq-up">&#11014;</button>
    <button class="button wpenq-down">&#11015;</button>
    <button class="button wpenq-remove">&#10006;</button>
</div>