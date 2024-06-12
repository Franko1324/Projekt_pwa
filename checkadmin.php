<?php
session_start();

if (isset($_SESSION['razina'])) {
    if ($_SESSION['razina'] == 0) {
        echo "Error: You do not have the required permissions to access this page.";
    } else {
        header("Location: administracija.php");
        exit();
    }
} else {
    header("Location: administracija.php");
}
?>
