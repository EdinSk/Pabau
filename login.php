<?php
require_once "../../htdocs/Pabau/Components/nav-bar.php";
?>

<div class="login-container">
    <h1>Employee Login</h1>
    <form method="POST" action="../Pabau/Controller/login.php">
        <label for="email">Email:</label>
        <input type="email" name="email" id="email" required>
        <button type="submit">Login</button>
    </form>
</div>