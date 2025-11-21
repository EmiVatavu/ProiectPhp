<?php include 'config.php';

$id = $_GET['id'];
$r = mysqli_query($conn, "SELECT * FROM vehicule WHERE id=$id");
$v = mysqli_fetch_assoc($r);
?>

<form method="POST">
    Nr: <input name="nr" value="<?= $v['nr_inmatriculare'] ?>"><br>
    Tip: <input name="tip" value="<?= $v['tip'] ?>"><br>
    Capacitate: <input name="cap" value="<?= $v['capacitate'] ?>"><br>
    <button name="update">Actualizează</button>
</form>

<?php
if (isset($_POST['update'])) {
    mysqli_query($conn,"UPDATE vehicule SET 
        nr_inmatriculare='{$_POST['nr']}',
        tip='{$_POST['tip']}',
        capacitate='{$_POST['cap']}'
        WHERE id=$id");

    header("Location: vehicule.php");
}
?>
