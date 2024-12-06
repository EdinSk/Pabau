<?php
include '../../Pabau/DB/DB.php';
session_start();

if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    $email = $_POST['email'];

    try {
        $stmt = $conn->prepare("SELECT id, name FROM employees WHERE email = :email");
        $stmt->bindParam(':email', $email);
        $stmt->execute();

        $employee = $stmt->fetch(PDO::FETCH_ASSOC);

        if ($employee) {
            $_SESSION['employee_id'] = $employee['id'];
            $_SESSION['employee_name'] = $employee['name'];
            $_SESSION['loggedIn'] = true;
            header("Location: ../vote.php");
            exit;
        } else {
            // Store error message in session and redirect to login page
            $_SESSION['error'] = "Email not found! Please input valid email.";
            header("Location: /Pabau/login.php");
            exit;
        }
    } catch (PDOException $e) {
        $_SESSION['error'] = "Error: " . $e->getMessage();
        header("Location: /Pabau/login.php");
        exit;
    }
}
