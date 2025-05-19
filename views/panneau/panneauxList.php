<?php
require_once "../../app/connect.php";
require_once "../../app/models/uri.php";

$query = "select * from panneau where reservation_id=0";

$result = $cnx->query($query);
$rows = $result->fetch_all(MYSQLI_ASSOC);
?>

<div class="panelList">
    <?php if (count($rows) > 0): ?>
        <?php foreach ($rows as $row): ?>
            <div class="panel">
                <div style="display: flex; gap: 35px">
                    <div class="panel-display" data-long="<?= $row['longueur'] . "m" ?>"
                         data-larg="<?= $row['largeur'] . "m" ?>">
                        <img src="../../public/svg/arrow.svg" alt="icon" class="perim-icon top" width="170">
                        <img src="../../public/svg/arrow.svg" alt="icon" class="perim-icon left" width="135">
                    </div>

                    <ul class="panel-detail">
                        <?php foreach (array_slice($row, 1, count($row) - 3) as $key => $value): ?>
                            <li>
                                <span class="subtitle"><?= ucfirst($key) ?> </span>
                                <span style="font-weight: 400"><?= $value ?></span>
                            </li>
                        <?php endforeach; ?>
                    </ul>
                </div>

                <a <?= $row['reservation_id'] == 0 ? 'href=' . $baseUrls['reserver'] . "?panel=" . $row['id'] : '' ?>
                        style="
                                border: 1px solid <?= $row['reservation_id'] == 0 ? '#000' : '#a60000' ?>;
                                width: 150px; height: 45px; background: #fff; display: flex; justify-content: center; align-items: center;
                                color: <?= $row['reservation_id'] == 0 ? '#000' : '#a60000' ?>; text-decoration: none !important;
                                cursor: <?= $row['reservation_id'] == 0 ? 'pointer' : 'not-allowed' ?>;
                                min-width: 100px
                                "
                >
                    <?= $row['reservation_id'] == 0 ? 'Réserver' : 'Indisponible' ?>
                </a>
            </div>
        <?php endforeach; ?>
    <?php else: ?>
        <span>Aucun panneau disponible pour l'instant</span>
    <?php endif; ?>
</div>
