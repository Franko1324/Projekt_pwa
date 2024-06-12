<?php
session_start();
include 'connect.php';

if (isset($_SESSION['razina']) && $_SESSION['razina'] !== '') {
    // Redirect based on the value of 'razina'
    if ($_SESSION['razina'] == 0) {
        header("Location: index.php");
        exit(); // Stop further execution
    } elseif ($_SESSION['razina'] == 1) {
        header("Location: unos.php");
        exit(); // Stop further execution
    }
}

if ($_SERVER["REQUEST_METHOD"] == "POST") {

    $username = $_POST['ime'];
    $firstname = $_POST['prezime'];
    $lastname = $_POST['korisnicko_ime'];
    $password = $_POST['lozinka'];
    $confirm_password = $_POST['plozinka'];


    if ($password === $confirm_password) {
        $hashed_password = password_hash($password, PASSWORD_DEFAULT);
        $query = "INSERT INTO korisnici (ime, prezime, korisnicko_ime, lozinka, razina) VALUES (?, ?, ?, ?, 0)";

        $stmt = mysqli_prepare($conn, $query);
        if ($stmt) {
            mysqli_stmt_bind_param($stmt, "ssss", $firstname, $lastname,$username, $hashed_password);

            if (mysqli_stmt_execute($stmt)) {
                echo "Registracija uspjesna";
                header("location:index.php");
            } else {
                echo "Registracija neuspjesna";
            }
            mysqli_stmt_close($stmt);
        } else {
            echo "Greška u pripremi statementa: " . mysqli_error($conn);
        }
        mysqli_close($conn);
    } else {
        echo "Lozinke se ne podudaraju!";
    }
}
?>


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
    <form method="post">
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