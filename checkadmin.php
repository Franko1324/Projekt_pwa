<?php
// Start the session
session_start();

// Check if the session variable 'razina' is set
if (isset($_SESSION['razina'])) {
    // Check the value of 'razina'
    if ($_SESSION['razina'] == 0) {
        // If 'razina' is 0, display an error message
        echo "Error: You do not have the required permissions to access this page.";
    } else {
        // If 'razina' is not 0, redirect to administracija.php
        header("Location: administracija.php");
        exit();
    }
} else {
    // If 'razina' is not set, you can handle it here (e.g., display an error or redirect)
    header("Location: administracija.php");
}
?>