<?php
require_once "../../app/connect.php";
?>

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

$query = "select * from panneau";

$result = $cnx->query($query);
$rows_p = $result->fetch_all(MYSQLI_ASSOC);

?>

<body>
<h1>Reservation</h1>

<form action="../../app/controller/reservation.php?action=create" method="post">
    <?php if (isset($rows_p) && count($rows_p) > 0): ?>
        <div>
            <?php foreach ($rows_p as $row): ?>
                <div class="form-control radio" style="flex-direction: row; align-items: center;">
                    <input type="radio" id="<?= "radio" . $row['id'] ?>" value="<?= $row['id'] ?>" data-long="<?= $row['longueur'] ?>"
                           data-larg="<?= $row['largeur'] ?>" data-amount="<?= $row['prix'] ?>"
                           data-description="<?= $row['description'] ?>" name="panneau"
                    > <label for="<?= "radio" . $row['id'] ?>"><?= $row['type'] . ' - ' . $row['emplacement'] ?></label>
                </div>
            <?php endforeach; ?>
        </div>
    <?php endif; ?>

    <div class="form-control">
        <label for="date_deb">Date de début</label>
        <input id="date_deb" name="date_deb" type="date" required>
    </div>

    <div class="form-control">
        <label for="date_fin">Date de fin</label>
        <input id="date_fin" name="date_fin" type="date" required>
    </div>

    <div class="form-control">
        <label for="montant">Montant</label>
        <input id="montant" name="montant" type="number">
    </div>

    <div class="form-control">
        <label for="clt_id">ID Client</label>
        <input id="clt_id" name="clt_id" type="number">
    </div>

    <button type="submit" style="margin-top: 25px">Enregistrer</button>
</form>

</body>
</html>
