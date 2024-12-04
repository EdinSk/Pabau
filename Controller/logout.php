<?php
// Start the session
session_start();

// Destroy all session variables
session_unset();

// Destroy the session
session_destroy();

// Redirect the user to the login page or home page
header("Location: ../../Pabau"); // Change 'login.php' to your desired redirect page
exit();
?>