<?php
require_once "../../htdocs/Pabau/Components/nav-bar.php";
include "../Pabau/Controller/vote.php";


if (!isset($_SESSION['employee_id'])) {
    header("Location: login.php");
    exit;
}


?>

<h1>Hello, <?php echo htmlspecialchars($_SESSION['employee_name']); ?>!</h1>
<p>Welcome to the voting page.</p>

<?php if (isset($_GET['success']) && $_GET['success'] == 1): ?>
    <p style="color:green;">Your vote has been submitted successfully!</p>
<?php endif; ?>

<form method="POST" action="/Pabau/Controller/vote.php">
    <label>Nominee:</label>
    <select name="nominee" required>
        <option value="">Select an employee</option>
        <?php
        foreach ($employees as $employee) {
            echo '<option value="' . $employee['id'] . '">' . htmlspecialchars($employee['name']) . '</option>';
        }
        ?>
    </select>
    <br>

    <label>Category:</label>
    <select name="category" required>
        <?php
        foreach ($categories as $category) {
            echo '<option value="' . $category['id'] . '">' . htmlspecialchars($category['name']) . '</option>';
        }
        ?>
    </select>
    <br>

    <label>Comment:</label>
    <textarea name="comment" required></textarea>
    <br>

    <button type="submit">Submit Vote</button>
</form>