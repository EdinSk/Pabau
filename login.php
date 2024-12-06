<?php
require_once "../../htdocs/Pabau/Components/nav-bar.php";
?>

<div class="login-container">
    <h1>Employee Login</h1>
    <?php if (isset($_SESSION['error'])): ?>
        <p class="alert alert-danger text-center">
            <?php echo htmlspecialchars($_SESSION['error']); ?>
        </p>
        <?php unset($_SESSION['error']); ?>
    <?php endif; ?>
    <form method="POST" action="../Pabau/Controller/login.php">
        <label for="email">Email:</label>
        <input type="email" name="email" id="email" required>
        <button type="submit">Login</button>
    </form>
</div>

<?php require_once "../../htdocs/Pabau/Components/footer.php"; ?>