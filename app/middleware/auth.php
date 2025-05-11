<?php
session_start();

$session = $_SESSION['id'];

if ($session == null)
    header("Location: http://localhost/pannel/views/client/login.php");
