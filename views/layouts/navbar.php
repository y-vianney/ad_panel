<?php
require_once "../../app/models/uri.php";
require_once "../../app/connect.php";

if (session_status() == PHP_SESSION_NONE)
    session_start();

$session = $_SESSION;
$user = [
    "lastname" => $session['lastname'],
    "firstname" => $session['firstname'],
    "email" => $session['email'],
];

$uri = $_SERVER['REQUEST_URI'];
$url = parse_url($uri, PHP_URL_PATH);
?>

<div class="navbar">
    <ul>
        <li><a href="<?= $baseUrls['espace'] ?>" class="<?= str_ends_with($url, 'espace.php') ? 'active' : '' ?>">Accueil</a></li>
        <li><a href="<?= $baseUrls['mreservations'] ?>" class="<?= str_ends_with($url, 'mes-reservations.php') ? 'active' : '' ?>">Mes réservations</a></li>
<!--        <li><a href="--><?php //= $baseUrls['mmessages'] ?><!--" class="--><?php //= str_ends_with($url, 'mes-messages.php') ? 'active' : '' ?><!--">Mes messages</a></li>-->
<!--        <li><a href="--><?php //= $baseUrls['mhistorique'] ?><!--" class="--><?php //= str_ends_with($url, 'mon-historique.php') ? 'active' : '' ?><!--">Mon historique</a></li>-->
    </ul>

    <div class="footer">
        <div class="profile">
            <span class="firstname"><?= $user['firstname'] ?></span>
            <span class="lastname"><?= strtoupper($user['lastname']) ?></span>
        </div>

        <span style="color: #b3b3b3"><?= $user['email'] ?></span>

        <a href="../../app/controller/client.php?action=logout" class="logout">Se déconnecter</a>
    </div>
</div>