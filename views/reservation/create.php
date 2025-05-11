<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
    <link rel="stylesheet" href="../../public/css/style.css">
    <style>
    </style>
</head>

<body>
<h1>Reservation</h1>

<form action="../../app/controller/reservation.php?action=create" method="post">
    <div class="form-control">
        <label for="date_deb">Date de début</label>
        <input name="date_deb" type="date" required>
    </div>

    <div class="form-control">
        <label for="date_fin">Date de fin</label>
        <input name="date_fin" type="date" required>
    </div>

    <div class="form-control">
        <label for="montant">Montant</label>
        <input name="montant" type="number">
    </div>

    <div class="form-control">
        <label for="clt_id">ID Client</label>
        <input name="clt_id" type="number">
    </div>

    <button type="submit" style="margin-top: 25px">Enregistrer</button>
</form>

</body>
</html>
