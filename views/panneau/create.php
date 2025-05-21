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
require_once "../../app/middleware/auth.php";
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
            <a href="<?= $back ?>" style="position: absolute; display: flex; justify-content: center;">
                <img src="../../public/images/arrow-sm-left.svg" alt="icon" width="45">
            </a>

            <div class="content-block">
                <!--<div class="header">
                    <span style="font-weight: 500">Ajouter des filtres</span>

                    <form class="filter-field" style="margin-top: 10px; flex-direction: row">
                        <input type="text" required>
                        <input type="text" required>
                        <input type="text" required>

                        <button type="submit">Appliquer</button>
                    </form>
                </div>-->

                <form action="../../app/controller/panneau.php?action=create" method="post">
                    <div class="form-control">
                        <label for="emplacement">Emplacement</label>
                        <select id="emplacement">
                            <option value="" selected="selected">Choisissez</option>
                            <option value="Abidjan - Plateau, Avenue Chardy" >Abidjan - Plateau, Avenue Chardy</option>
                            <option value="Yopougon - Sideci, en face de la pharmacie Akadjoba" >Yopougon - Sideci, en face de la pharmacie Akadjoba</option>
                        </select>
                    </div>

                    <div class="form-group">
                        <div class="form-control">
                            <label for="long">Longueur</label>
                            <input type="number" id="long" step="0.01" min="0">
                        </div>

                        <div class="form-control">
                            <label for="long">Largeur</label>
                            <input type="number" id="long" step="0.01" min="0">
                        </div>
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
