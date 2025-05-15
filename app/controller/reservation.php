<?php
if (session_status() == PHP_SESSION_NONE)
    session_start();

require_once "../connect.php";
require_once "../functions.php";

$action = $_GET['action'] ?? null;

if ($action == 'create') {
    if (validateReservation($_POST)) {
        $date_deb = $_POST["date_deb"];
        $date_fin = $_POST["date_fin"];
        $panneau = $_POST["panneau"];
        $montant = $_POST["montant"];

        $client_id = $_SESSION["id"];

        $dt = new DateTime();
        $dt_fin = new DateTime($date_fin);
        $statut = ($dt_fin < $dt) ? "Inactive" : "Active";

        $query = "
            insert into reservation (date_deb, date_fin, statut, montant, client_id)
            values ('$date_deb', '$date_fin', '$statut', '$montant', '$client_id')
        ";


        if ($cnx->query($query) === TRUE) {
            $id = mysqli_insert_id($cnx);

            $query = "
                update panneau set reservation_id = $id, etat = 'Réservé' where id=$panneau
            ";

            if ($cnx->query($query) === TRUE)
                echo "Enregistré";

        }
        else
            echo "Error: " . $query . "<br>" . $cnx->error;
    } else echo "La vérification n'est pas valide";
} elseif ($action == 'update') {
    $id = $_POST['id'];
    $date_deb = $_POST["date_deb"];
    $date_fin = $_POST["date_fin"];
    // $panneau = $_POST["panneau"];

    // $client_id = $_SESSION["id"];

    $dt = new DateTime();
    $dt_fin = new DateTime($date_fin);
    $statut = ($dt_fin < $dt) ? "Inactive" : "Active";
    // $montant = montantReservation();

    $query = "
        update reservation set date_deb = '$date_deb', date_fin = '$date_fin', statut = '$statut' where id=$id
    ";

    if ($cnx->query($query) === TRUE) {
        echo "Modifié";
    }
}
