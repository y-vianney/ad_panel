<?php
require_once "../../app/connect.php";

if (session_status() == PHP_SESSION_NONE)
    session_start();

$id = $_SESSION['id'];
$query = "
    select * from reservation
    inner join panneau on reservation.id = panneau.reservation_id
    where client_id = '$id'
";

$result = $cnx->query($query);
$rows = $result->fetch_all(MYSQLI_ASSOC);
?>

<span class="title">Mes réservations</span>

<div style="width: 100%; overflow-x: scroll; padding: 25px 5px" class="scrollable">
    <table border="1" style="border-collapse: collapse;">
        <thead>
        <th style="min-width: 30px; padding: 1px 4px">#</th>
        <th style="min-width: 150px; padding: 1px 4px">Type de panneau</th>
        <th style="min-width: 150px; padding: 1px 4px">Longueur</th>
        <th style="min-width: 150px; padding: 1px 4px">Largeur</th>
        <th style="min-width: 150px; padding: 1px 4px">Type</th>
        <th style="min-width: 150px; padding: 1px 4px">Prix</th>
        <th style="min-width: 150px; padding: 1px 4px">Durée</th>
        <th style="min-width: 150px; padding: 1px 4px">Montant de la réservation</th>
        <th style="min-width: 150px; padding: 1px 4px">Actions</th>
        </thead>

        <tbody>
        <?php foreach ($rows as $row): ?>
            <tr>
                <td><?= $row['id'] ?></td>
                <td><?= $row['type'] ?></td>
                <td><?= $row['longueur'] ?></td>
                <td><?= $row['largeur'] ?></td>
                <td><?= $row['type'] ?></td>
                <td><?= $row['prix'] ?></td>
                <td><?= $row['date_deb'] . ' - ' . $row['date_fin'] ?></td>
                <td><?= $row['montant'] ?></td>
                <td>
                    <a href="../reservation/update.php?id=<?= $row['id'] ?>">Modifier</a>
                </td>
            </tr>
        <?php endforeach; ?>
        </tbody>
    </table>
</div>
