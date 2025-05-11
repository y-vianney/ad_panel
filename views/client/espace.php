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

<?php
require_once "../../app/middleware/auth.php";
?>

<body>
<h1>Mon espace</h1>
<span>Bienvenue <b><?= $_SESSION['nom'] . $_SESSION['prenom'] ?></b></span>

<form action="../../app/controller/client.php?action=logout" method="post">
    <button type="submit" style="margin-top: 25px">Se déconnecter</button>
</form>

</body>
</html>
