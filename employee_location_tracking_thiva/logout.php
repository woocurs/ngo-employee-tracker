<?php
session_start(); // Start the session

// Destroy all session data
session_unset(); // Unset all of the session variables
session_destroy(); // Destroy the session itself

// Redirect to the index page
header("Location: index.php");
exit();
?>
