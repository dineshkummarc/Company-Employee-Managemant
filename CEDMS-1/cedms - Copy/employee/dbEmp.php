<?php
include '../Department/config.php'; // Include the database connection

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $empName = mysqli_real_escape_string($conn, $_POST['empName']);
    $email = mysqli_real_escape_string($conn, $_POST['email']);
    $aboutEmployee = mysqli_real_escape_string($conn, $_POST['aboutEmployee']);
    $attendance_percentage = floatval($_POST['attendance_percentage']);
    $dailyGoals = mysqli_real_escape_string($conn, $_POST['dailyGoals']);
    $weeklyGoals = mysqli_real_escape_string($conn, $_POST['weeklyGoals']);
    $joining_date = $_POST['joining_date'];
    $deptName = mysqli_real_escape_string($conn, $_POST['deptName']);
    $headName = mysqli_real_escape_string($conn, $_POST['headName']);

    // Insert query
    $sql = "INSERT INTO employees (empName, email, aboutEmployee, attendance_percentage, dailyGoals, weeklyGoals, joining_date, deptName, headName) 
            VALUES ('$empName', '$email', '$aboutEmployee', $attendance_percentage, '$dailyGoals', '$weeklyGoals', '$joining_date', '$deptName', '$headName')";

    if ($conn->query($sql) === TRUE) {
        echo "<script>alert('Employee added successfully!'); window.location.href = '../Employee/Employee.php';</script>";
    } else {
        echo "Error: " . $sql . "<br>" . $conn->error;
    }

    $conn->close();
}
?>
