<?php
require_once "../../app/middleware/role.php";
require_once "../../app/connect.php";
require_once "../../app/models/uri.php";
require_once "../../app/models/constants.php";


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

$result = $cnx->query("
    select *
    from panneau
    where id = '$id'
");
$row = $result->fetch_assoc();

$back = $baseUrls['panneaux'];
$error = isset($_SESSION['error']) && $_SESSION["error"] === 1;
?>

<body>
<a href="<?= $back ?>" style="position: absolute; top: 50px; left: 50px; display: flex; justify-content: center; gap: 15px">
    <img src="../../public/images/arrow-sm-left.svg" alt="icon" width="50">
</a>

<div style="
    width: fit-content;
    margin: 105px auto;
    padding: 35px;
    display: flex;
    flex-direction: column;
    align-items: flex-start;
">
    <span class="h1" style="margin-bottom: 45px">
        Modifier la réservation

        <?php if ($row): ?>
            <a href="../../app/controller/panneau.php?action=delete&id=<?= $id ?>" style="font-size: 12px; margin-left: 50px; font-weight: 400; color: darkred">Supprimer le panneau</a>
        <?php endif; ?>
    </span>

    <?php if (!$row): ?>
        Ce panneau est introuvable
    <?php else: ?>
        <form action="../../app/controller/panneau.php?action=update" method="post" style="margin: 25px 0 0 0; padding: 0">
            <div class="form-control">
                <label for="emplacement">Emplacement</label>
                <input name="emplacement" type="text" id="emplacement" value="<?= $row['emplacement'] ?>" required>
            </div>

            <div class="form-group">
                <div class="form-control">
                    <label for="long">Longueur</label>
                    <input type="number" name="longueur" id="long" step="0.01" min="0" value="<?= $row['longueur'] ?>" required>
                </div>

                <div class="form-control">
                    <label for="larg">Largeur</label>
                    <input type="number" name="largeur" id="larg" step="0.01" min="0" value="<?= $row['largeur'] ?>" required>
                </div>
            </div>

            <div class="form-group">
                <div class="form-control" style="width: 100%">
                    <label for="type">Type</label>
                    <select id="type" name="type" required>
                        <option selected="selected">Choisissez le type</option>
                        <?php foreach ($types_p as $type): ?>
                            <option value="<?= $type['value'] ?>" <?= $row['type'] == $type['value'] ? 'selected="selected"' : '' ?>>
                                <?= $type['label'] ?>
                            </option>
                        <?php endforeach; ?>
                    </select>
                </div>

                <div class="form-control">
                    <label for="prix">Prix</label>
                    <input name="prix" type="text" id="prix" value="<?= $row['prix'] ?>" required>
                </div>
            </div>

            <div class="form-control">
                <label for="etat">Etat</label>
                <select id="etat" name="etat" required>
                    <?php foreach ($state_p as $state): ?>
                        <option value="<?= $state['value'] ?>" <?= $row['etat'] == $state['value'] ? 'selected="selected"' : '' ?>>
                            <?= $state['label'] ?>
                        </option>
                    <?php endforeach; ?>
                </select>
            </div>

            <div class="form-control">
                <label for="description">Description</label>
                <input name="description" type="text" id="description" value="<?= $row['description'] ?>" required>
            </div>

            <?php if (isset($_GET['msg'])): ?>
                <small style="color: <?= $error ? 'darkred' : 'green' ?>"><?= $_GET['msg'] ?></small>
            <?php endif; ?>

            <div style="display: flex; margin-top: 35px; gap: 15px">
                <button type="submit" style="width: fit-content; min-width: 400px">Soumettre les modifications</button>
            </div>
        </form>
    <?php endif; ?>
</div>
</body>
</html>
