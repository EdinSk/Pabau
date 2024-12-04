<?php
$host = "localhost";
$db_name = "voting_system";
$username = "root";
$password = "";

try {
    // Step 1: Connect to MySQL without specifying a database
    $conn = new PDO("mysql:host=$host;charset=utf8", $username, $password);
    $conn->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);

    // Step 2: Check if the database exists, and create it if necessary
    $db_exists = $conn->query("SHOW DATABASES LIKE '$db_name'")->rowCount();

    if (!$db_exists) {
        // Create the database if it doesn't exist
        $conn->exec("CREATE DATABASE IF NOT EXISTS $db_name");
        echo "Database '$db_name' created successfully!<br>";
    } else {
        echo "Database '$db_name' already exists.<br>";
    }

    // Step 3: Connect to the specific database
    $conn->exec("USE $db_name");

    // Step 4: Create tables if they don't exist
    $tables_sql = "
    CREATE TABLE IF NOT EXISTS categories (
        id INT AUTO_INCREMENT PRIMARY KEY,
        name VARCHAR(255) NOT NULL UNIQUE
    );

    CREATE TABLE IF NOT EXISTS employees (
        id INT AUTO_INCREMENT PRIMARY KEY,
        name VARCHAR(100) NOT NULL,
        email VARCHAR(100) UNIQUE NOT NULL
    );

    CREATE TABLE IF NOT EXISTS votes (
        id INT AUTO_INCREMENT PRIMARY KEY,
        voter_id INT NOT NULL,
        nominee_id INT NOT NULL,
        category_id INT NOT NULL,
        comment TEXT NOT NULL,
        timestamp DATETIME DEFAULT CURRENT_TIMESTAMP,
        FOREIGN KEY (voter_id) REFERENCES employees(id),
        FOREIGN KEY (nominee_id) REFERENCES employees(id),
        FOREIGN KEY (category_id) REFERENCES categories(id),
        CHECK (voter_id <> nominee_id)
    );
    ";

    // Execute the SQL to create tables
    $conn->exec($tables_sql);
    echo "All necessary tables are ready!<br>";


} catch (PDOException $e) {
    die("Connection failed: " . $e->getMessage());
}
?>
