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
    <h1>Inscription</h1>

<form action="../../app/controller/client.php?action=create" method="post">
    <div class="form-control">
        <label for="nom">Nom</label>
        <input name="nom" type="text" required>
    </div>

    <div class="form-control">
        <label for="prenom">Prénoms</label>
        <input name="prenom" type="text" required>
    </div>

    <div class="form-control">
        <label for="adresse">Adresse</label>
        <input name="adresse" type="text" required>
    </div>

    <div class="form-control">
        <label for="contact">Contact</label>
        <input name="contact" type="number">
    </div>

    <div class="form-control">
        <label for="mail">E-mail</label>
        <input name="mail" type="email">
    </div>

    <div class="form-control">
        <label for="passwd">Mot de passe</label>
        <input name="passwd" type="password">
    </div>

    <button id="exportBtn" type="submit" style="margin-top: 25px">S'inscrire</button>
</form>

</body>
</html>
