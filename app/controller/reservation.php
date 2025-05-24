<?php
// Inclusion des fichiers nécessaires
require_once "../models/uri.php";     // Configuration des URLs
require_once "../connect.php";        // Connexion à la base de données
require_once "../functions.php";      // Fonctions utilitaires

// Récupération de l'action depuis l'URL
$action = $_GET['action'] ?? null;

// Traitement des requêtes GET
if ($_SERVER['REQUEST_METHOD'] == 'GET') {
    if ($action == 'cancel') {
        // Initialisation des variables pour l'annulation
        $msg = "Impossible d'annuler la réservation";
        $referer = $baseUrls["modifier-reservation"];
        
        // Requête de mise à jour du statut de la réservation
        $query = "update reservation set statut = 'Suspendue' where id = " . $_GET['id'];

        // Vérification si la réservation n'est pas déjà suspendue
        $result = $cnx->query("select * from reservation where id = " . $_GET['id']);
        $row = $result->fetch_assoc();

        if ($row['statut'] == 'Suspendue') {
            $_SESSION['error'] = 1;
            $msg = "Une demande a déjà été envoyée. Merci de contacter un administrateur pour plus d'informations.";
        } else {
            // Tentative de mise à jour du statut
            if ($cnx->query($query)) {
                $_SESSION['error'] = 0;
                $msg = "Demande envoyée";
            } else
                $_SESSION['error'] = 1;
        }

        // Redirection avec message
        header("Location: $referer?id=" . $_GET['id'] . "&msg=" . $msg);
    }
}

// Traitement de la création d'une réservation
if ($action == 'create') {
    if (validateReservation($_POST)) {  // Validation des données du formulaire
        // Récupération des données du formulaire
        $date_deb = $_POST["date_deb"];
        $date_fin = $_POST["date_fin"];
        $panneau = $_POST["panneau"];
        $montant = $_POST["montant"];
        $mode = $_POST["mode"];

        // Nettoyage du montant et récupération de l'ID client
        $montant = str_replace(".", "", $montant);
        $client_id = $_SESSION["id"];

        // Détermination du statut de la réservation selon la date
        $dt = new DateTime();
        try {
            $dt_fin = new DateTime($date_fin);
        } catch (DateMalformedStringException $e) {
            echo "Error while validating date";
        }
        $statut = ($dt_fin < $dt) ? "Inactive" : "Active";

        // Création de la réservation
        $query = "
            insert into reservation (date_deb, date_fin, statut, montant, client_id)
            values ('$date_deb', '$date_fin', '$statut', '$montant', '$client_id')
        ";

        // Traitement après création de la réservation
        if ($cnx->query($query) === TRUE) {
            $id = mysqli_insert_id($cnx);
            $pDate = date("Y-m-d");
            $pMontant = $montant;
            $statut = $montant == $pMontant ? "Soldé" : "Reste à solder";

            // Mise à jour du panneau et création du paiement
            $qpanel = "update panneau set reservation_id = $id, etat = 'Réservé' where id=$panneau";
            $qpaiement = "
                insert into paiement (date, montant, mode, statut, reservation_id)
                values ('$pDate', '$montant', '$mode', '$statut', '$id')
            ";

            // Vérification de la bonne exécution des requêtes
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
}

// Traitement de la mise à jour d'une réservation
elseif ($action == 'update') {
    $_SESSION['changes-applied'] = false;
    $id = $_POST['id'];
    $msg = "La réservation a été mise à jour";

    // Vérification du statut actuel de la réservation
    $result = $cnx->query("select * from reservation where id = $id");
    $row = $result->fetch_assoc();

    if ($row['statut'] == 'Suspendue') {
        $_SESSION['error'] = 1;
        $msg = "Une demande a déjà été envoyée. Merci de contacter un administrateur pour plus d'informations.";
    } else {
        // Mise à jour des informations de la réservation
        $date_deb = $_POST["date_deb"];
        $date_fin = $_POST["date_fin"];
        $pID = $_POST["panel"];
        $currPID = $row["current_panel"];

        // Calcul du nouveau montant
        $result = $cnx->query("select * from panneau where id = $currPID");
        $selectedPanel = $result->fetch_assoc();
        $duration = round((strtotime($date_fin) - strtotime($date_deb)) / (60 * 60 * 24));

        // Détermination du nouveau statut
        $dt = new DateTime();
        $dt_fin = new DateTime($date_fin);
        $statut = ($dt_fin < $dt) ? "Inactive" : "Active";
        
        // Calcul du montant en fonction des caractéristiques du panneau
        $montant = montantReservation($selectedPanel['type'], $selectedPanel['longueur'], 
                                    $selectedPanel['largeur'], $selectedPanel['prxi'], $duration);

        // Mise à jour des données dans la base
        $query = "update reservation set date_deb = '$date_deb', date_fin = '$date_fin', 
                  statut = '$statut', montant = '$montant' where id=$id";
        $updateOldPanelQuery = "update panneau set reservation_id = 0 where id=$currPID";
        $panelQuery = "update panneau set reservation_id = $id where id=$pID";

        // Exécution des requêtes de mise à jour
        if ($cnx->query($query) === TRUE && $cnx->query($panelQuery) === TRUE && 
            $cnx->query($updateOldPanelQuery) === TRUE) {
            $_SESSION['error'] = 0;
        }
    }

    // Redirection avec message
    header("Location: " . $baseUrls['modifier-reservation'] . "?id=" . $id . "&msg=" . $msg);
}

// Application des modifications temporaires
elseif ($action == 'apply-changes') {
    $id = $_POST['id'];
    $panel = $_POST["panel"];
    header("Location: " . $baseUrls['modifier-reservation'] . "?id=$id&action=update&panel=$panel");
}

// Fermeture de la connexion à la base de données
if ($cnx) {
    $cnx->close();
}