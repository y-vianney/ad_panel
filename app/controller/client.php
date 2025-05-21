<?php
require_once "../connect.php";
require_once "../functions.php";
require_once "../models/uri.php";


/*
 * CRUD - Create, Read, Update, Delete, for Client model (Entity)
 * @action: Value between "create", "update" and "delete" - helps to know what to do
 * @query: SQL query to execute
 * @result: Result of the query
 * @rows: Rows of the result
 */
$action = $_GET['action'] ?? null;

if (session_status() == PHP_SESSION_NONE)
    session_start();

if ($_SERVER['REQUEST_METHOD'] == 'GET') {
    if ($action == "logout") {
        $_SESSION['id'] = null;
        $msg = "Vous vous êtes déconnecté";

        header("Location: " . $baseUrls['authenticate'] . "?page=login&msg=$msg");
    } else {
        $query = "select * from client";

        $result = $cnx->query($query);
        $rows = $result->fetch_all();  // Check PHP documentation for fetch_all() - https://www.php.net/manual/en/mysqli-result.fetch-all.php
    }
}

if ($action == "register") {  // CREATE
    if (validateClient($_POST)) {
        $msg = "Votre compte a bien été créé";

        $nom = $_POST['nom'];
        $prenom = $_POST['prenom'];
        $adresse = $_POST['adresse'];
        $contact = $_POST['contact'];

        $query = "insert into client (nom, prenom, adresse, contact) values ('$nom','$prenom','$adresse','$contact')";

        // Checking for successful execution of the query
        if ($cnx->query($query) === TRUE) {
            $id = $cnx->insert_id;
            $email = $_POST['mail'];
            $pwd = $_POST['passwd'];

            $check = "select * from utilisateur where email='$email'";
            $user = $cnx->query($check);

            if ($user->num_rows > 0) {
                $msg = "Cette adresse est déjà utilisée.";
            } else {
                $hashed_pwd = password_hash($pwd, PASSWORD_DEFAULT);

                $query = "insert into utilisateur (email, password, client_id) values ('$email','$hashed_pwd','$id')";

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

        if (isset($id)) {
            $deleteQuery = "delete from client where id=$id";
            $cnx->query($deleteQuery);
        }

        $_SESSION['error'] = 1;
        header("Location: " . $baseUrls['authenticate'] . "?page=register&msg=$msg");
    } else echo "La vérification des données d'inscription n'est pas valide";
} elseif ($action == "login") {
    if (isset($_POST['mail']) && isset($_POST['passwd'])) {
        $msg = null;

        $email = $_POST['mail'];
        $password = $_POST['passwd'];

        $query = "
            select utilisateur.*, client.*
            from utilisateur inner join client on client.id=utilisateur.client_id
            where email = '$email'
        ";
        $result = $cnx->query($query);

        $row = $result->fetch_assoc() ?? [];

        if (count($row) > 0) {  //
            $hashed_pwd = $row['password'];

            if (password_verify($password, $hashed_pwd)) {
                session_start();
                $_SESSION['id'] = $row['id'];
                $_SESSION['lastname'] = $row['nom'];
                $_SESSION['firstname'] = $row['prenom'];
                $_SESSION['email'] = $email;
                $_SESSION['adresse'] = $row['adresse'];
                $_SESSION['contact'] = $row['contact'];
                $_SESSION['role'] = $row['role'];

                header("Location: " . $baseUrls['espace']);
            }
            else
                $msg = "Mot de passe incorrect";
        } else
            $msg = "Compte introuvable";

        if ($msg != null) {
            $_SESSION['error'] = 1;
            header("Location: " . $baseUrls['authenticate'] . "?page=login&msg=$msg");
        }
    } else echo "La vérification des données de connexion n'est pas valide";
} elseif ($action == "update") {  // UPDATE
    if (validateClient($_POST)) {
        $id = $_POST['id'];
        $msg = "Nous n'avons pas pu modifier vos informations. Veuillez réessayer";

        $nom = $_POST['nom'];
        $prenom = $_POST['prenom'];
        $adresse = $_POST['adresse'];
        $contact = $_POST['contact'];

        $query = "update client set nom = '$nom', prenom = '$prenom', adresse = '$adresse', contact = '$contact' where id = $id";

        if ($cnx->query($query) === TRUE) {
            $_SESSION['lastname'] = $nom;
            $_SESSION['firstname'] = $prenom;
            $_SESSION['adresse'] = $adresse;
            $_SESSION['contact'] = $contact;
            $_SESSION['error'] = 0;
            $msg = "Vos informations ont été modifiées.";
        }
        else
            $_SESSION["error"] = 1;

        $referer = $_SERVER['HTTP_REFERER'];
        $url = parse_url($referer, PHP_URL_PATH);
        header("Location: $url?option=update-user&msg=$msg");
    } else echo "La vérification des données de modification n'est pas valide";
} elseif ($action == "delete") {  // DELETE
    $id = $_GET['id'];

    $query = "delete from client where id = $id";

    if ($cnx->query($query) === TRUE) {
        echo "Record deleted successfully";
    } else {
        echo "Error deleting record: " . $cnx->error;
    }
}

if ($cnx) {  // Closing connection
    $cnx->close();
}
