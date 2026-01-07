<?php
include 'config.php';
checkRole('admin');

if (isset($_GET['id']) && isset($_GET['token'])) {
    if ($_GET['token'] !== $_SESSION['csrf_token']) {
        die("Eroare securitate. Link invalid.");
    }

    $id = $_GET['id'];
    $stmt = mysqli_prepare($conn, "DELETE FROM vehicule WHERE id=?");
    mysqli_stmt_bind_param($stmt, "i", $id);
    mysqli_stmt_execute($stmt);
}

header("Location: vehicule.php");
exit;
?>
