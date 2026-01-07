
$host = "sql111.infinityfree.com"; // hostu
$user = "if0_40382618"; // Useru
$pass = "parolanuecomuna"; // parola
$db = "if0_40382618_transport"; 

$conn = mysqli_connect($host, $user, $pass, $db);

if (!$conn) {
    die("Eroare conectare DB: " . mysqli_connect_error());
}

session_start();

if (empty($_SESSION['csrf_token'])) {
    $_SESSION['csrf_token'] = bin2hex(random_bytes(32));
}

function checkRole($requiredRole) {
    if (!isset($_SESSION['role']) || $_SESSION['role'] !== $requiredRole) {
        die("Acces interzis! Nu ai drepturile necesare.");
    }
}
?>
