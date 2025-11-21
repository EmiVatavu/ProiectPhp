<?php
include 'config.php';

if (!isset($_SESSION['user_id'])) {
    header("Location: login.php");
    exit;
}

$r = mysqli_query($conn, "SELECT * FROM vehicule");
?>

<h1>Lista vehicule</h1>
<a href="add_vehicul.php">Adaugă vehicul</a>
<a href="logout.php">Logout</a>
<br><br>

<table border="1">
<tr>
    <th>ID</th>
    <th>Număr înmatriculare</th>
    <th>Tip</th>
    <th>Capacitate</th>
    <th>Acțiuni</th>
</tr>

<?php while($v = mysqli_fetch_assoc($r)): ?>
<tr>
    <td><?= $v['id'] ?></td>
    <td><?= $v['nr_inmatriculare'] ?></td>
    <td><?= $v['tip'] ?></td>
    <td><?= $v['capacitate'] ?></td>
    <td>
        <a href="edit_vehicul.php?id=<?= $v['id'] ?>">Editare</a> |
        <a href="delete_vehicul.php?id=<?= $v['id'] ?>">Ștergere</a>
    </td>
</tr>
<?php endwhile; ?>

</table>
