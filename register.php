<?php include 'config.php'; 
if (isset($_SESSION['user_id'])) { header("Location: vehicule.php"); exit; }
?>
<!DOCTYPE html>
<html lang="ro">
<head>
    <meta charset="UTF-8">
    <title>Înregistrare</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
    <script src="https://www.google.com/recaptcha/api.js" async defer></script>
</head>
<body class="bg-secondary d-flex align-items-center justify-content-center" style="min-height: 100vh;">

<div class="card shadow p-4 mt-5 mb-5" style="width: 100%; max-width: 450px;">
    <h2 class="text-center mb-4">Creare Cont</h2>

    <?php
    if (isset($_POST['register'])) {
        $secretKey = "6LcE9jQsAAAAAElOk_yJ6-GBiFAe5rvrA9FX-AjH"; 
        $responseKey = $_POST['g-recaptcha-response'];
        $userIP = $_SERVER['REMOTE_ADDR'];
        $url = "https://www.google.com/recaptcha/api/siteverify?secret=$secretKey&response=$responseKey&remoteip=$userIP";
        $response = file_get_contents($url);
        $responseKeys = json_decode($response, true);

        if($responseKeys["success"]) {
            $nume = trim($_POST['nume']);
            $email = trim($_POST['email']);
            $pass1 = $_POST['parola'];
            $pass2 = $_POST['parola2'];

            if ($pass1 !== $pass2) {
                echo "<div class='alert alert-warning'>Parolele nu coincid!</div>";
            } else {
                $check = mysqli_prepare($conn, "SELECT id FROM utilizatori WHERE email = ?");
                mysqli_stmt_bind_param($check, "s", $email);
                mysqli_stmt_execute($check);
                mysqli_stmt_store_result($check);

                if (mysqli_stmt_num_rows($check) > 0) {
                    echo "<div class='alert alert-warning'>Email deja existent.</div>";
                } else {
                    $pass_hash = password_hash($pass1, PASSWORD_DEFAULT);
                    $role = 'user'; 
                    $stmt = mysqli_prepare($conn, "INSERT INTO utilizatori (nume, email, parola_hash, role) VALUES (?, ?, ?, ?)");
                    mysqli_stmt_bind_param($stmt, "ssss", $nume, $email, $pass_hash, $role);
                    
                    if (mysqli_stmt_execute($stmt)) {
                        echo "<div class='alert alert-success'>Cont creat! <a href='login.php'>Logare</a></div>";
                    } else {
                        echo "<div class='alert alert-danger'>Eroare SQL.</div>";
                    }
                }
            }
        } else {
            echo "<div class='alert alert-danger'>Bifează că nu ești robot!</div>";
        }
    }
    ?>

    <form method="POST">
        <div class="mb-3">
            <label class="form-label">Nume complet</label>
            <input type="text" name="nume" class="form-control" required>
        </div>
        <div class="mb-3">
            <label class="form-label">Email</label>
            <input type="email" name="email" class="form-control" required>
        </div>
        <div class="mb-3">
            <label class="form-label">Parola</label>
            <input type="password" name="parola" class="form-control" required>
        </div>
        <div class="mb-3">
            <label class="form-label">Confirmă Parola</label>
            <input type="password" name="parola2" class="form-control" required>
        </div>

        <div class="mb-3 d-flex justify-content-center">
             <div class="g-recaptcha" data-sitekey="6LcE9jQsAAAAAO7T4195PlhIg4uFVLz9IvLS3EAd"></div>
        </div>

        <div class="d-grid">
            <button type="submit" name="register" class="btn btn-success">Înregistrare</button>
        </div>
    </form>
    <div class="text-center mt-3">
        <a href="login.php">Ai deja cont? Logare</a>
    </div>
</div>

</body>
</html>
