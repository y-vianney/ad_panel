<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
    <link rel="stylesheet" href="../../public/css/style.css">
    <style>
    </style>
</head>

<?php
require_once "../../app/models/panneau.php";
?>

<body>
<h1>Panneau</h1>

<form action="../../app/controller/reservation.php?action=create" method="post">
    <?php foreach ($panneauControls as $key => $properties): ?>
        <?php if ($properties['type'] !== "select"):?>
            <div class="form-control">
                <label for="<?= $key ?>"><?= $properties["label"] ?></label>
                <input name="<?= $key ?>" id="<?= $key ?>" type="<?= $properties["type"] ?>">
            </div>
        <?php else: ?>
            <div class="">
                <label for="<?= $key ?>"><?= $properties["label"] ?></label>
                <select name="<?= $key ?>" id="<?= $key ?>">
                    <option value="" selected="selected" selected="selected">Choisissez</option>
                    <?php foreach ($properties["options"] as $option): ?>
                        <option value="<?= $option["value"] ?>"><?= $option["label"] ?></option>
                    <?php endforeach; ?>
                </select>
            </div>
        <?php endif; ?>
    <?php endforeach; ?>

    <button type="submit" style="margin-top: 25px">Enregistrer</button>
</form>

</body>
</html>
