<?php
require_once "../../app/middleware/auth.php";
require_once "../../app/connect.php";
require_once "../../app/models/uri.php";

if (session_status() === PHP_SESSION_NONE)
    session_start();
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
$role = $_SESSION["role"];
$selectedPanelID = $_GET["panel"] ?? null;

if ($selectedPanelID) {
    $selectedPanelQuery = "select * from panneau where id = $selectedPanelID";
    $selectedPanelQueryResult = $cnx->query($selectedPanelQuery);
    $selectedPanel = $selectedPanelQueryResult->fetch_assoc();
}

$isAdmin = $role == 'admin';

$result = $cnx->query("
    select reservation.id as reserv_id, reservation.date_deb, reservation.date_fin, reservation.statut, reservation.montant, panneau.*
    from reservation
    inner join panneau on reservation.id = panneau.reservation_id
    where reservation.id = '$id'
");
$row = $result->fetch_assoc();

$result = $cnx->query("select * from panneau where reservation_id = '$id' or reservation_id = 0");
$panels = $result->fetch_all(MYSQLI_ASSOC);

$back = $isAdmin ? $baseUrls['reservations'] : $baseUrls['mreservations'];
$error = isset($_SESSION['error']) && $_SESSION['error'] === 1;
$action = $_GET["action"] ?? "apply-changes";
?>

<body>
<?php if (!isset($selectedPanel)): ?>
    <a href="<?= $back ?>" style="position: absolute; top: 50px; left: 50px; display: flex; justify-content: center; gap: 15px">
        <img src="../../public/images/arrow-sm-left.svg" alt="icon" width="50">
    </a>
<?php endif; ?>


<div style="
    width: fit-content;
    margin: 105px auto;
    padding: 35px;
    display: flex;
    flex-direction: column;
    align-items: flex-start;
">
    <span class="h1" style="margin-bottom: 45px">Modifier la réservation</span>

    <?php if (!$row): ?>
    Cette réservation est introuvable
    <?php else: ?>

    <?php if (!$isAdmin): ?>
        <div>
            <a href="../../app/controller/reservation.php?action=cancel&id=<?= $id ?>"
               style="font-size: .8rem; text-decoration: none !important; color: #dd1313; padding: 10px 15px; border: 1px solid #ec3e3e; background: white; margin-right: 15px"
            >
                Envoyer une demande d'annulation
            </a>
            <!--        <a href="" style="font-size: .8rem; text-decoration: none !important; color: #000000; padding: 10px 15px; border: 1px solid #000000; background: white;">Voir les informations du panneau sélectionné</a>-->
        </div>
    <?php endif; ?>

    <form action="../../app/controller/reservation.php?action=<?= $action ?>" method="post" style="margin: 25px 0 0 0; padding: 0">
        <input type="hidden" name="id" value="<?= $row['reserv_id'] ?>">

        <div class="group">
            <div class="left">
                <div class="form-control">
                    <input type="hidden" name="current_panel" value="<?= $row['id'] ?>">

                    <label for="panel">Panneau</label>
                    <select id="panel" name="panel">
                        <?php foreach ($panels as $panel): ?>
                            <option value="<?= $panel['id'] ?>"
                                <?php
                                if (isset($selectedPanel))
                                    if ($selectedPanel['id'] == $panel['id'])
                                        echo 'selected="selected"';
                                else
                                    if ($panel['id'] == $row['id'])
                                        echo 'selected="selected"';
                                ?>
                            >
                                <?= $panel['type'] . ' - ' . $panel['emplacement'] ?>
                            </option>
                        <?php endforeach; ?>
                    </select>
                </div>

                <div class="form-control">
                    <label for="date_fin">Date de fin</label>
                    <input id="date_fin" name="date_fin" type="date" required value="<?= $row['date_fin'] ?>">
                </div>

                <div class="form-control">
                    <label for="date_deb">Date de début</label>
                    <input id="date_deb" name="date_deb" type="date" required value="<?= $row['date_deb'] ?>">
                </div>
            </div>

            <div class="right">
                <span class="h2">Informations du panneau</span>

                <ul style="list-style-type: circle; min-width: 350px; max-width: 350px">
                    <li style="margin-bottom: 15px"> <?= isset($selectedPanel) ? $selectedPanel['type'] : $row['type'] ?> </li>
                    <li style="margin-bottom: 15px"> <?= isset($selectedPanel) ? $selectedPanel['emplacement'] : $row['emplacement'] ?> </li>
                    <li style="margin-bottom: 15px"> <?= isset($selectedPanel) ? $selectedPanel['prix'] : $row['prix'] ?> F CFA </li>
                    <li style="margin-bottom: 15px"> Longueur : <?= isset($selectedPanel) ? $selectedPanel['longueur'] : $row['longueur'] ?> m </li>
                    <li style="margin-bottom: 15px"> Largeur : <?= isset($selectedPanel) ? $selectedPanel['largeur'] : $row['largeur'] ?> m </li>
                    <li style="margin-bottom: 15px"> <?= isset($selectedPanel) ? $selectedPanel['description'] : $row['description'] ?> </li>
                </ul>
            </div>
        </div>

        <?php if (isset($_GET['msg'])): ?>
            <small style="color: <?= $error ? 'darkred' : 'green' ?>"><?= $_GET['msg'] ?></small>
        <?php endif; ?>

        <div style="display: flex; flex-direction: column; margin-top: 35px; gap: 5px">
            <?php if (isset($selectedPanel)): ?>
                <button type="submit" style="width: fit-content; min-width: 400px" disabled>Soumettre les modifications</button><br>
                <span>Fonctionalité par encore implémentée.</span>
            <?php else: ?>
                <button type="submit" style="background: #ffffff; border: 1px solid; color: #000000; width: fit-content; min-width: 300px">
                    Appliquer les modifications
                </button>
            <?php endif; ?>
        </div>
    </form>
    <?php endif; ?>
</div>
</body>
</html>
