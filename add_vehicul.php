<?php include 'config.php'; ?>

<form method="POST">
    Nr înmatriculare: <input name="nr"><br>
    Tip: <input name="tip"><br>
    Capacitate: <input name="cap"><br>
    <button name="save">Salvează</button>
</form>

<?php
if (isset($_POST['save'])) {
    $nr = $_POST['nr'];
    $tip = $_POST['tip'];
    $cap = $_POST['cap'];

    mysqli_query($conn, "INSERT INTO vehicule VALUES(NULL,'$nr','$tip','$cap')");
    header("Location: vehicule.php");
}
?>
