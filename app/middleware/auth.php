<?php
if (session_status() == PHP_SESSION_NONE)
    session_start();

$session = $_SESSION['id'];

if ($session == null)
    header("Location: http://localhost/ad_panel/views/authentication.php");
