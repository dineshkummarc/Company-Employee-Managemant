<?php
include '../Department/config.php'; // Include database connection

if (isset($_GET['id'])) {
    $id = $_GET['id'];

    // Delete query
    $deleteQuery = "DELETE FROM employees WHERE id = $id";

    if ($conn->query($deleteQuery) === TRUE) {
        echo "<script>alert('Employee deleted successfully!'); window.location.href='viewEmp.php';</script>";
    } else {
        echo "Error deleting record: " . $conn->error;
    }
} else {
    echo "<script>alert('Invalid request!'); window.location.href='view_employees.php';</script>";
}

$conn->close();
?>
