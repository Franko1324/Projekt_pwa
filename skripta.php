<?php
session_start();
include 'connect.php';
if (!isset($_SESSION['razina']) && $_SESSION['razina'] != 1) {
    header("Location: index.php");
    exit();
}

$conn = new mysqli("localhost", "root", "", "pwaprojekt");

if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $id = $_POST["id"];
    $naslov = isset($_POST["naslov"]) ? $_POST["naslov"] : '';
    $slika = isset($_POST["slika"]) ? $_POST["slika"] : '';
    $sazetak = isset($_POST["sazetak"]) ? $_POST["sazetak"] : '';
    $tekst = isset($_POST["tekst"]) ? $_POST["tekst"] : '';

    if (!empty($naslov) && !empty($slika) && !empty($sazetak) && !empty($tekst)) {
        $sql = "UPDATE clanci SET naslov=?, slika=?, sazetak=?, tekst=? WHERE id=?";
        $stmt = $conn->prepare($sql);
        $stmt->bind_param("ssssi", $naslov, $slika, $sazetak, $tekst, $id);

        if ($stmt->execute()) {
            echo "Članak je uspješno ažuriran.";
        } else {
            echo "Greška: " . $conn->error;
        }
        $stmt->close();
    } else {
        echo "Sva polja su obavezna.";
    }
}

if (isset($_GET['id'])) {
    $id = $_GET['id'];
    $sql = "SELECT id, naslov, slika, sazetak, tekst FROM clanci WHERE id=?";
    $stmt = $conn->prepare($sql);
    $stmt->bind_param("i", $id);
    $stmt->execute();
    $result = $stmt->get_result();
    $clanak = $result->fetch_assoc();
    $stmt->close();
}

$conn->close();
?>

<!DOCTYPE html>
<html lang="hr">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="style.css">
    <title>Uredi Članak</title>
</head>
<body>
    <header>
        <div class="logo">
            <img src="img/logo.png" alt="Le Parisien">
        </div>
    </header>
    <h2>Uredi Članak</h2>
    <form method="post">
        <input type="hidden" name="id" value="<?php echo isset($clanak['id']) ? $clanak['id'] : ''; ?>">
        <label for="naslov">Naslov:</label><br>
        <input type="text" id="naslov" name="naslov" value="<?php echo isset($clanak['naslov']) ? $clanak['naslov'] : ''; ?>"><br>
        <label for="slika">Slika URL:</label><br>
        <input type="text" id="slika" name="slika" value="<?php echo isset($clanak['slika']) ? $clanak['slika'] : ''; ?>"><br>
        <label for="sazetak">Sazetak:</label><br>
        <textarea id="sazetak" name="sazetak"><?php echo isset($clanak['sazetak']) ? $clanak['sazetak'] : ''; ?></textarea><br>
        <label for="tekst">Tekst:</label><br>
        <textarea id="tekst" name="tekst"><?php echo isset($clanak['tekst']) ? $clanak['tekst'] : ''; ?></textarea><br>
        <input type="submit" value="Spremi">
    </form>
    <a href="index.php">Natrag</a>
</body>
</html>
