<?php
require_once "../../app/connect.php";

if (session_status() == PHP_SESSION_NONE)
    session_start();

$id = $_SESSION['id'];
$query = "
    select reservation.id as reserv_id, reservation.date_deb, reservation.date_fin, reservation.statut, reservation.montant, panneau.*
    from reservation
    inner join panneau on reservation.id = panneau.reservation_id
    where client_id = '$id'
";

$result = $cnx->query($query);
$rows = $result->fetch_all(MYSQLI_ASSOC);
?>

<style>
    table thead th {
        font-weight: 400;
        border: none;
        border-bottom: 1px solid #333333;
        opacity: 0.7;
    }

    table tbody tr {
        border: none;
        border-bottom: .5px solid #ccc;
    }

    table tbody td {
        border: none;
        min-width: 50px;
    }

    table tbody tr:nth-child(even) {
        background: rgba(204, 204, 204, 0.29);
    }
</style>

<div style="width: 100%; overflow-x: scroll; padding: 0 5px">
    <table style="border-collapse: collapse;">
        <thead>
            <th style="min-width: 30px; padding: 4px 25px 15px 10px; text-align: start">#</th>
            <th style="min-width: fit-content; padding: 4px 25px 15px 0; text-align: start">Type de panneau</th>
            <th style="min-width: fit-content; padding: 4px 25px 15px 0; text-align: start">Longueur</th>
            <th style="min-width: fit-content; padding: 4px 25px 15px 0; text-align: start">Largeur</th>
            <th style="min-width: fit-content; padding: 4px 25px 15px 0; text-align: start">Type</th>
            <th style="min-width: fit-content; padding: 4px 25px 15px 0; text-align: start">Prix</th>
            <th style="min-width: fit-content; padding: 4px 25px 15px 0; text-align: start">Durée</th>
            <th style="min-width: fit-content; padding: 4px 25px 15px 0; text-align: start">Montant de la réservation</th>
            <th style="min-width: fit-content; padding: 4px 25px 15px 0; text-align: start">Statut</th>
            <th style="min-width: fit-content; padding: 4px 25px 15px 0; text-align: start">Actions</th>
        </thead>

        <tbody>
        <?php if (count($rows) == 0): ?>
            <tr>
                <td colspan="10" style="text-align: center; padding: 15px">Aucune réservation pour l'instant</td>
            </tr>
        <?php else: ?>
            <?php foreach ($rows as $row): ?>
                <tr>
                    <td style="padding: 15px 25px 15px 10px; text-align: start"><?= $row['reserv_id'] ?></td>
                    <td style="padding: 15px 25px 15px 0; text-align: start"><?= $row['type'] ?></td>
                    <td style="padding: 15px 25px 15px 0; text-align: start"><?= $row['longueur'] ?></td>
                    <td style="padding: 15px 25px 15px 0; text-align: start"><?= $row['largeur'] ?></td>
                    <td style="padding: 15px 25px 15px 0; text-align: start"><?= $row['type'] ?></td>
                    <td style="padding: 15px 25px 15px 0; text-align: start"><?= $row['prix'] ?> F</td>
                    <td style="padding: 15px 25px 15px 0; text-align: start"><?= round((strtotime($row['date_fin']) - strtotime($row['date_deb'])) / (60 * 60 * 24)) ?> jours</td>
                    <td style="padding: 15px 25px 15px 0; text-align: start"><?= number_format($row['montant'], 0, ',', '.') ?> F</td>
                    <td style="padding: 15px 25px 15px 0; text-align: center">
                    <span class="status <?= (strtolower($row['statut']) == 'active' ? 'active' : (strtolower($row['statut']) == 'suspendue')) ? 'suspended' : 'inactive' ?>">
                        <?= $row['statut'] ?>
                    </span>
                    </td>
                    <td style="padding: 15px 25px 15px 0; text-align: start">
                        <a href="../reservation/update.php?id=<?= $row['reserv_id'] ?>">Modifier</a>
                    </td>
                </tr>
            <?php endforeach; ?>
        <?php endif; ?>
        </tbody>
    </table>
</div>
