<?php
session_start(); // Start the session to access session variables

// Check if the user is logged in
$isLoggedIn = isset($_SESSION['loggedIn']) && $_SESSION['loggedIn'] === true;
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Basic Navbar</title>
    <link rel="stylesheet" href="../../Pabau/styles.css"> <!-- Link to the external CSS -->
</head>
<body>

<!-- Navbar -->
<div class="navbar">
    <a href="../../Pabau/" class="logo">My Website</a>
    <div class="menu">
        <a href="../../Pabau/vote.php">Vote</a>
        <!-- Display Login or Logout based on the session state -->
        <?php if ($isLoggedIn): ?>
            <a href="../Pabau/Controller/logout.php" id="loginLogoutLink">Logout</a>
        <?php else: ?>
            <a href="login.php" id="loginLogoutLink">Login</a>
        <?php endif; ?>
    </div>
</div>