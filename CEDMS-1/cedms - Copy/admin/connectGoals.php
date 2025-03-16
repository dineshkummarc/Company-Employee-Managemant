<?php
// Database connection
$servername = "localhost";  // Change if necessary
$username = "root";         // Your database username
$password = "";             // Your database password
$database = "company_db";   // Your actual database name

$conn = new mysqli($servername, $username, $password, $database);

// Check connection
if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}

// Check if form is submitted
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $company_id = intval($_POST['company-id']);
    $goal_type = $_POST['goal-type'];
    $goal_description = $_POST['goal-description'];
    $goal_status = $_POST['goal-status'];

    // Validate input
    if (!empty($company_id) && !empty($goal_type) && !empty($goal_description) && !empty($goal_status)) {
        // Insert data into the database
        $stmt = $conn->prepare("INSERT INTO goals (company_id, type, description, status) VALUES (?, ?, ?, ?)");
        $stmt->bind_param("isss", $company_id, $goal_type, $goal_description, $goal_status);

        if ($stmt->execute()) {
            echo  header("Location: ../Head/Head.php");
        } else {
            echo "Error: " . $stmt->error;
        }

        $stmt->close();
    } else {
        echo "All fields are required!";
    }
}

$conn->close();
?>
