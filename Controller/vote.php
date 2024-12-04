<?php 
include '../db_connect.php';

if (!isset($_SESSION['employee_id'])) {
    header("Location: login_view.php");
    exit;
}

$voter_id = $_SESSION['employee_id'];

if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    // Step 1: Get the form data
    $nominee_id = $_POST['nominee'];  // Nominee selected by the voter
    $category_id = $_POST['category'];  // Category selected by the voter
    $comment = $_POST['comment'];  // Comment submitted by the voter

    try {
        // Step 2: Validate the data
        if (empty($nominee_id) || empty($category_id) || empty($comment)) {
            throw new Exception('All fields are required!');
        }

        if ($nominee_id == $voter_id) {
            throw new Exception('You cannot vote for yourself!');
        }

        // Step 3: Insert the vote into the votes table
        $stmt = $conn->prepare("INSERT INTO votes (voter_id, nominee_id, category_id, comment) VALUES (:voter_id, :nominee_id, :category_id, :comment)");
        $stmt->bindParam(':voter_id', $voter_id);
        $stmt->bindParam(':nominee_id', $nominee_id);
        $stmt->bindParam(':category_id', $category_id);
        $stmt->bindParam(':comment', $comment);
        $stmt->execute();

        // Step 4: Redirect to the same page with a success message
        header("Location: vote_view.php?success=1");
        exit;
    } catch (PDOException $e) {
        die("Error: " . $e->getMessage());
    } catch (Exception $e) {
        die("Error: " . $e->getMessage());
    }
}

// Step 5: Fetch employees and categories for the voting form
try {
    // Fetch employees excluding the current user
    $stmt_employees = $conn->prepare("SELECT id, name FROM employees WHERE id != :voter_id");
    $stmt_employees->bindParam(':voter_id', $voter_id);
    $stmt_employees->execute();
    $employees = $stmt_employees->fetchAll(PDO::FETCH_ASSOC);

    // Fetch categories
    $stmt_categories = $conn->prepare("SELECT id, name FROM categories");
    $stmt_categories->execute();
    $categories = $stmt_categories->fetchAll(PDO::FETCH_ASSOC);
} catch (PDOException $e) {
    die("Error: " . $e->getMessage());
}