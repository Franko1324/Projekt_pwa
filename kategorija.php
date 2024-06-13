<?php

session_start();
include 'connect.php';

$kategorija = isset($_GET['kategorija']) ? $conn->real_escape_string($_GET['kategorija']) : '';

$sql = "SELECT id, naslov, slika, sazetak FROM clanci WHERE kategorija='$kategorija' AND arhiva=0 ORDER BY id DESC";
$result = $conn->query($sql);

if ($_SERVER["REQUEST_METHOD"] == "POST" && isset($_POST['obrisi'])) {
    
    $id = $_POST["id"];
    
    $sql = "DELETE FROM clanci WHERE id=?";
    $stmt = $conn->prepare($sql);
    $stmt->bind_param("i", $id);

    if ($stmt->execute()) {
        echo "Članak je uspješno obrisan.";
    } else {
        echo "Greška: " . $conn->error;
    }
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
                <?php
                    if (isset($_SESSION['razina']) && $_SESSION['razina'] !== '') {
            
                    echo '<li><a href="odjava.php">ODJAVA,'.$_SESSION['korisnicko_ime'].'</a></li>';
                    } 
            
     
  
                ?>
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
                            if (isset($_SESSION['razina']) && $_SESSION['razina'] == 1) {
                                echo "<form method='post' class='forma'>";
                                echo "<input type='hidden' name='id' value='" . $row["id"] . "'>";
                                echo "<a href='skripta.php?id=" . $row["id"] . "'class='uredibrisi'>Uredi</a>";
                                echo "<input  type='hidden' name='id' value='" . $row["id"] . "'>";
                                echo "<input class='uredibrisi' type='submit' name='obrisi' value='Obriši'>";
                                echo "</form>";
                            }
                        echo "</div>";
                    }
                } else {
                    echo "No clanci found.";
                }
                ?>
            </div>
        </section>
    </main>
    <footer>
        <p>© Le Parisien</p>
    </footer>
</body>
</html>
