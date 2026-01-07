<?php include 'config.php'; checkRole('admin'); 
$id = $_GET['id'];
$stmt = mysqli_prepare($conn, "SELECT * FROM vehicule WHERE id=?");
mysqli_stmt_bind_param($stmt, "i", $id);
mysqli_stmt_execute($stmt);
$v = mysqli_fetch_assoc(mysqli_stmt_get_result($stmt));
?>
<!DOCTYPE html>
<html lang="ro">
<head>
    <meta charset="UTF-8">
    <title>Editare</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
</head>
<body class="bg-light p-5">
    <div class="container" style="max-width: 500px;">
        <div class="card shadow">
            <div class="card-header bg-warning">Editare Vehicul</div>
            <div class="card-body">
                <form method="POST">
                    <input type="hidden" name="csrf_token" value="<?= $_SESSION['csrf_token'] ?>">
                    <div class="mb-3">
                        <label class="form-label">Nr</label>
                        <input name="nr" value="<?= htmlspecialchars($v['nr_inmatriculare']) ?>" class="form-control" required>
                    </div>
                    <div class="mb-3">
                        <label class="form-label">Tip</label>
                        <input name="tip" value="<?= htmlspecialchars($v['tip']) ?>" class="form-control" required>
                    </div>
                    <div class="mb-3">
                        <label class="form-label">Capacitate</label>
                        <input name="cap" value="<?= htmlspecialchars($v['capacitate']) ?>" class="form-control" required>
                    </div>
                    <button name="update" class="btn btn-warning w-100">Actualizează</button>
                </form>
                 <div class="mt-3 text-center"><a href="vehicule.php">Înapoi</a></div>
            </div>
        </div>
    </div>
    <?php
    if (isset($_POST['update'])) {
        if ($_POST['csrf_token'] !== $_SESSION['csrf_token']) die("Eroare CSRF");
        $stmt = mysqli_prepare($conn, "UPDATE vehicule SET nr_inmatriculare=?, tip=?, capacitate=? WHERE id=?");
        mysqli_stmt_bind_param($stmt, "sssi", $_POST['nr'], $_POST['tip'], $_POST['cap'], $id);
        if (mysqli_stmt_execute($stmt)) header("Location: vehicule.php");
    }
    ?>
</body>
</html>
