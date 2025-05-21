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
require_once "../../app/models/uri.php";


$id = $_GET['panel'];
$query = "select * from panneau where id=$id";

$result = $cnx->query($query);
$row = $result->fetch_assoc();
$montant = 0;

$back = $baseUrls['espace'];

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $duration = round((strtotime($_POST['date_fin']) - strtotime($_POST['date_deb'])) / (60 * 60 * 24));
    $montant = montantReservation($row['type'], $row['longueur'], $row['largeur'], $row['prix'], $duration);
    $date_deb = $_POST['date_deb'] ?? null;
    $date_fin = $_POST['date_fin'] ?? null;
    $submittable = $montant !== 0;
}
?>

<body style="min-width: 1000px">

<a href="<?= $back ?>" style="position: absolute; top: 50px; left: 50px; display: flex; justify-content: center; gap: 15px">
    <img src="../../public/images/arrow-sm-left.svg" alt="icon" width="23">
    Revenir
</a>

<div style="
    width: 450px;
    margin: 65px auto;
    padding: 35px;
">
    <span class="h2">Description du panneau</span>

    <p>
        <?= $row['description'] ?>
    </p>

    <form action="?panel=<?= $id ?>&action=calculate" method="post" style="max-width: none; padding: 0; margin-bottom: 25px">
        <span class="h2" style="margin-bottom: 10px">Durée de la réservation</span>

        <div class="form-control">
            <label for="date_deb">Date de début</label>
            <input id="date_deb" name="date_deb" type="date" <?php if (isset($date_deb)) echo "value='$date_deb'" ?> required>
        </div>

        <div class="form-control">
            <label for="date_fin">Date de fin</label>
            <input id="date_fin" name="date_fin" type="date" <?php if (isset($date_fin)) echo "value='$date_fin'" ?> required>
        </div>

        <button type="submit" style="margin-top: 25px; width: 100%; border: 1px solid; background: #fff; color: #000000">Calculer le montant de la réservation</button>
    </form>

    <form action="../../app/controller/reservation.php?action=create" method="post" style="max-width: none; padding: 0">
        <input type="hidden" name="panneau" value="<?= $row['id'] ?>">
        <input type="hidden" name="date_deb" <?php if (isset($date_deb)) echo "value='$date_deb'" ?>>
        <input type="hidden" name="date_fin" <?php if (isset($date_fin)) echo "value='$date_fin'" ?>>

        <span class="h2" style="margin-bottom: 10px">Finaliser le paiement</span>

        <div class="form-control" style="flex-direction: row; gap: 15px">
            <?php foreach ($modes as $mode): ?>
                <label data-alt="<?= $mode['alt'] ?>">
                    <span><?= $mode['label'] ?></span>
                    <input type="radio" name="mode" value="<?= $mode['value'] ?>" required>
                </label>
            <?php endforeach; ?>
        </div>

        <div class="form-control ds-amount">
            <label for="montant">Montant</label>
            <input id="montant" name="montant" type="text" value="<?= number_format($montant, 0, ',', '.') ?>" readonly required
                style="font-size: 3rem; text-align: end; border-top: none !important; border-left: none !important;
                border-right: none !important; padding-right: 60px !important;"
            >
        </div>

        <button type="submit" style="margin-top: 25px; width: 100%" <?= !(isset($submittable) && $submittable) ? 'disabled="disabled"' : '' ?>>
            Valider la réservation
        </button>
    </form>
</div>
</body>
</html>
