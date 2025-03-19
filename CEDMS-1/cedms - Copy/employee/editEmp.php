<?php
include '../Department/config.php'; // Include database connection

// Check if ID is provided in the URL
if (isset($_GET['id'])) {
    $id = $_GET['id'];

    // Fetch employee data based on ID
    $sql = "SELECT * FROM employees WHERE id = $id";
    $result = $conn->query($sql);

    // Check if data exists
    if ($result->num_rows == 1) {
        $row = $result->fetch_assoc();
    } else {
        echo "Employee not found!";
        exit();
    }
}

// Update employee details on form submission
if (isset($_POST['update'])) {
    $empName = $_POST['empName'];
    $email = $_POST['email'];
    $aboutEmployee = $_POST['aboutEmployee'];
    $attendance_percentage = $_POST['attendance_percentage'];
    $dailyGoals = $_POST['dailyGoals'];
    $weeklyGoals = $_POST['weeklyGoals'];
    $joining_date = $_POST['joining_date'];
    $deptName = $_POST['deptName'];
    $headName = $_POST['headName'];

    // Update query
    $updateQuery = "UPDATE employees SET 
        empName='$empName', 
        email='$email', 
        aboutEmployee='$aboutEmployee', 
        attendance_percentage='$attendance_percentage', 
        dailyGoals='$dailyGoals', 
        weeklyGoals='$weeklyGoals', 
        joining_date='$joining_date', 
        deptName='$deptName', 
        headName='$headName' 
        WHERE id=$id";

    if ($conn->query($updateQuery) === TRUE) {
        echo "<script>alert('Employee updated successfully!'); window.location.href='viewEmp.php';</script>";
    } else {
        echo "Error updating record: " . $conn->error;
    }
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Edit Employee</title>
    <style>
        body {
            font-family: Arial, sans-serif;
            margin: 20px;
            background-color: #f5f5f5;
        }
        .container {
            width: 50%;
            margin: auto;
            background: white;
            padding: 20px;
            box-shadow: 0px 0px 10px rgba(0, 0, 0, 0.1);
            border-radius: 5px;
        }
        h2 {
            text-align: center;
            color: #333;
        }
        label {
            font-weight: bold;
            display: block;
            margin-top: 10px;
        }
        input, textarea {
            width: 100%;
            padding: 10px;
            margin-top: 5px;
            border: 1px solid #ddd;
            border-radius: 5px;
        }
        button {
            width: 100%;
            padding: 10px;
            background-color: #8000ff;
            color: white;
            border: none;
            border-radius: 5px;
            margin-top: 15px;
            cursor: pointer;
        }
        button:hover {
            background-color: #8000ff;
        }
    </style>
</head>
<body>

    <div class="container">
        <h2>Edit Employee</h2>
        <form action="" method="POST">
            <label for="empName">Employee Name:</label>
            <input type="text" name="empName" value="<?php echo $row['empName']; ?>" required>

            <label for="email">Email:</label>
            <input type="email" name="email" value="<?php echo $row['email']; ?>" required>

            <label for="aboutEmployee">About Employee:</label>
            <textarea name="aboutEmployee"><?php echo $row['aboutEmployee']; ?></textarea>

            <label for="attendance_percentage">Attendance %:</label>
            <input type="number" name="attendance_percentage" value="<?php echo $row['attendance_percentage']; ?>" min="0" max="100" required>

            <label for="dailyGoals">Daily Goals:</label>
            <textarea name="dailyGoals"><?php echo $row['dailyGoals']; ?></textarea>

            <label for="weeklyGoals">Weekly Goals:</label>
            <textarea name="weeklyGoals"><?php echo $row['weeklyGoals']; ?></textarea>

            <label for="joining_date">Joining Date:</label>
            <input type="date" name="joining_date" value="<?php echo $row['joining_date']; ?>" required>

            <label for="deptName">Department Name:</label>
            <input type="text" name="deptName" value="<?php echo $row['deptName']; ?>" required>

            <label for="headName">Head Name:</label>
            <input type="text" name="headName" value="<?php echo $row['headName']; ?>" required>

            <button type="submit" name="update">Update Employee</button>
        </form>
    </div>

</body>
</html>

<?php $conn->close(); ?>
