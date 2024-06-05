<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Prikaz Vijesti</title>
    <link rel="stylesheet" href="style.css">
</head>
<body>
    <header>
    <div class="logo">
            <img src="slike/logo.png" alt="Le Parisien Logo">
            <h2>Detalji vijesti</h2>
        </div>
        <nav>
            <ul>
                <li><a href="index.html">HOME</a></li>
                <li><a href="parisien.html">PARISIEN</a></li>
                <li><a href="#">VIVRE</a></li>
                <li><a href="unos.html">ADMINISTRACIJA</a></li>
            </ul>
        </nav>
    </header>
    <main>
    <?php
        if ($_SERVER["REQUEST_METHOD"] == "POST") {
            $title = htmlspecialchars($_POST['title']);
            $about = htmlspecialchars($_POST['about']);
            $content = htmlspecialchars($_POST['content']);
            $category = htmlspecialchars($_POST['category']);
            $archive = isset($_POST['archive']) ? 'Da' : 'Ne';
            
            $target_dir = "uploads/";
            if (!is_dir($target_dir)) {
                mkdir($target_dir, 0777, true);
            }
            
            $target_file = $target_dir . basename($_FILES["pphoto"]["name"]);
            if (move_uploaded_file($_FILES["pphoto"]["tmp_name"], $target_file)) {
                echo "<h2>$title</h2>";
                echo "<p><strong>Kratki sadržaj:</strong> $about</p>";
                echo "<p><strong>Sadržaj:</strong> $content</p>";
                echo "<p><strong>Kategorija:</strong> $category</p>";
                echo "<p><strong>Arhiva:</strong> $archive</p>";
                echo "<img src='$target_file' alt='Slika vijesti'>";
            } else {
                echo "<p>Nažalost, došlo je do pogreške prilikom učitavanja vaše datoteke.</p>";
            }
        } else {
            echo "<p>Nevažeći zahtjev.</p>";
        }
        ?>
    </main>
    <footer>
        <p>© Le Parisien</p>
    </footer>
</body>
</html>