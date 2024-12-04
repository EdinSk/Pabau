<?php
require_once "../../htdocs/Pabau/Components/nav-bar.php";
?>

<h1>Employee Login</h1>
<form method="POST" action="../logic/login_logic.php">
    <label>Email:</label>
    <input type="email" name="email" required>
    <br>
    <button type="submit">Login</button>
</form>