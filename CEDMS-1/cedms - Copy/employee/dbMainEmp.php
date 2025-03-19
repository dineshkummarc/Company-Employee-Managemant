<<<<<<< HEAD:cedms - Copy/employee/dbMainEmp.php


<?php
include '../Department/config.php'; // Include database connection

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $username = $_POST['username'];
    $company = $_POST['company'];
    $deptName = $_POST['deptName'];

    // Prepare SQL query to insert data
    $sql = "INSERT INTO employee_main (username, company, deptName) VALUES (?, ?, ?)";
    
    $stmt = $conn->prepare($sql);
    $stmt->bind_param("sss", $username, $company, $deptName);

    if ($stmt->execute()) {
        echo "<script>alert('Employee added successfully!'); window.location.href = '../Employeemain/Employee.php';</script>";
    } else {
        echo "Error: " . $stmt->error;
    }

    $stmt->close();
    $conn->close();
}
?>
=======


<?php
include '../Department/config.php'; // Include database connection

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $username = $_POST['username'];
    $company = $_POST['company'];
    $deptName = $_POST['deptName'];

    // Prepare SQL query to insert data
    $sql = "INSERT INTO employee_main (username, company, deptName) VALUES (?, ?, ?)";
    
    $stmt = $conn->prepare($sql);
    $stmt->bind_param("sss", $username, $company, $deptName);

    if ($stmt->execute()) {
        echo "<script>alert('Employee added successfully!'); window.location.href = '../Employeemain/Employee.php';</script>";
    } else {
        echo "Error: " . $stmt->error;
    }

    $stmt->close();
    $conn->close();
}
?>
>>>>>>> 2e9cd047aeb1a2a31763537a43596ff16b88149f:CEDMS-1/cedms - Copy/employee/dbMainEmp.php
