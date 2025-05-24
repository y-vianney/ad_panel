<?php
// Inclusion du fichier de configuration des URLs
require_once "models/uri.php";

// Démarrage de la session si elle n'est pas déjà active
if (session_status() == PHP_SESSION_NONE)
    session_start();

// Configuration des rapports d'erreurs PHP
error_reporting(E_ALL);          // Activer tous les rapports d'erreurs
ini_set('display_errors', 1);    // Afficher les erreurs à l'écran

// Configuration de la connexion à la base de données
$port = 80;                      // Port par défaut pour MySQL
$host = "localhost";             // Hôte de la base de données
$db = "bd_panel";               // Nom de la base de données

// Tentative de connexion à MySQL
$cnx = mysqli_connect($host, "root", "", $db);

// Vérification de la connexion
if ($cnx -> connect_errno) {
    echo "Failed to connect to MySQL!";
    exit();
} else {
    // Requête pour récupérer toutes les réservations
    $autoUpdateQuery = "
        select * from reservation;
    ";
    $result = $cnx->query($autoUpdateQuery);
    $rows = $result->fetch_all(MYSQLI_ASSOC);

    // Filtrer les réservations expirées (date de fin dépassée)
    $outdatedRows = array_filter($rows, function ($row) {
        $currDate = date("Y-m-d");                               // Date actuelle
        $reservationDate = date("Y-m-d", strtotime($row['date_fin'])); // Date de fin de réservation

        return $currDate > $reservationDate;                     // Retourne true si la réservation est expirée
    });

    // Réindexation du tableau après filtrage
    $outdatedRows = array_values($outdatedRows);

    // Mise à jour des réservations expirées
    if (count($outdatedRows) > 0) {
        foreach ($outdatedRows as $row) {
            $id = $row['id'];

            // Mise à jour du statut du panneau (disponible) et suppression de la référence à la réservation
            $updatePanelQuery = "update panneau set etat='Disponible', reservation_id=0 where reservation_id=$id";
            // Mise à jour du statut de la réservation (inactive)
            $updateReservationQuery = "update reservation set statut='Inactive' where id=$id";

            // Vérification de la bonne exécution des requêtes de mise à jour
            if (!$cnx->query($updatePanelQuery) || !$cnx->query($updateReservationQuery)) {
                echo "Failed to update outdated data!";
                exit();
            }
        }
    }
}