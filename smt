<?php foreach ($controls_p as $key => $properties): ?>
    <?php if ($properties['type'] !== "select"): ?>
        <div class="form-control">
            <label for="<?= $key ?>"><?= $properties["label"] ?></label>
            <input name="<?= $key ?>" id="<?= $key ?>"
                   type="<?= $properties["type"] ?>"
                <?php if (isset($properties["min"])): ?>
                    min="<?= $properties["min"] ?>"
                <?php endif; ?>
                <?php if (isset($properties["step"])): ?>
                    step="<?= $properties["step"] ?>"
                <?php endif; ?>
            >
        </div>
    <?php else: ?>
        <div class="form-control">
            <label for="<?= $key ?>"><?= $properties["label"] ?></label>
            <select name="<?= $key ?>" id="<?= $key ?>">
                <option value="" selected="selected">Choisissez</option>
                <?php foreach ($properties["options"] as $option): ?>
                    <option value="<?= $option["value"] ?>"><?= $option["label"] ?></option>
                <?php endforeach; ?>
            </select>
        </div>
    <?php endif; ?>
<?php endforeach; ?>