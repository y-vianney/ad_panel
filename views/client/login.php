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

<body>
<h1>Connexion</h1>

<form action="../../app/controller/client.php?action=login" method="post">
    <div class="form-control">
        <label for="mail">E-mail</label>
        <input name="mail" type="email">
    </div>

    <div class="form-control">
        <label for="passwd">Mot de passe</label>
        <input name="passwd" type="password">
    </div>

    <?php if (isset($_GET['msg'])): ?>
    <small style="color: darkred"><?= $_GET['msg'] ?></small>
    <?php endif; ?>

    <button id="exportBtn" type="submit" style="margin-top: 25px;">Se connecter</button>
</form>

</body>
</html>
