<?php
include 'connect.php';
session_start();


if ($_SERVER["REQUEST_METHOD"] == "POST") {

    $username = $_POST['korisnicko_ime'];
    $password = $_POST['lozinka'];
    $query = "SELECT id, korisnicko_ime, lozinka, razina FROM korisnici WHERE korisnicko_ime = ?";
    if ($stmt = mysqli_prepare($conn, $query)) {
        mysqli_stmt_bind_param($stmt, "s", $username);
        mysqli_stmt_execute($stmt);
        mysqli_stmt_bind_result($stmt, $id, $username, $hashed_password, $level);
        if (mysqli_stmt_fetch($stmt)) {

            if (password_verify($password, $hashed_password)) {
                $_SESSION['korisnicko_ime'] = $username;
                $_SESSION['razina'] = $level;
                echo "Prijava uspješna! Dobrodošao, " . htmlspecialchars($username) . ".";
                header("Location: index.php");
            } else {
                echo "Pogrešno korisničko ime ili lozinka.";
            }
        } else {
            echo "Pogrešno korisničko ime ili lozinka.";
        }
        mysqli_stmt_close($stmt);
    } else {
        echo "Greška u pripremi statementa: " . mysqli_error($conn);
    }
    mysqli_close($conn);
}





?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="style.css">
    <title>Login</title>
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
    <form enctype="multipart/form-data" method="post">
            <input type="text" name="korisnicko_ime" placeholder="Korisničko ime" required><br>
            <input type="password" name="lozinka" placeholder="Lozinka" required><br>
            </select><br>
            <center><button type="submit">Pošalji</button></center>
    </form>
</body>
</html>