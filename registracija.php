<?php
session_start();
include 'connect.php';

if (isset($_SESSION['razina']) && $_SESSION['razina'] !== '') {
    if ($_SESSION['razina'] == 0) {
        header("Location: index.php");
        exit(); 
    } elseif ($_SESSION['razina'] == 1) {
        header("Location: unos.php");
        exit();
    }
}

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $firstname = $_POST['ime'];
    $lastname = $_POST['prezime'];
    $username = $_POST['korisnicko_ime'];
    $password = $_POST['lozinka'];
    $confirm_password = $_POST['plozinka'];

    if ($password === $confirm_password) {
        $hashed_password = password_hash($password, PASSWORD_DEFAULT);

        $query = "SELECT korisnicko_ime FROM korisnici WHERE korisnicko_ime = ?";
        $stmt = mysqli_prepare($conn, $query);
        if ($stmt) {
            mysqli_stmt_bind_param($stmt, "s", $username);
            mysqli_stmt_execute($stmt);
            mysqli_stmt_store_result($stmt);

            if (mysqli_stmt_num_rows($stmt) > 0) {
                echo "Korisničko ime već postoji!";
                mysqli_stmt_close($stmt);
            } else {
                mysqli_stmt_close($stmt);

                $query = "INSERT INTO korisnici (ime, prezime, korisnicko_ime, lozinka, razina) VALUES (?, ?, ?, ?, 0)";
                $stmt = mysqli_prepare($conn, $query);
                if ($stmt) {
                    mysqli_stmt_bind_param($stmt, "ssss", $firstname, $lastname, $username, $hashed_password);

                    if (mysqli_stmt_execute($stmt)) {
                        echo "Registracija uspješna";
                        header("Location: login.php");
                        exit();
                    } else {
                        echo "Registracija neuspješna";
                    }
                    mysqli_stmt_close($stmt);
                } else {
                    echo "Greška u pripremi statementa: " . mysqli_error($conn);
                }
            }
        } else {
            echo "Greška u pripremi statementa: " . mysqli_error($conn);
        }
        mysqli_close($conn);
    } else {
        echo "Lozinke se ne podudaraju!";
    }
}
?>