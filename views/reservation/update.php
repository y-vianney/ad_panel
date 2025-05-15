<?php
require_once "../../app/middleware/auth.php";
require_once "../../app/connect.php";
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
    <link rel="stylesheet" href="../../public/css/style.css">
</head>

<?php
$id = $_GET["id"];

$result = $cnx->query("select * from reservation where id=$id");
$row = $result->fetch_assoc();
?>

<body>
<h1>Modifier la réservation</h1>

<a href="#" style="font-size: .8rem; text-decoration: none; color: #dd1313; padding: 14px 20px; border: 1px solid #ec3e3e; background: white;">Annuler la réservation</a>

<form action="../../app/controller/reservation.php?action=update" method="post" style="margin-top: 25px">
    <input type="hidden" name="id" value="<?= $row['id'] ?>">

    <div class="form-control">
        <label for="date_deb">Date de début</label>
        <input id="date_deb" name="date_deb" type="date" required value="<?= $row['date_deb'] ?>">
    </div>

    <div class="form-control">
        <label for="date_fin">Date de fin</label>
        <input id="date_fin" name="date_fin" type="date" required value="<?= $row['date_fin'] ?>">
    </div>

    <button type="submit" style="margin-top: 25px">Modifier</button>
</form>

</body>
</html>
