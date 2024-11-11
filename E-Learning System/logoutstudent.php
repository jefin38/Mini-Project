<?php
session_start();

// Clear the specific session variable 'sidx'
unset($_SESSION["sidx"]);

// Redirect to the 'index.php' page
header('Location: index.php');
exit(); // Ensure the script stops after redirect
?>
