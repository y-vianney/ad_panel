<?php
error_reporting(E_ALL);
ini_set('display_errors', 1);

$port = 80;
$host = "localhost";
$db = "bd_panel";

$cnx = mysqli_connect($host, "root", "", $db);

if ($cnx -> connect_errno) {  // Print message if connection failed
    echo "Failed to connect to MySQL!";
    exit();
}
