<?php
// Inclusion des fichiers nécessaires
require_once "../connect.php";    // Connection à la base de données
require_once "../functions.php";  // Fonctions utilitaires
require_once "../models/uri.php"; // Configuration des URLs

// Récupération de l'action à effectuer depuis l'URL
$action = $_GET['action'] ?? null;

// Gestion de la création d'un nouveau panneau
if ($action == 'create') {
    // Validation des données du formulaire
    if (validatePanneau($_POST)) {
        // Récupération des données du formulaire
        $emplacement = $_POST['emplacement'];
        $longueur = $_POST['longueur'];
        $largeur = $_POST['largeur'];
        $type = $_POST['type'];
        $etat = $_POST['etat'];
        $prix = $_POST['prix'];
        $description = $_POST['description'];

        // Préparation de la requête d'insertion
        $query = "
            insert into panneau (emplacement, longueur, largeur, type, etat, prix, description)
            values (
                '$emplacement',
                '$longueur',
                '$largeur',
                '$type',
                '$etat',
                '$prix',
                '$description'
            )
        ";

        // Exécution de la requête et redirection
        if ($cnx->query($query) === TRUE)
            header("Location: " . $baseUrls['panneaux']);
        else
            echo "Error: " . $query . "<br>" . $cnx->error;
    } else echo "La vérification n'est pas valide";
} 
// Gestion de la mise à jour d'un panneau (à implémenter)
elseif ($action == 'update') {
    echo "";
} 
// Gestion de la suppression d'un panneau
elseif ($action == 'delete') {
    // Sauvegarde de l'URL précédente pour la redirection
    $referer = $_SERVER['HTTP_REFERER'];

    // Récupération de l'ID du panneau à supprimer
    $id = $_GET['id'];
    $isDeletable = false;

    // Vérification si le panneau n'est pas lié à une réservation
    $queryDeletable = "select * from panneau where id = $id and reservation_id != 0";
    $resultDeletable = $cnx->query($queryDeletable);
    if ($resultDeletable->num_rows === 0)
        $isDeletable = true;

    if ($isDeletable) {
        // Suppression du panneau si possible
        $query = "delete from panneau where id = $id";

        if ($cnx->query($query) === TRUE) {
            header("Location: " . $baseUrls['panneaux']);
        }
    } else {
        // Message d'erreur si le panneau est lié à une réservation
        header("Location: $referer&msg=Impossible de supprimer le panneau. Vérifier si aucune réservation n'est reliée à ce panneau.");
    }
}

// Fermeture de la connexion à la base de données
if ($cnx) {
    $cnx->close();
}