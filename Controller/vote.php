<?php 
if (session_status() == PHP_SESSION_NONE) {
    session_start();
}

require_once __DIR__ . "/../DB/DB.php";

if (!isset($_SESSION['employee_id'])) {
    header("Location: /Pabau/vote.php");
    exit;
}

$voter_id = $_SESSION['employee_id'];

if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    $nominee_id = filter_input(INPUT_POST, 'nominee', FILTER_SANITIZE_NUMBER_INT);
    $category_id = filter_input(INPUT_POST, 'category', FILTER_SANITIZE_NUMBER_INT);
    $comment = filter_input(INPUT_POST, 'comment', FILTER_SANITIZE_STRING);

    try {
        // Validate the form data
        if (empty($nominee_id) || empty($category_id) || empty($comment)) {
            throw new Exception('All fields are required!');
        }

        if ($nominee_id == $voter_id) {
            throw new Exception('You cannot vote for yourself!');
        }

        // Check for duplicate votes
        $stmt_check = $conn->prepare("
            SELECT COUNT(*) FROM votes 
            WHERE voter_id = :voter_id 
            AND nominee_id = :nominee_id 
            AND category_id = :category_id
        ");
        $stmt_check->bindParam(':voter_id', $voter_id);
        $stmt_check->bindParam(':nominee_id', $nominee_id);
        $stmt_check->bindParam(':category_id', $category_id);
        $stmt_check->execute();

        if ($stmt_check->fetchColumn() > 0) {
            throw new Exception('You have already voted for this nominee in this category!');
        }

        // Insert the vote
        $stmt = $conn->prepare("
            INSERT INTO votes (voter_id, nominee_id, category_id, comment) 
            VALUES (:voter_id, :nominee_id, :category_id, :comment)
        ");
        $stmt->bindParam(':voter_id', $voter_id);
        $stmt->bindParam(':nominee_id', $nominee_id);
        $stmt->bindParam(':category_id', $category_id);
        $stmt->bindParam(':comment', $comment);
        $stmt->execute();

        // Redirect with success message
        header("Location: /Pabau/vote.php?success=1");
        exit;

    } catch (PDOException $e) {
        die("Database Error: " . $e->getMessage());
    } catch (Exception $e) {
        die("Error: " . $e->getMessage());
    }
}

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
?>
