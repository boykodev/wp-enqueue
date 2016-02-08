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
    <select name="<?= $pos ?>[]" class="position-select">
        <?php
        $options = array('head', 'footer', 'admin');
        $pos_value = (isset($pos_option[$i])) ? $pos_option[$i] : '';
        foreach ($options as $option) :
            $selected = ($pos_value == $option) ? 'selected' : '';
            ?>
            <option value="<?= $option ?>" <?= $selected ?>>
                <?= $option ?>
            </option>
            <?php
        endforeach; ?>
    </select>
    <button class="button wpenq-up">&#11014;</button>
    <button class="button wpenq-bottom">&#11015;</button>
    <button class="button wpenq-remove">&#10006;</button>
</div>