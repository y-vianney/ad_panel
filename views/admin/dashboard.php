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

            </div>

            <div class="sidebar<?= $isSidebarActivated ? ' active' : $isSidebarActivated ?>">
                <?php include_once "../client/modification.php"; ?>
            </div>
        </div>
    </div>
</div>
</body>
</html>
