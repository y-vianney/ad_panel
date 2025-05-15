<?php
require_once "../../app/models/uri.php";

$uri = $_SERVER['REQUEST_URI'];
$url = parse_url($uri, PHP_URL_PATH);
?>

<div class="navbar">
    <ul>
        <li><a href="<?= $baseUrls['espace'] ?>" class="<?= str_ends_with($url, 'espace.php') ? 'active' : '' ?>">Accueil</a></li>
        <li><a href="<?= $baseUrls['mreservations'] ?>" class="<?= str_ends_with($url, 'mes-reservations.php') ? 'active' : '' ?>">Mes réservations</a></li>
        <li><a href="<?= $baseUrls['mmessages'] ?>" class="<?= str_ends_with($url, 'mes-messages.php') ? 'active' : '' ?>">Mes messages</a></li>
        <li><a href="<?= $baseUrls['mhistorique'] ?>" class="<?= str_ends_with($url, 'mon-historique.php') ? 'active' : '' ?>">Mon historique</a></li>
    </ul>

    <a href="../../app/controller/client.php?action=logout" class="logout">Se déconnecter</a>
</div>