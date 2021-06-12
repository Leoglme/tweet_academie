<?php
if (session_status() === PHP_SESSION_NONE) {
    session_start();
}
$filename = "../../" . explode("/", $_SERVER["PHP_SELF"])[1];
if (!isset($_SESSION) || empty($_SESSION)) {
    header("Location: " . $filename . "/Bienvenue");
}

