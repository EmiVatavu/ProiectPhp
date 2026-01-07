<?php include 'config.php'; ?>
<!DOCTYPE html>
<html lang="ro">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Contact</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
    <script src="https://www.google.com/recaptcha/api.js" async defer></script>
</head>
<body class="bg-light">

<nav class="navbar navbar-expand-lg navbar-dark bg-primary mb-5">
  <div class="container">
    <a class="navbar-brand" href="vehicule.php">Firma Mea</a>
  </div>
</nav>

<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-6">
            <div class="card shadow">
                <div class="card-header text-center bg-white">
                    <h3>✉️ Contactează-ne</h3>
                </div>
                <div class="card-body">
                    
                    <?php
                    if (isset($_POST['trimite'])) {
                        
                        $secretKey = "6LcE9jQsAAAAAElOk_yJ6-GBiFAe5rvrA9FX-AjH"; 

                        $responseKey = $_POST['g-recaptcha-response'];
                        $userIP = $_SERVER['REMOTE_ADDR'];
                        $url = "https://www.google.com/recaptcha/api/siteverify?secret=$secretKey&response=$responseKey&remoteip=$userIP";
                        $response = file_get_contents($url);
                        $responseKeys = json_decode($response, true);

                        if($responseKeys["success"]) {
                            $nume = htmlspecialchars($_POST['nume']);
                            $mesaj = htmlspecialchars($_POST['mesaj']);
                            $to = "admin_firma@test.com"; // adresa cu mailu
                            $subject = "Mesaj nou de la $nume";
                            $headers = "From: no-reply@infinityfreeapp.com";

                          
                            if(mail($to, $subject, $mesaj, $headers)) {
                                echo "<div class='alert alert-success'>Email trimis cu succes!</div>";
                            } else {
                                echo "<div class='alert alert-warning'>Mesajul a fost procesat, dar serverul de mail nu răspunde (Limitare Hosting).</div>";
                            }
                        } else {
                            echo "<div class='alert alert-danger'>Verifică reCAPTCHA!</div>";
                        }
                    }
                    ?>

                    <form method="POST">
                        <div class="mb-3">
                            <label class="form-label">Nume:</label>
                            <input type="text" name="nume" class="form-control" required placeholder="Numele tău">
                        </div>

                        <div class="mb-3">
                            <label class="form-label">Mesaj:</label>
                            <textarea name="mesaj" class="form-control" rows="5" required placeholder="Scrie mesajul..."></textarea>
                        </div>

                        <div class="mb-3 d-flex justify-content-center">
                             <div class="g-recaptcha" data-sitekey="6LcE9jQsAAAAAO7T4195PlhIg4uFVLz9IvLS3EAd"></div>
                        </div>
                        
                        <div class="d-grid">
                            <button type="submit" name="trimite" class="btn btn-primary">Trimite Mesaj</button>
                        </div>
                    </form>
                </div>
                <div class="card-footer text-center">
                    <a href="vehicule.php" class="text-decoration-none">Înapoi la Dashboard</a>
                </div>
            </div>
        </div>
    </div>
</div>

</body>
</html>
