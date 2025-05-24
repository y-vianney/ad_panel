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
require_once "../../app/middleware/role.php";
require_once "../../app/models/constants.php";
require_once "../../app/models/uri.php";


$option = $_GET["option"] ?? null;
$sidebarOptions = ["update-user"];

$isSidebarActivated = $option && in_array($option, $sidebarOptions);

$back = $baseUrls['panneaux'];
?>

<body>
<div class="layout">
    <?php include_once "../layouts/navbar.php"; ?>

    <div class="content">
        <div class="topbar">
            <?php include_once "../layouts/topbar.php"; ?>
        </div>

        <div class="main-block">
            <a href="<?= $back ?>" style="position: absolute; display: flex; justify-content: center; top: 5px; left: 10px">
                <img src="../../public/images/arrow-sm-left.svg" alt="icon" width="45">
            </a>

            <div class="content-block">
                <form action="../../app/controller/panneau.php?action=create" method="post">
                    <div class="form-control">
                        <label for="emplacement">Emplacement</label>
                        <input name="emplacement" type="text" id="emplacement" required>
                    </div>

                    <div class="form-group">
                        <div class="form-control">
                            <label for="long">Longueur</label>
                            <input type="number" name="longueur" id="long" step="0.01" min="0" required>
                        </div>

                        <div class="form-control">
                            <label for="larg">Largeur</label>
                            <input type="number" name="largeur" id="larg" step="0.01" min="0" required>
                        </div>
                    </div>

                    <div class="form-group">
                        <div class="form-control" style="width: 100%">
                            <label for="type">Type</label>
                            <select id="type" name="type" required>
                                <option selected="selected">Choisissez le type</option>
                                <?php foreach ($types_p as $type): ?>
                                    <option value="<?= $type['value'] ?>">
                                        <?= $type['label'] ?>
                                    </option>
                                <?php endforeach; ?>
                            </select>
                        </div>

                        <div class="form-control">
                            <label for="prix">Prix</label>
                            <input name="prix" type="text" id="prix" required>
                        </div>
                    </div>

                    <div class="form-control">
                        <label for="etat">Etat</label>
                        <select id="etat" name="etat" required>
                            <?php foreach ($state_p as $state): ?>
                                <option value="<?= $state['value'] ?>">
                                    <?= $state['label'] ?>
                                </option>
                            <?php endforeach; ?>
                        </select>
                    </div>

                    <div class="form-control">
                        <label for="description">Description</label>
                        <input name="description" type="text" id="description" required>
                    </div>

                    <button type="submit" style="margin-top: 25px">Enregistrer</button>
                </form>
            </div>

            <div class="sidebar<?= $isSidebarActivated ? ' active' : $isSidebarActivated ?>">
                <?php include_once "../client/modification.php"; ?>
            </div>
        </div>
    </div>

</div>
</body>
</html>
