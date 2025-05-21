<?php
require_once "../../app/middleware/role.php";
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

$isAdmin = $role == 'admin';

$result = $cnx->query("
    select *
    from panneau
    where id = '$id'
");
$row = $result->fetch_assoc();

$result = $cnx->query("select * from panneau where reservation_id = '$id' or reservation_id = 0");
$panels = $result->fetch_all(MYSQLI_ASSOC);

$back = $baseUrls['panneaux'];
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
    <span class="h1" style="margin-bottom: 45px">Modifier la réservation</span>

    <?php if (!$row): ?>
        Ce panneau est introuvable
    <?php else: ?>
        <form action="" method="post" style="margin: 25px 0 0 0; padding: 0">
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
