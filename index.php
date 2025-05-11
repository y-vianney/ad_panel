<!doctype html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Document</title>

    <link rel="stylesheet" href="public/css/style.css">
</head>

<?php
require_once "app/client.php";

/**
 * rows = [
 *  [1, "test", "test", "test", "0102030405],
 *  [1, "test", "test", "test", "0102030405],
 *  [1, "test", "test", "test", "0102030405]
 * ]
 *
 * CRUD - Create, Read, Update, Delete
 */
?>

<body>
<div class="container">
    <table border="1" style="border-collapse: collapse;">
        <thead>
            <th>#</th>
            <th>Nom</th>
            <th>Prenoms</th>
            <th>Adresse</th>
            <th>Contact</th>
        </thead>

        <tbody>
            <?php foreach ($rows as $row) : ?>
            <tr>
                <?php foreach ($row as $value) : ?>
                <td><?= $value ?></td>
                <?php endforeach; ?>
                <td><a href="views/client/show.php?id=<?= $row[0]; ?>">Voir</a></td>
                <td><a href="app/controller/client.php?id=<?= $row[0]; ?>&action=delete">Supprimer</a></td>
            </tr>
            <?php endforeach; ?>
        </tbody>
    </table>
</div>
</body>
</html>