<?php
// Database credentials
$host = "localhost";
$db_name = "voting_system";
$username = "root";
$password = "";

try {
    // Step 1: Connect to MySQL without specifying a database
    $conn = new PDO("mysql:host=$host;charset=utf8", $username, $password);
    $conn->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);

    // Step 2: Check if the database exists
    $db_exists = $conn->query("SHOW DATABASES LIKE '$db_name'")->rowCount();

    // Step 3: Create the database if it doesn't exist
    if (!$db_exists) {
        $conn->exec("CREATE DATABASE IF NOT EXISTS $db_name");
        echo "Database '$db_name' created successfully!<br>";
    }

    // Step 4: Connect to the specific database
    $conn->exec("USE $db_name");

    // Optional: Create tables if they don't exist (ensures idempotence)
    $tables_sql = "
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
    $conn->exec($tables_sql);

    echo "Connection successful, and all tables are ready!";
} catch (PDOException $e) {
    die("Connection failed: " . $e->getMessage());
}
?>
