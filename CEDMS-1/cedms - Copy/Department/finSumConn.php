<?php
include 'config.php'; 

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $company_id = intval($_POST['company_id']);  
    $revenue = intval($_POST['revenue']);
    $investment = intval($_POST['investment']);
    $loss = intval($_POST['loss']);
    $period = mysqli_real_escape_string($conn, $_POST['period']); 

    // Insert financial data
    $sql = "INSERT INTO financial_summary (company_id, revenue, investment, loss, period) 
            VALUES ('$company_id', '$revenue', '$investment', '$loss', '$period')";

    if ($conn->query($sql) === TRUE) {
        // Get last inserted department ID
        $dept_sql = "SELECT id FROM department WHERE company_id = $company_id ORDER BY id DESC LIMIT 1";
        $dept_result = $conn->query($dept_sql);
        if ($dept_result->num_rows > 0) {
            $dept_row = $dept_result->fetch_assoc();
            $deptId = $dept_row['id'];

            // Redirect to the department page
            echo "<script>alert('Financial Summary Added Successfully!'); window.location.href='department_$deptId.php';</script>";
        } else {
            echo "<script>alert('Financial Summary Added but department not found!'); window.location.href='../Head/Head.php';</script>";
        }
    } else {
        echo "Error: " . $sql . "<br>" . $conn->error;
    }
}

// Close the connection
$conn->close();
?>
