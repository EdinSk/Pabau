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
            header("Location: ../views/vote.php");
            exit;
        } else {
            echo "Email not found! Please contact the administrator.";
        }
    } catch (PDOException $e) {
        echo "Error: " . $e->getMessage();
    }
}
?>
