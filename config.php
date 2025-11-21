<?php
$host = "localhost";
$user = "root";
$pass = "";
$db = "transport";

$conn = mysqli_connect($host, $user, $pass, $db);

if (!$conn) {
    die("Eroare conectare DB: " . mysqli_connect_error());
}

session_start();
?>
