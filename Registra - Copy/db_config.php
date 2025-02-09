<?php
$servername = "localhost";
$username = "root";  // Change if needed
$password = "";      // Change if needed
$dbname = "company_registration";

// Create connection
$conn = new mysqli($servername, $username, $password);

// Check connection
if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}

// Create database if not exists
$sql = "CREATE DATABASE IF NOT EXISTS $dbname";
if ($conn->query($sql) === TRUE) {
    echo "Database created successfully<br>";
} else {
    echo "Error creating database: " . $conn->error;
}

// Select database
$conn->select_db($dbname);

// Create table if not exists
$table = "CREATE TABLE IF NOT EXISTS companies (
    id INT AUTO_INCREMENT PRIMARY KEY,
    admin_first_name VARCHAR(50),
    admin_last_name VARCHAR(50),
    ceo_name VARCHAR(100),
    ceo_image VARCHAR(255),
    company_name VARCHAR(100),
    about_company TEXT,
    ownership_type ENUM('Sole Proprietorship', 'Partnership'),
    password VARCHAR(255),
    logo VARCHAR(255),
    employees INT,
    departments INT,
    department_names TEXT,
    partner_names TEXT
)";

if ($conn->query($table) === TRUE) {
    echo "Table created successfully<br>";
} else {
    echo "Error creating table: " . $conn->error;
}

?>
