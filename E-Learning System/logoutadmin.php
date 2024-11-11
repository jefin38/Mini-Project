<?php
session_start();

// Clear the specific session variable 'umail'
$_SESSION["umail"] = "";

// Optionally, you could unset the session variable entirely like this:
unset($_SESSION["umail"]);

// Redirect to the index page
header('Location: index.php');
exit();
?>
