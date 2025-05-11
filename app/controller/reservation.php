<?php
require_once "../connect.php";
require_once "../functions.php";

$action = $_GET['action'] ?? null;

if ($action == 'create') {
    if (validateReservation($_POST)) {
        $date_deb = $_POST["date_deb"];
        $date_fin = $_POST["date_fin"];
        $montant = $_POST["montant"];
        $client_id = $_POST["clt_id"];  // $_SESSION['id']

        $dt = new DateTime();
        $dt_fin = new DateTime($date_fin);
        $statut = ($dt_fin < $dt) ? "Inactive" : "Active";

        $query = "
            insert into reservation (date_deb, date_fin, statut, montant, client_id)
            values ('$date_deb', '$date_fin', '$statut', '$montant', '$client_id')
        ";

        if ($cnx->query($query) === TRUE)
            echo "Enregistré";
        else
            echo "Error: " . $query . "<br>" . $cnx->error;
    }
}
