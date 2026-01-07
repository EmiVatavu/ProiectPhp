<?php
include 'config.php';

if (!isset($_SESSION['user_id'])) {
    header("Location: login.php");
    exit;
}


$r = mysqli_query($conn, "SELECT * FROM vehicule");


$graficQuery = mysqli_query($conn, "SELECT tip, COUNT(*) as numar FROM vehicule GROUP BY tip");
$graficLabels = [];
$graficData = [];
while($row = mysqli_fetch_assoc($graficQuery)) {
    $graficLabels[] = $row['tip'];
    $graficData[] = $row['numar'];
}


$curs_euro = "Indisponibil";
$url_api = "https://api.exchangerate-api.com/v4/latest/EUR";


$ch = curl_init();
curl_setopt($ch, CURLOPT_URL, $url_api);
curl_setopt($ch, CURLOPT_RETURNTRANSFER, 1);
$response = curl_exec($ch);
curl_close($ch);

if ($response) {
    $data = json_decode($response, true);
    if (isset($data['rates']['RON'])) {
        $curs_euro = $data['rates']['RON'] . " RON";
    }
}
?>

<!DOCTYPE html>
<html lang="ro">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Panou de Control - Transport</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
    <script src="https://cdn.jsdelivr.net/npm/chart.js"></script>
</head>
<body class="bg-light">

<nav class="navbar navbar-expand-lg navbar-dark bg-primary">
  <div class="container">
    <a class="navbar-brand" href="#">Firma Mea</a>
    <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarNav">
      <span class="navbar-toggler-icon"></span>
    </button>
    <div class="collapse navbar-collapse" id="navbarNav">
      <ul class="navbar-nav ms-auto">
        <li class="nav-item"><a class="nav-link active" href="vehicule.php">Vehicule</a></li>
        <li class="nav-item"><a class="nav-link" href="contact.php">Contact</a></li>
        <li class="nav-item"><span class="nav-link text-warning">Rol: <?= htmlspecialchars($_SESSION['role']) ?></span></li>
        <li class="nav-item"><a class="nav-link btn btn-danger text-white btn-sm ms-2" href="logout.php">Deconectare</a></li>
      </ul>
    </div>
  </div>
</nav>

<div class="container mt-4">
    
    <div class="row mb-4">
        <div class="col-md-4">
            <div class="card text-white bg-success mb-3">
                <div class="card-header">Integrare Externă</div>
                <div class="card-body">
                    <h5 class="card-title">Curs Valutar (București)</h5>
                    <p class="card-text display-6">1 EUR = <strong><?= $curs_euro ?></strong></p>
                    <small>Sursa: exchangerate-api.com</small>
                </div>
            </div>
        </div>
        
        <div class="col-md-8 text-end">
             <?php if ($_SESSION['role'] === 'admin'): ?>
                <a href="add_vehicul.php" class="btn btn-primary btn-lg">➕ Adaugă Vehicul</a>
            <?php endif; ?>
            <a href="export.php" class="btn btn-success btn-lg">📊 Export Excel</a>
        </div>
    </div>

    <div class="row">
        <div class="col-md-8">
            <div class="card shadow">
                <div class="card-header bg-white">
                    <h4>Flota Auto</h4>
                </div>
                <div class="card-body">
                    <div class="table-responsive">
                        <table class="table table-striped table-hover">
                            <thead class="table-dark">
                                <tr>
                                    <th>Nr. Înmatriculare</th>
                                    <th>Tip</th>
                                    <th>Capacitate</th>
                                    <?php if ($_SESSION['role'] === 'admin'): ?><th>Acțiuni</th><?php endif; ?>
                                </tr>
                            </thead>
                            <tbody>
                                <?php while($v = mysqli_fetch_assoc($r)): ?>
                                <tr>
                                    <td><?= htmlspecialchars($v['nr_inmatriculare']) ?></td>
                                    <td><?= htmlspecialchars($v['tip']) ?></td>
                                    <td><?= htmlspecialchars($v['capacitate']) ?></td>
                                    <?php if ($_SESSION['role'] === 'admin'): ?>
                                    <td>
                                        <a href="edit_vehicul.php?id=<?= $v['id'] ?>" class="btn btn-sm btn-warning">Edit</a>
                                        <a href="delete_vehicul.php?id=<?= $v['id'] ?>&token=<?= $_SESSION['csrf_token'] ?>" 
                                           onclick="return confirm('Sigur stergi?');" class="btn btn-sm btn-danger">Șterge</a>
                                    </td>
                                    <?php endif; ?>
                                </tr>
                                <?php endwhile; ?>
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>
        </div>

        <div class="col-md-4">
            <div class="card shadow">
                <div class="card-header bg-white">
                    <h4>Statistică Flotă</h4>
                </div>
                <div class="card-body">
                    <canvas id="myChart"></canvas>
                </div>
            </div>
        </div>
    </div>

</div>

<script>
    const ctx = document.getElementById('myChart').getContext('2d');
    const myChart = new Chart(ctx, {
        type: 'pie',
        data: {
            labels: <?= json_encode($graficLabels) ?>,
            datasets: [{
                label: '# Vehicule',
                data: <?= json_encode($graficData) ?>,
                backgroundColor: [
                    'rgba(255, 99, 132, 0.7)',
                    'rgba(54, 162, 235, 0.7)',
                    'rgba(255, 206, 86, 0.7)',
                    'rgba(75, 192, 192, 0.7)',
                    'rgba(153, 102, 255, 0.7)'
                ],
                borderWidth: 1
            }]
        }
    });
</script>

<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>
</body>
</html>
