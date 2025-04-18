

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
