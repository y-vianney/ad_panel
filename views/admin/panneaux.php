<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
    <link rel="stylesheet" href="../../public/css/style.css">
</head>

<?php
require_once "../../app/middleware/role.php";
require_once "../../app/models/uri.php";

$option = $_GET["option"] ?? null;
$sidebarOptions = ["update-user"];

$isSidebarActivated = $option && in_array($option, $sidebarOptions);
?>

<body>
<div class="layout">
    <?php include_once "../layouts/navbar.php"; ?>

    <div class="content">
        <div class="topbar">
            <?php include_once "../layouts/topbar.php"; ?>
        </div>

        <div class="main-block">
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

                <a href="<?= $baseUrls['ajouter-panneau'] ?>" style="
                        border: 1px solid #000000;
                        width: 150px; height: 45px; background: #fff; display: flex; justify-content: center; align-items: center;
                        color: #000; text-decoration: none !important;
                        cursor: pointer;
                        min-width: 100px;
                        margin-bottom: 25px;
                    "
                >
                    Ajouter un panneau
                </a>

                <?php include_once "../panneau/panneauxList.php"; ?>
            </div>

            <div class="sidebar<?= $isSidebarActivated ? ' active' : $isSidebarActivated ?>">
                <?php include_once "../client/modification.php"; ?>
            </div>
        </div>
    </div>
</div>
</body>
</html>
