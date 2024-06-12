<?php
session_start();
unset($_SESSION['razina']);
unset($_SESSION['korisnicko_ime']);
     header('location:index.php');
    ?>


