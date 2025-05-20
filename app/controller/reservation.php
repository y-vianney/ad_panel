<?php
if (session_status() == PHP_SESSION_NONE)
    session_start();

require_once "../models/uri.php";
require_once "../connect.php";
require_once "../functions.php";

$action = $_GET['action'] ?? null;

if ($_SERVER['REQUEST_METHOD'] == 'GET') {
    if ($action == 'cancel') {
        $msg = "Impossible d'annuler la réservation";
        $referer = $baseUrls["modifier-reservation"];
        $query = "update reservation set statut = 'Suspendue' where id = " . $_GET['id'];

        $result = $cnx->query("select * from reservation where id = " . $_GET['id']);
        $row = $result->fetch_assoc();

        if ($row['statut'] == 'Suspendue') {
            $_SESSION['error'] = 1;
            $msg = "Une demande a déjà été envoyée. Merci de contacter un administrateur pour plus d'informations.";
        } else {
            if ($cnx->query($query)) {
                $_SESSION['error'] = 0;
                $msg = "Demande envoyée";
            } else
                $_SESSION['error'] = 1;
        }

        header("Location: $referer?id=" . $_GET['id'] . "&msg=" . $msg);
    }
}

if ($action == 'create') {
    if (validateReservation($_POST)) {
        $date_deb = $_POST["date_deb"];
        $date_fin = $_POST["date_fin"];
        $panneau = $_POST["panneau"];
        $montant = $_POST["montant"];
        $mode = $_POST["mode"];

        $montant = str_replace(".", "", $montant);
        $client_id = $_SESSION["id"];

        $dt = new DateTime();
        try {
            $dt_fin = new DateTime($date_fin);
        } catch (DateMalformedStringException $e) {
            echo "Error while validating date";
        }
        $statut = ($dt_fin < $dt) ? "Inactive" : "Active";

        $query = "
            insert into reservation (date_deb, date_fin, statut, montant, client_id)
            values ('$date_deb', '$date_fin', '$statut', '$montant', '$client_id')
        ";

        if ($cnx->query($query) === TRUE) {
            $id = mysqli_insert_id($cnx);
            $pDate = date("Y-m-d");
            $pMontant = $montant;
            $statut = $montant == $pMontant ? "Soldé" : "Reste à solder";

            $qpanel = "
                update panneau set reservation_id = $id, etat = 'Réservé' where id=$panneau
            ";

            $qpaiement = "
                insert into paiement (date, montant, mode, statut, reservation_id)
                values ('$pDate', '$montant', '$mode', '$statut', '$id')
            ";

            if ($cnx->query($qpanel) === TRUE && $cnx->query($qpaiement) === TRUE)
                header("Location: " . $baseUrls['espace']);
            else {
                $_SESSION["error"] = 1;
                echo "Une erreur est survenue lors de l'enregistrement de votre réservation.";
            }

        }
        else
            echo "Error: " . $query . "<br>" . $cnx->error;
    } else echo "La vérification n'est pas valide";
} elseif ($action == 'update') {
    $_SESSION['changes-applied'] = false;

    $id = $_POST['id'];
    $msg = "La réservation a été mise à jour";

    $result = $cnx->query("select * from reservation where id = $id");
    $row = $result->fetch_assoc();

    if ($row['statut'] == 'Suspendue') {
        $_SESSION['error'] = 1;
        $msg = "Une demande a déjà été envoyée. Merci de contacter un administrateur pour plus d'informations.";
    } else {
        $date_deb = $_POST["date_deb"];
        $date_fin = $_POST["date_fin"];
        $pID = $_POST["panel"];
        $currPID = $row["current_panel"];

        $result = $cnx->query("select * from panneau where id = $currPID");
        $selectedPanel = $result->fetch_assoc();
        $duration = round((strtotime($date_fin) - strtotime($date_deb)) / (60 * 60 * 24));

        $dt = new DateTime();
        $dt_fin = new DateTime($date_fin);
        $statut = ($dt_fin < $dt) ? "Inactive" : "Active";
        $montant = montantReservation($selectedPanel['type'], $selectedPanel['longueur'], $selectedPanel['largeur'], $selectedPanel['prxi'], $duration);

        $query = "
            update reservation set date_deb = '$date_deb', date_fin = '$date_fin', statut = '$statut', montant = '$montant' where id=$id
        ";
        $updateOldPanelQuery = "update panneau set reservation_id = 0 where id=$currPID";
        $panelQuery = "update panneau set reservation_id = $id where id=$pID";

        if ($cnx->query($query) === TRUE && $cnx->query($panelQuery) === TRUE && $cnx->query($updateOldPanelQuery) === TRUE) {
            $_SESSION['error'] = 0;
        }
    }

    header("Location: " . $baseUrls['modifier-reservation'] . "?id=" . $id . "&msg=" . $msg);
} elseif ($action == 'apply-changes') {
    $id = $_POST['id'];

    $_SESSION['changes-applied'] = true;

    header("Location: " . $baseUrls['modifier-reservation'] . "?id=$id&action=update");
}

if ($cnx) {  // Closing connection
    $cnx->close();
}
