<?php
require_once "auth.php";

if (session_status() == PHP_SESSION_NONE)
    session_start();

$role = $_SESSION['role'];

if ($role != 'admin')
    header("Location: http://localhost/ad_panel/");
