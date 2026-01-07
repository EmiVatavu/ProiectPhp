<?php include 'config.php'; ?>
<!DOCTYPE html>
<html lang="ro">
<head>
    <meta charset="UTF-8">
    <title>Autentificare</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
</head>
<body class="bg-secondary d-flex align-items-center justify-content-center" style="height: 100vh;">

<div class="card shadow p-4" style="width: 100%; max-width: 400px;">
    <h2 class="text-center mb-4">Autentificare</h2>

    <?php
    if (isset($_POST['login'])) {
        if (!isset($_POST['csrf_token']) || $_POST['csrf_token'] !== $_SESSION['csrf_token']) {
            echo "<div class='alert alert-danger'>Eroare CSRF</div>";
        } else {
            $email = $_POST['email'];
            $parola = $_POST['parola'];
            $stmt = mysqli_prepare($conn, "SELECT id, parola_hash, role FROM utilizatori WHERE email = ?");
            mysqli_stmt_bind_param($stmt, "s", $email);
            mysqli_stmt_execute($stmt);
            $res = mysqli_stmt_get_result($stmt);

            if ($row = mysqli_fetch_assoc($res)) {
                if (password_verify($parola, $row['parola_hash'])) {
                    session_regenerate_id(true);
                    $_SESSION['user_id'] = $row['id'];
                    $_SESSION['role'] = $row['role']; 
                    header("Location: vehicule.php");
                    exit;
                } else {
                    echo "<div class='alert alert-danger'>Parolă greșită!</div>";
                }
            } else {
                echo "<div class='alert alert-danger'>Email inexistent!</div>";
            }
        }
    }
    ?>

    <form method="POST">
        <input type="hidden" name="csrf_token" value="<?= $_SESSION['csrf_token'] ?>">
        <div class="mb-3">
            <label class="form-label">Email</label>
            <input type="text" name="email" class="form-control" required>
        </div>
        <div class="mb-3">
            <label class="form-label">Parola</label>
            <input type="password" name="parola" class="form-control" required>
        </div>
        <div class="d-grid">
            <button type="submit" name="login" class="btn btn-primary">Logare</button>
        </div>
    </form>
    <div class="text-center mt-3">
        <a href="register.php">Nu ai cont? Înregistrează-te</a>
    </div>
</div>

</body>
</html>
