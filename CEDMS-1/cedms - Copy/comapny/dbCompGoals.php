<?php
// Include the database connection
include '../Department/config.php';

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    // Retrieve form data
    $weekGoal = $_POST['weekGoal'];
    $monthlyGoal = $_POST['monthlyGoal'];

    // Prevent SQL injection
    $weekGoal = $conn->real_escape_string($weekGoal);
    $monthlyGoal = $conn->real_escape_string($monthlyGoal);

    // SQL query to insert data into the table
    $sql = "INSERT INTO company_goals (week_goal, monthly_goal) VALUES ('$weekGoal', '$monthlyGoal')";

    if ($conn->query($sql) === TRUE) {
        echo "<script>alert('Goals submitted successfully!'); window.location.href='company.php';</script>";
    } else {
        echo "Error: " . $sql . "<br>" . $conn->error;
    }

    // Close the connection
    $conn->close();
}
?>
