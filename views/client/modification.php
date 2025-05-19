<?php
require_once "../../app/models/uri.php";

if (session_status() == PHP_SESSION_NONE)
    session_start();

$session = $_SESSION;
$user = [
    "id" => $session["id"],
    "lastname" => $session['lastname'],
    "firstname" => $session['firstname'],
    "email" => $session['email'],
    "address" => $session['adresse'],
    "contact" => $session['contact'],
];

$error = $_SESSION["error"] === 1;

$uri = $_SERVER['REQUEST_URI'];
$url = parse_url($uri, PHP_URL_PATH);
?>


<form style="padding: 35px 0; overflow-y: scroll; scroll-behavior: smooth" action="../../app/controller/client.php?action=update" method="post">
    <input type="hidden" name="id" value="<?= $user['id'] ?>">

    <div class="form-control">
        <label for="nom">Nom</label>
        <input name="nom" id="nom" type="text" value="<?= $user['lastname'] ?>" required>
    </div>

    <div class="form-control">
        <label for="prenom">Prénoms</label>
        <input name="prenom" id="prenom" type="text" value="<?= $user['firstname'] ?>" required>
    </div>

    <div class="form-control">
        <label for="adresse">Adresse</label>
        <input name="adresse" id="adresse" type="text" value="<?= $user['address'] ?>" required>
    </div>

    <div class="form-control">
        <label for="contact">Contact</label>
        <input name="contact" id="contact" value="<?= $user['contact'] ?>" type="number" readonly style="border-color: #ccc">
    </div>

    <div class="form-control">
        <label for="mail">E-mail</label>
        <input name="mail" id="mail" type="email" value="<?= $user['email'] ?>" readonly style="border-color: #ccc">
    </div>

    <?php if (isset($_GET['msg'])): ?>
        <small style="color: <?= $error ? 'darkred' : 'green' ?>"><?= $_GET['msg'] ?></small>
    <?php endif; ?>

    <button type="submit" style="margin: 35px auto">Soumettre</button>
</form>