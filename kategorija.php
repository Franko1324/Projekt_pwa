<?php
$conn = new mysqli('localhost', 'root', '', 'pwaprojekt');

if($conn->connect_error){
    die("Povezivanje neuspjelo: " . $conn->connect_error);
}

$kategorija = isset($_GET['kategorija']) ? $conn->real_escape_string($_GET['kategorija']) : '';

$sql = "SELECT id, naslov, slika, sazetak FROM clanci WHERE kategorija='$kategorija' AND arhiva=0 ORDER BY id DESC";
$result = $conn->query($sql);

$conn->close();
?>

<!DOCTYPE html>
<html lang="hr">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="style.css">
    <title><?php echo htmlspecialchars($kategorija); ?></title>
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
    <main>
        	<section class="clanci-section">
            <h2><?php echo htmlspecialchars($kategorija); ?></h2>
            <div class="clanci-container">
                <?php
                if ($result->num_rows > 0) {
                    while($row = $result->fetch_assoc()) {
                        echo "<div class='clanci-item'>";
                            echo "<a href='clanak.php?id=" . $row["id"] . "'>";
                            echo "<img src='" . $row["slika"] ."' alt='" . $row["naslov"] . "'>";
                            echo "<h3>" . $row["naslov"] . "</h3>";
                            echo "<p>" . $row["sazetak"] . "</p>";
                            echo "</a>";
                            echo "</div>";
                    }
                } else {
                    echo "No clanci found.";
                }
                ?>
            </div>
        </section>
    </main>
</body>
</html>