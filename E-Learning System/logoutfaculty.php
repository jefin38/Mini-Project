<?php
session_start();

// Option 1: Clear the specific session variable by setting it to an empty string
// $_SESSION["fidx"] = "";

// Option 2: Completely remove the session variable
unset($_SESSION["fidx"]);

// Redirect to index.php
header('Location: index.php');
exit(); // Ensure the script stops after redirect
?>
