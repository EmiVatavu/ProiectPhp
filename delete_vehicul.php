<?php
include 'config.php';
$id = $_GET['id'];

mysqli_query($conn, "DELETE FROM vehicule WHERE id=$id");
header("Location: vehicule.php");
