<?php
session_start();


?>


<!DOCTYPE html>
<html lang="hr">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Le Parisien</title>
    <link rel="stylesheet" href="style.css">
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
                <li><a href="checkadmin.php">ADMINISTRACIJA</a></li>
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
            <h2>Parisien</h2>
            <div class="clanci-container">
                <?php
                $conn = new mysqli("localhost", "root", "", "pwaprojekt");

                if ($conn->connect_error) {
                    die("Connection failed: " . $conn->connect_error);
                }

                $sql = "SELECT id, naslov, slika, sazetak FROM clanci WHERE kategorija='parisien' AND arhiva=0 order by id desc limit 3";
                $result = $conn->query($sql);

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

                $conn->close();
                ?>
            </div>
        </section>
        <section class="clanci-section">
            <h2>Vivre Mieux</h2>
            <div class="clanci-container">
                <?php
                $conn = new mysqli("localhost", "root", "", "pwaprojekt");

                if ($conn->connect_error) {
                    die("Connection failed: " . $conn->connect_error);
                }

                $sql = "SELECT id, naslov, slika, sazetak FROM clanci WHERE kategorija='vivre' AND arhiva=0 order by id desc limit 3";
                $result = $conn->query($sql);

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

                $conn->close();
                ?>
            </div>
        </section>
    </main>
    <footer>
        <p>© Le Parisien</p>
    </footer>
</body>
</html>