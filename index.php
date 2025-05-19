<!DOCTYPE html>
<html lang="fr">
<head>
	<meta charset="utf-8">
	<title>AdPanel</title>
	<meta name="viewport" content="width=device-width, initial-scale=1, maximum-scale=1">

    <link rel="stylesheet" href="public/css/style.css"/>
</head>

<?php
require_once "app/models/uri.php";

if (session_status() == PHP_SESSION_NONE)
    session_start();

$session = $_SESSION['id'] ?? null;
$referer = $_SERVER['HTTP_REFERER'] ?? null;
$backUrl = $referer ?? $baseUrls['espace'];

if ($session)
    header("Location: $backUrl");
?>

<body style="padding: 25px">
	<span class="h1">Page d'accueil</span>
    <br><br>
    <a href="views/authentication.php?page=login">Allez vers la page de connexion</a>
</body>
</html>