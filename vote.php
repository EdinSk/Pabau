<?php
require_once "../../htdocs/Pabau/Components/nav-bar.php";
if (!isset($_SESSION['employee_id'])) {
    header("Location: login_view.php");
    exit;
}

$voter_name = $_SESSION['employee_name'];
?>

    <h1>Hello, <?php echo htmlspecialchars($voter_name); ?>!</h1>
    <p>Welcome to the voting page.</p>
    <form method="POST" action="../logic/vote_logic.php">
        <label>Nominee:</label>
        <select name="nominee" required>
            <option value="">Select an employee</option>
            <?php include '../logic/get_employees.php'; ?>
        </select>
        <br>
        <label>Category:</label>
        <select name="category" required>
            <option value="Makes Work Fun">Makes Work Fun</option>
            <option value="Team Player">Team Player</option>
            <option value="Culture Champion">Culture Champion</option>
            <option value="Difference Maker">Difference Maker</option>
        </select>
        <br>
        <label>Comment:</label>
        <textarea name="comment" required></textarea>
        <br>
        <button type="submit">Submit Vote</button>
    </form>
