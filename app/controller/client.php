<?php
// Inclusion des fichiers requis
require_once "../connect.php";  // Connexion à la base de données
require_once "../functions.php";  // Fonctions utilitaires
require_once "../models/uri.php";  // Configuration des URLs

/*
 * Contrôleur pour la gestion des clients
 * Implémente les opérations CRUD (Create, Read, Update, Delete) et l'authentification
 */

// Récupération de l'action depuis l'URL, null si non définie
$action = $_GET['action'] ?? null;

// Démarrage de la session si elle n'est pas déjà active
if (session_status() == PHP_SESSION_NONE)
    session_start();

// Traitement des requêtes GET
if ($_SERVER['REQUEST_METHOD'] == 'GET') {
    if ($action == "logout") {
        // Déconnexion : destruction de la session et redirection
        $_SESSION['id'] = null;
        $msg = "Vous vous êtes déconnecté";
        header("Location: " . $baseUrls['authenticate'] . "?page=login&msg=$msg");
    } else {
        // Récupération de la liste des clients
        $query = "select * from client";
        $result = $cnx->query($query);
        $rows = $result->fetch_all();
    }
}

// Traitement de l'inscription d'un nouveau client
if ($action == "register") {
    if (validateClient($_POST)) {  // Validation des données du formulaire
        $msg = "Votre compte a bien été créé";

        // Récupération des données du formulaire
        $nom = $_POST['nom'];
        $prenom = $_POST['prenom'];
        $adresse = $_POST['adresse'];
        $contact = $_POST['contact'];

        // Insertion du nouveau client dans la base de données
        $query = "insert into client (nom, prenom, adresse, contact) values ('$nom','$prenom','$adresse','$contact')";

        if ($cnx->query($query) === TRUE) {
            // Récupération de l'ID du client créé
            $id = $cnx->insert_id;
            $email = $_POST['mail'];
            $pwd = $_POST['passwd'];

            // Vérification de l'unicité de l'email
            $check = "select * from utilisateur where email='$email'";
            $user = $cnx->query($check);

            if ($user->num_rows > 0) {
                $msg = "Cette adresse est déjà utilisée.";
            } else {
                // Hashage du mot de passe et création de l'utilisateur
                $hashed_pwd = password_hash($pwd, PASSWORD_DEFAULT);
                $query = "insert into utilisateur (email, password, role, client_id) values ('$email','$hashed_pwd','client','$id')";

                if ($cnx->query($query) === TRUE) {
                    $_SESSION['error'] = 0;
                    header("Location: " . $baseUrls['authenticate'] . "?page=login?msg=$msg");
                    exit();
                }
                else
                    $msg = "Une erreur est survenue lors de l'enregistrement de votre compte. Veuillez contacter un administrateur.";
            }
        } else {
            $msg = "Une erreur est survenue lors de l'enregistrement de votre compte. Veuillez contacter un administrateur.";
        }

        // Nettoyage : suppression du client si l'utilisateur n'a pas pu être créé
        if (isset($id)) {
            $deleteQuery = "delete from client where id=$id";
            $cnx->query($deleteQuery);
        }

        $_SESSION['error'] = 1;
        header("Location: " . $baseUrls['authenticate'] . "?page=register&msg=$msg");
    } else echo "La vérification des données d'inscription n'est pas valide";
}
// Traitement de la connexion
elseif ($action == "login") {
    if (isset($_POST['mail']) && isset($_POST['passwd'])) {
        $msg = null;
        $email = $_POST['mail'];
        $password = $_POST['passwd'];

        // Récupération des informations de l'utilisateur et du client associé
        $query = "
            select utilisateur.*, client.*
            from utilisateur inner join client on client.id=utilisateur.client_id
            where email = '$email'
        ";
        $result = $cnx->query($query);
        $row = $result->fetch_assoc() ?? [];

        if (count($row) > 0) {
            // Vérification du mot de passe
            $hashed_pwd = $row['password'];
            if (password_verify($password, $hashed_pwd)) {
                // Création de la session utilisateur avec ses informations
                session_start();
                $_SESSION['id'] = $row['id'];
                $_SESSION['lastname'] = $row['nom'];
                $_SESSION['firstname'] = $row['prenom'];
                $_SESSION['email'] = $email;
                $_SESSION['adresse'] = $row['adresse'];
                $_SESSION['contact'] = $row['contact'];
                $_SESSION['role'] = $row['role'];

                // Redirection selon le rôle de l'utilisateur
                $url = $row['role'] == 'admin' ? $baseUrls['dashboard'] : $baseUrls['espace'];
                header("Location: " . $url);
            }
            else
                $msg = "Mot de passe incorrect";
        } else
            $msg = "Compte introuvable";

        // Gestion des erreurs de connexion
        if ($msg != null) {
            $_SESSION['error'] = 1;
            header("Location: " . $baseUrls['authenticate'] . "?page=login&msg=$msg");
        }
    } else echo "La vérification des données de connexion n'est pas valide";
}
// Mise à jour des informations client
elseif ($action == "update") {
    if (validateClient($_POST)) {
        $id = $_POST['id'];
        $msg = "Nous n'avons pas pu modifier vos informations. Veuillez réessayer";

        // Récupération des nouvelles données
        $nom = $_POST['nom'];
        $prenom = $_POST['prenom'];
        $adresse = $_POST['adresse'];
        $contact = $_POST['contact'];

        // Mise à jour dans la base de données
        $query = "update client set nom = '$nom', prenom = '$prenom', adresse = '$adresse', contact = '$contact' where id = $id";

        if ($cnx->query($query) === TRUE) {
            // Mise à jour des données de session
            $_SESSION['lastname'] = $nom;
            $_SESSION['firstname'] = $prenom;
            $_SESSION['adresse'] = $adresse;
            $_SESSION['contact'] = $contact;
            $_SESSION['error'] = 0;
            $msg = "Vos informations ont été modifiées.";
        }
        else
            $_SESSION["error"] = 1;

        // Redirection vers la page précédente
        $referer = $_SERVER['HTTP_REFERER'];
        $url = parse_url($referer, PHP_URL_PATH);
        header("Location: $url?option=update-user&msg=$msg");
    } else echo "La vérification des données de modification n'est pas valide";
}
// Suppression d'un client
elseif ($action == "delete") {
    $id = $_GET['id'];
    $query = "delete from client where id = $id";

    if ($cnx->query($query) === TRUE) {
        echo "Record deleted successfully";
    } else {
        echo "Error deleting record: " . $cnx->error;
    }
}

// Fermeture de la connexion à la base de données
if ($cnx) {
    $cnx->close();
}