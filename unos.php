<?php
session_start();
?>



<!DOCTYPE html>
<html lang="hr">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Unos Vijesti</title>
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
                <li><a href="unos.php">UNOS VIJESTI</a></li>
            </ul>
        </nav>
    </header>
    <main>
        <form enctype="multipart/form-data" method="post" action="insert.php">
            <input type="text" name="naslov" placeholder="Naslov" required><br>
            <textarea name="sazetak" placeholder="Kratki sadržaj" required></textarea><br>
            <textarea name="tekst" placeholder="Cijeli sadržaj" required></textarea><br>
            <input type="file" name="slika" required><br>
            <select name="kategorija"><br>
            <option value="Parisien">Parisien</option>
            <option value="Vivre">Vivre</option>
            </select><br>
            <center><button type="submit">Pošalji</button></center>
        </form>
    </main>
    <footer>
        <p>© Le Parisien</p>
    </footer>
</body>
</html>