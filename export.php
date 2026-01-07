<?php
include 'config.php';


if (!isset($_SESSION['user_id'])) {
    header("Location: login.php");
    exit;
}


header("Content-Type: application/vnd.ms-excel");
header("Content-Disposition: attachment; filename=lista_vehicule.xls");
header("Pragma: no-cache");
header("Expires: 0");


echo '<table border="1">';
echo '<tr>
        <th style="background-color:yellow;">ID</th>
        <th style="background-color:yellow;">Numar Inmatriculare</th>
        <th style="background-color:yellow;">Tip</th>
        <th style="background-color:yellow;">Capacitate</th>
      </tr>';

$result = mysqli_query($conn, "SELECT * FROM vehicule");
while ($row = mysqli_fetch_assoc($result)) {
    echo '<tr>
            <td>'.$row['id'].'</td>
            <td>'.$row['nr_inmatriculare'].'</td>
            <td>'.$row['tip'].'</td>
            <td>'.$row['capacitate'].'</td>
          </tr>';
}
echo '</table>';
exit;
?>
