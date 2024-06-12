<?php
$conn = new mysqli('localhost', 'root', '', 'pwaprojekt');

if($conn->connect_error){
    die("Povezivanje neuspjelo: " . $conn->connect_error);
}

if (!isset($_GET['id'])) {
    die("ID članka nije postavljen.");
}

$id = intval($_GET['id']);
$sql = "SELECT * FROM clanci WHERE id = $id";
$result = $conn->query($sql);

if ($result->num_rows == 0) {
    die("Članak nije pronađen.");
}

$clanak = $result->fetch_assoc();
$conn->close();
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="style.css">
    <title>Clanak</title>
</head>
<body>
<header>
        <div class="logo">
            <img src="img/logo.png" alt="Le Parisien">
        </div>
        <nav>
            <ul>
                <li><a href="index.php">HOME</a></li>
                <li><a href="kategorija.php?kategorija=Parisien">PARISIEN</a></li>
                <li><a href="kategorija.php?kategorija=Vivre">VIVRE</a></li>
                <li><a href="administracija.php">ADMINISTRACIJA</a></li>
            </ul>
        </nav>
    </header>
    <section class="clanak">
        <h2><?php echo htmlspecialchars($clanak['kategorija']); ?></h2>
        <h3><?php echo htmlspecialchars($clanak['naslov']); ?></h3>
        <img src="<?php echo htmlspecialchars($clanak['slika']); ?>" style="width:800px;" class=""slika1" alt="<?php echo htmlspecialchars($clanak['naslov']); ?>">
        <p><?php echo nl2br(htmlspecialchars($clanak['tekst'])); ?></p>
    </section>
</body>
</html>

