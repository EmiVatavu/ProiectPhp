<?php include 'config.php'; ?>

<form method="POST">
    Email: <input type="text" name="email"><br>
    Parola: <input type="password" name="parola"><br>
    <button type="submit" name="login">Autentificare</button>
</form>

<?php
if (isset($_POST['login'])) {
    $email = $_POST['email'];
    $parola = $_POST['parola'];

    $q = mysqli_query($conn, "SELECT * FROM utilizatori WHERE email='$email'");
    if ($q && mysqli_num_rows($q) == 1) {
        $user = mysqli_fetch_assoc($q);

        if (password_verify($parola, $user['parola_hash'])) {
            $_SESSION['user_id'] = $user['id'];
            header("Location: vehicule.php");
            exit;
        } else {
            echo "Parola greșită!";
        }
    } else {
        echo "Email inexistent!";
    }
}
?>
