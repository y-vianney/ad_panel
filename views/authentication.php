<?php
if (session_status() == PHP_SESSION_NONE)
    session_start();

$session = $_SESSION['id'] ?? null;

if ($session !== null)
    header("Location: http://localhost/ad_panel/views/client/espace.php");
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
    <link rel="stylesheet" href="../public/css/style.css">
    <style>
    </style>
</head>

<?php
$what = $_GET['page'] ?? null;
$action = null;

$uri = $_SERVER['REQUEST_URI'];
$url = parse_url($uri, PHP_URL_PATH);
$actions = array("login", "register");

if ($what === null || !in_array($what, $actions))
    header("Location: $url?page=login");
else {
    $action = $what === "login" ? "login" : "register";
}
?>

<body>
<?php if ($what): ?>
    <form action="../app/controller/client.php?action=<?= $action ?>" method="post">
        <span class="h1 styled-underline"><?= $what === "login" ? "Connexion" : "Inscription" ?></span>

        <?php if ($what === "login"): ?>
            <div class="form-control">
                <label for="mail">E-mail</label>
                <input name="mail" id="mail" type="email">
            </div>

            <div class="form-control">
                <label for="passwd">Mot de passe</label>
                <input name="passwd" id="passwd" type="password">
            </div>
        <?php elseif ($what === "register"): ?>
            <div class="form-group">
                <div class="form-control">
                    <label for="nom">Nom</label>
                    <input name="nom" id="nom" type="text" required>
                </div>

                <div class="form-control">
                    <label for="prenom">Prénoms</label>
                    <input name="prenom" id="prenom" type="text" required>
                </div>
            </div>

            <div class="form-group">
                <div class="form-control">
                    <label for="adresse">Adresse</label>
                    <input name="adresse" id="adresse" type="text" required>
                </div>

                <div class="form-control">
                    <label for="contact">Contact</label>
                    <input name="contact" id="contact" type="number">
                </div>
            </div>

            <div class="form-control">
                <label for="mail">E-mail</label>
                <input name="mail" id="mail" type="email">
            </div>

            <div class="form-control">
                <label for="passwd">Mot de passe</label>
                <input name="passwd" id="passwd" type="password">
            </div>
        <?php endif; ?>

        <?php if (isset($_GET['msg'])): ?>
            <small style="color: darkred"><?= $_GET['msg'] ?></small>
        <?php endif; ?>

        <button type="submit"><?= $what === "login" ? "Se connecter" : "Créer un compte" ?></button>

        <div style="margin-top: 35px">
            <?php if ($what === "login"): ?>
                <span>
                Vous n'avez pas encore de compte ?
                <a href="?page=register">Inscrivez-vous</a> !
            </span>
            <?php else: ?>
                <span>
                Déjà inscrit ?
                <a href="?page=login">Connectez-vous</a>.
            </span>
            <?php endif; ?>
        </div>
    </form>
<?php
else:
    header("Location: http://localhost/ad_panel");
endif;
?>
</body>
</html>
