<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="style.css">
    <title>Registracija</title>
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
    <form method="post" action="registracija.php">
            <input type="text" name="ime" placeholder="Ime" required><br>
            <input type="text" name="prezime" placeholder="Prezime" required><br>
            <input type="text" name="korisnicko_ime" placeholder="Korisničko ime" required><br>
            <input type="password" name="lozinka" placeholder="Lozinka" required><br>
            <input type="password" name="plozinka" placeholder="Potvrdi lozinku" required><br>
        </select><br>
            <center><button type="submit">Pošalji</button></center>

            <a href="login.php" class="href">login</a>
    </form>
</body>
</html>
