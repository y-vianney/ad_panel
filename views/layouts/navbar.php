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
    "role" => $session['role']
];

$uri = $_SERVER['REQUEST_URI'];
$url = parse_url($uri, PHP_URL_PATH);
?>

<div class="navbar">
    <ul>
        <?php if ($user['role'] == 'client'): ?>
            <li><a href="<?= $baseUrls['espace'] ?>" class="<?= str_ends_with($url, 'espace.php') ? 'active' : '' ?>">Accueil</a></li>
            <li><a href="<?= $baseUrls['mreservations'] ?>" class="<?= str_ends_with($url, 'mes-reservations.php') ? 'active' : '' ?>">Mes réservations</a></li>
        <?php endif; ?>

        <?php if ($user['role'] == 'admin'): ?>
            <li><a href="<?= $baseUrls['dashboard'] ?>" class="<?= str_ends_with($url, 'admin/dashboard.php') ? 'active' : '' ?>">Tableau de bord</a></li>
            <li><a href="<?= $baseUrls['reservations'] ?>" class="<?= str_ends_with($url, 'admin/reservations.php') ? 'active' : '' ?>">Réservations</a></li>
            <li><a href="<?= $baseUrls['panneaux'] ?>" class="<?= str_ends_with($url, 'admin/panneaux.php') || str_ends_with($url, 'panneau/create.php') ? 'active' : '' ?>">Panneaux</a></li>
        <?php endif; ?>

<!--        <li><a href="--><?php //= $baseUrls['mhistorique'] ?><!--" class="--><?php //= str_ends_with($url, 'mon-historique.php') ? 'active' : '' ?><!--">Mon historique</a></li>-->
    </ul>

    <div class="footer">
        <div class="profile">
            <span class="firstname"><?= $user['firstname'] ?></span>
            <span class="lastname"><?= strtoupper($user['lastname']) ?></span>
        </div>

        <span style="color: #b3b3b3"><?= $user['email'] ?> (<?= strtoupper($user['role']) ?>)</span>

        <a href="../../app/controller/client.php?action=logout" class="logout">Se déconnecter</a>
    </div>
</div>