<?php include 'config.php'; checkRole('admin'); ?>
<!DOCTYPE html>
<html lang="ro">
<head>
    <meta charset="UTF-8">
    <title>Adaugă Vehicul</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
</head>
<body class="bg-light p-5">
    <div class="container" style="max-width: 500px;">
        <div class="card shadow">
            <div class="card-header bg-primary text-white">Adaugă Vehicul</div>
            <div class="card-body">
                <form method="POST">
                    <input type="hidden" name="csrf_token" value="<?= $_SESSION['csrf_token'] ?>">
                    
                    <div class="mb-3">
                        <label class="form-label">Nr. Înmatriculare</label>
                        <input name="nr" class="form-control" placeholder="Ex: B 100 ABC" required>
                    </div>

                    <div class="mb-3">
                        <label class="form-label">Tip</label>
                        <input type="text" name="tip" class="form-control" placeholder="Ex: Camion, Dubă, Autoturism..." required>
                    </div>

                    <div class="mb-3">
                        <label class="form-label">Capacitate</label>
                        <input name="cap" class="form-control" placeholder="Ex: 5 tone / 4 persoane" required>
                    </div>

                    <button name="save" class="btn btn-success w-100">Salvează</button>
                </form>
                <div class="mt-3 text-center"><a href="vehicule.php">Înapoi</a></div>
            </div>
        </div>
    </div>
    
    <?php
    if (isset($_POST['save'])) {
        if ($_POST['csrf_token'] !== $_SESSION['csrf_token']) die("Eroare CSRF");
        
        $nr = trim($_POST['nr']);
        $tip = trim($_POST['tip']);
        $cap = trim($_POST['cap']);

        $stmt = mysqli_prepare($conn, "INSERT INTO vehicule (nr_inmatriculare, tip, capacitate) VALUES (?, ?, ?)");
        mysqli_stmt_bind_param($stmt, "sss", $nr, $tip, $cap);
        
        if(mysqli_stmt_execute($stmt)) {
            header("Location: vehicule.php");
        } else {
            echo "<div class='alert alert-danger text-center mt-3'>Eroare la salvare!</div>";
        }
    }
    ?>
</body>
</html>
