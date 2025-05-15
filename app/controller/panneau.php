<?php
require_once "../connect.php";
require_once "../functions.php";

$action = $_GET['action'] ?? null;

if ($action == 'create') {
    if (validatePanneau($_POST)) {
        $emplacement = $_POST['emplacement'];
        $longueur = $_POST['longueur'];
        $largeur = $_POST['largeur'];
        $type = $_POST['type'];
        $etat = $_POST['etat'];
        $prix = $_POST['prix'];
        $description = $_POST['description'];

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

        if ($cnx->query($query) === TRUE)
            echo "Enregistré";
        else
            echo "Error: " . $query . "<br>" . $cnx->error;
    } else echo "La vérification n'est pas valide";
}
