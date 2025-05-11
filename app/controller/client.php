<?php
require_once "../connect.php";
require_once "../functions.php";


/*
 * CRUD - Create, Read, Update, Delete, for Client model (Entity)
 * @action: Value between "create", "update" and "delete" - helps to know what to do
 * @query: SQL query to execute
 * @result: Result of the query
 * @rows: Rows of the result
 */
$action = $_GET['action'] ?? null;

if ($_SERVER['REQUEST_METHOD'] == 'GET') {
    $query = "select * from client";

    $result = $cnx->query($query);
    $rows = $result->fetch_all();  // Check PHP documentation for fetch_all() - https://www.php.net/manual/en/mysqli-result.fetch-all.php
}

if ($action && $action == "create") {  // CREATE
    if (validateClient($_POST)) {
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
                echo "User found";
                exit;
            }

            $hashed_pwd = password_hash($pwd, PASSWORD_DEFAULT);

            $query = "insert into utilisateur (email, password, client_id) values ('$email','$hashed_pwd','$id')";

            if ($cnx->query($query) === TRUE)
                header("Location: http://localhost/pannel/views/client/login.php");
            else
                echo "Error";
        } else {
            echo "Error: " . $query . "<br>" . $cnx->error;
        }
    }
} elseif ($action && $action == "login") {
    if (isset($_POST['mail']) && isset($_POST['passwd'])) {
        $msg = null;

        $email = $_POST['mail'];
        $password = $_POST['passwd'];

        $query = "
            select utilisateur.*, client.nom, client.prenom
            from utilisateur inner join client on client.id=utilisateur.client_id
            where email = '$email'
        ";
        $result = $cnx->query($query);

        $row = $result->fetch_assoc() ?? [];

        /**
         * row = [
         *  ["email" => "value"],
         *  ....
         * ]
         *
         * row = ["email" => "value", "password" => "value"]
         */

        if (count($row) > 0) {  //
            $hashed_pwd = $row['password'];

            if (password_verify($password, $hashed_pwd)) {
                session_start();
                $_SESSION['id'] = $row['id'];
                $_SESSION['nom'] = $row['nom'];

                header("Location: http://localhost/pannel/views/client/espace.php");
            }
            else
                $msg = "Mot de passe incorrect";
        } else
            $msg = "Compte introuvable";

        if ($msg != null)
            header("Location: http://localhost/pannel/views/client/login.php?msg=" . $msg);
    }
} elseif ($action && $action == "logout") {
    if (session_status() == PHP_SESSION_NONE)
        session_start();

    $_SESSION['id'] = null;
    $msg = "Vous vous êtes déconnecté";

    header("Location: http://localhost/pannel/views/client/login.php?msg=" . $msg);
}
elseif ($action && $action == "update") {  // UPDATE
    if (validateClient($_POST)) {
        $id = $_POST['id'];

        $nom = $_POST['nom'];
        $prenom = $_POST['prenom'];
        $adresse = $_POST['adresse'];
        $contact = $_POST['contact'];

        $query = "update client set nom = '$nom', prenom = '$prenom', adresse = '$adresse', contact = '$contact' where id = $id";

        if ($cnx->query($query) === TRUE) {
            echo "Record updated successfully";
        } else {
            echo "Error updating record: " . $cnx->error;
        }
    }
} elseif ($action && $action == "delete") {  // DELETE
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
