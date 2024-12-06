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

<div id="responseMessage" style="margin-top: 20px; font-size: 1em; color: green; text-align: center;"></div>


<form id="voteForm" method="POST" action="/Pabau/Controller/vote.php" novalidate>
    <label>Nominee:</label>
    <select name="nominee" id="nominee">
        <option value="">Select an employee</option>
        <?php
        foreach ($employees as $employee) {
            echo '<option value="' . $employee['id'] . '">' . htmlspecialchars($employee['name']) . '</option>';
        }
        ?>
    </select>
    <div id="nomineeError" class="error-message" style="color: red; font-size: 0.9em;"></div>
    <br>

    <label>Category:</label>
    <select name="category" id="category">
        <option value="">Select a category</option>
        <?php
        foreach ($categories as $category) {
            echo '<option value="' . $category['id'] . '">' . htmlspecialchars($category['name']) . '</option>';
        }
        ?>
    </select>
    <div id="categoryError" class="error-message" style="color: red; font-size: 0.9em;"></div>
    <br>

    <label>Comment:</label>
    <textarea name="comment" id="comment"></textarea>
    <div id="commentError" class="error-message" style="color: red; font-size: 0.9em;"></div>
    <br>

    <button type="submit">Submit Vote</button>
</form>


<script>
    document.addEventListener('DOMContentLoaded', function() {
        const form = document.getElementById('voteForm');
        const responseMessage = document.getElementById('responseMessage');

        form.addEventListener('submit', function(event) {
            event.preventDefault(); // Prevent default form submission
            responseMessage.textContent = ''; // Clear previous messages

            const formData = new FormData(form);

            fetch('/Pabau/Controller/vote.php', {
                    method: 'POST',
                    body: formData,
                })
                .then(response => response.json())
                .then(data => {
                    if (data.success) {
                        // Show success message
                        responseMessage.textContent = data.message;
                        responseMessage.style.color = 'green';

                        // Optionally reset the form fields
                        form.reset();

                        // Optionally hide the form or update UI dynamically
                        setTimeout(() => {
                            responseMessage.textContent = ''; // Clear message after a delay
                        }, 5000); // 5 seconds delay
                    } else {
                        // Show error message
                        responseMessage.textContent = data.error;
                        responseMessage.style.color = 'red';
                    }
                })
                .catch(error => {
                    responseMessage.textContent = 'An error occurred while submitting the vote.';
                    responseMessage.style.color = 'red';
                    console.error('Error:', error);
                });
        });
    });
</script>


<?php require_once "../../htdocs/Pabau/Components/footer.php"; ?>