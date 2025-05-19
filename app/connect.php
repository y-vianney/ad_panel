<?php
require_once "models/uri.php";

if (session_status() == PHP_SESSION_NONE)
    session_start();

$session = $_SESSION['id'] ?? null;
if (!$session)
    header('Location: ' . $baseUrls['index']);

error_reporting(E_ALL);
ini_set('display_errors', 1);

$port = 80;
$host = "localhost";
$db = "bd_panel";

$cnx = mysqli_connect($host, "root", "", $db);

if ($cnx -> connect_errno) {  // Print message if connection failed
    echo "Failed to connect to MySQL!";
    exit();
} else {
    $autoUpdateQuery = "
        select * from reservation;
    ";
    $result = $cnx->query($autoUpdateQuery);
    $rows = $result->fetch_all(MYSQLI_ASSOC);
    $outdatedRows = array_filter($rows, function ($row) {
        $currDate = date("Y-m-d");
        $reservationDate = date("Y-m-d", strtotime($row['date_fin']));

        return $currDate > $reservationDate;
    });

    $outdatedRows = array_values($outdatedRows);
    if (count($outdatedRows) > 0) {
        foreach ($outdatedRows as $row) {
            $id = $row['id'];

            $updatePanelQuery = "update panneau set etat='Disponible', reservation_id=0 where reservation_id=$id";
            $updateReservationQuery = "update reservation set statut='Inactive' where id=$id'";

            if (!$cnx->query($updatePanelQuery) || !$cnx->query($updateReservationQuery)) {
                echo "Failed to update outdated data!";
                exit();
            }
        }
    }
}
