<?php
include 'DB.php';

try {
    // Create database if it doesn't exist
    $conn->exec("CREATE DATABASE IF NOT EXISTS voting_system");
    echo "Database created successfully!<br>";

    // Switch to the new database
    $conn->exec("USE voting_system");

    // Create tables
    $sql = "
    CREATE TABLE IF NOT EXISTS employees (
        id INT AUTO_INCREMENT PRIMARY KEY,
        name VARCHAR(100) NOT NULL,
        email VARCHAR(100) UNIQUE NOT NULL
    );

    CREATE TABLE IF NOT EXISTS votes (
        id INT AUTO_INCREMENT PRIMARY KEY,
        voter_id INT NOT NULL,
        nominee_id INT NOT NULL,
        category ENUM('Makes Work Fun', 'Team Player', 'Culture Champion', 'Difference Maker') NOT NULL,
        comment TEXT NOT NULL,
        timestamp DATETIME DEFAULT CURRENT_TIMESTAMP,
        FOREIGN KEY (voter_id) REFERENCES employees(id),
        FOREIGN KEY (nominee_id) REFERENCES employees(id),
        CHECK (voter_id <> nominee_id)
    );
    ";

    $conn->exec($sql);
    echo "Tables created successfully!";
} catch (PDOException $e) {
    echo "Error: " . $e->getMessage();
}
?>
