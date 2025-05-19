<?php
require_once "../../app/models/uri.php";

$uri = $_SERVER['REQUEST_URI'];
$url = parse_url($uri, PHP_URL_PATH);
$title = "";

$editMode = isset($_GET['option']) && $_GET['option'] == 'update-user';
$bTitle = $editMode ? "Fermer" : "Modifier mes informations";

switch ($url) {
    case str_ends_with($url, 'espace.php'):
        $title = "Nos panneaux";
        break;
    case str_ends_with($url, 'mes-reservations.php'):
        $title = "Mes reservations";
        break;
    case str_ends_with($url, 'mon-historique.php'):
        $title = "Mon historique";
}
?>

<style>
    a.button {
        padding: 10px 15px;
        background: #fff;
        border: 1px solid;
        border-radius: 3px;
        transition: all .1s ease;
        text-decoration: none !important;
    }

    a.button:hover {
        background: #000;
        color: white;
    }
</style>

<span class="title"><?= strtoupper($title) ?></span>

<a class="button" href="<?= !$editMode ? '?option=update-user' : $url ?>">
    <?= $bTitle ?>
</a>