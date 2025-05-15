<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
    <link rel="stylesheet" href="../../public/css/style.css">
    <style>
        .ds-amount {
            position: relative;
        }

        .ds-amount::after {
            content: "F CFA";
            font-size: .8rem;
            color: #000;
            position: absolute;
            right: 10px;
            top: 50%;
        }
    </style>
</head>

<?php
require_once "../../app/middleware/auth.php";
require_once "../../app/models/constants.php";
require_once "../../app/connect.php";
require_once "../../app/functions.php";


$montant = montantReservation();

$id = $_GET['panel'];
$query = "select * from panneau where id=$id";

$result = $cnx->query($query);
$row = $result->fetch_assoc();
?>

<body>
<div style="
    width: 450px;
    margin: auto;
    padding: 35px;
">
    <span class="h2">Informations sur le panneau</span>

    <p>
        <?= $row['description'] ?>
    </p>

    <span class="h2">Paiement</span>
    <form action="../../app/controller/reservation.php?action=create" method="post" style="max-width: none">
        <input type="hidden" name="panneau" value="<?= $row['id'] ?>">

        <div class="form-control">
            <label for="date_deb">Date de début</label>
            <input id="date_deb" name="date_deb" type="date" required>
        </div>

        <div class="form-control">
            <label for="date_fin">Date de fin</label>
            <input id="date_fin" name="date_fin" type="date" required>
        </div>

        <div class="form-control" style="flex-direction: row">
            <?php foreach ($modes as $mode): ?>
                <label>
                    <span><?= $mode['label'] ?></span>
                    <input type="radio" name="mode" value="<?= $mode['value'] ?>" required>
                </label>
            <?php endforeach; ?>
        </div>

        <div class="form-control ds-amount">
            <label for="montant">Montant</label>
            <input id="montant" name="montant" type="text" value="<?= $montant ?>" disabled="disabled" required
                style="font-size: 1rem;"
            >
            <input type="hidden" value="<?= $montant ?>" name="montant">
        </div>

        <!--    <div class="form-control">-->
        <!--        <label for="montant">Montant</label>-->
        <!--        <input id="montant" name="montant" type="number">-->
        <!--    </div>-->

        <!--    <div class="form-control">-->
        <!--        <label for="clt_id">ID Client</label>-->
        <!--        <input id="clt_id" name="clt_id" type="number">-->
        <!--    </div>-->

        <button type="submit" style="margin-top: 25px; width: 100%">Valider la réservation</button>
    </form>
</div>
</body>
</html>
