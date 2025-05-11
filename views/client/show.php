<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
    <link rel="stylesheet" href="../../public/css/style.css">
</head>

<?php
require_once "../../app/connect.php";

$id = $_GET['id'];

$query = "select * from client where id = $id";
$result = $cnx->query($query);
$row = $result->fetch_assoc();
?>

<body>
<form action="../../app/controller/client.php?action=update" method="post">
    <?php
    foreach ($row as $key => $value) : ?>
        <?php if ($key == "id") { ?>
            <input type="hidden" name="<?= $key ?>" value="<?= $value ?>">
        <?php } else { ?>
            <input type="text" name="<?= $key ?>" value="<?= $value ?>" style="margin-bottom: 10px">
        <?php } ?>
    <?php endforeach;
    ?>

    <button type="submit">Envoyer</button>
</form>
</body>
</html>