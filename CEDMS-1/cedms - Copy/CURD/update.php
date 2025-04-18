<?php
include '../Department/config.php'; // Database connection

// Get department ID from URL
if (isset($_GET['id'])) {
    $id = intval($_GET['id']);

    // Fetch department details
    $sql = "SELECT d.*, f.revenue, f.investment, f.loss, f.period, f.id AS financial_id
            FROM department d
            LEFT JOIN financial_summary f ON d.company_id = f.company_id
            WHERE d.id = $id";
    
    $result = $conn->query($sql);
    if ($result->num_rows > 0) {
        $row = $result->fetch_assoc();
    } else {
        echo "Department not found.";
        exit;
    }
} else {
    echo "Invalid request.";
    exit;
}

// Handle the form submission
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $deptName = $conn->real_escape_string($_POST['deptName']);
    $aboutDept = $conn->real_escape_string($_POST['aboutDept']);
    $deptHead = $conn->real_escape_string($_POST['deptHead']);
    $aboutHead = $conn->real_escape_string($_POST['aboutHead']);
    $weekGoal = $conn->real_escape_string($_POST['weekGoal']);
    $monthlyGoal = $conn->real_escape_string($_POST['monthlyGoal']);
    $deptImage = $conn->real_escape_string($_POST['deptImage']);

    $revenue = floatval($_POST['revenue']);
    $investment = floatval($_POST['investment']);
    $loss = floatval($_POST['loss']);
    $period = $conn->real_escape_string($_POST['period']);
    
    // Update department table
    $updateDeptSQL = "UPDATE department SET 
                        deptName='$deptName', 
                        aboutDept='$aboutDept', 
                        deptHead='$deptHead', 
                        aboutHEAD='$aboutHead', 
                        weekGoal='$weekGoal', 
                        monthlyGoal='$monthlyGoal', 
                        deptImage='$deptImage'
                      WHERE id=$id";

    // Update financial_summary table
    $updateFinanceSQL = "UPDATE financial_summary SET 
                            revenue=$revenue, 
                            investment=$investment, 
                            loss=$loss, 
                            period='$period'
                         WHERE company_id=(SELECT company_id FROM department WHERE id=$id)";

    if ($conn->query($updateDeptSQL) === TRUE && $conn->query($updateFinanceSQL) === TRUE) {
        echo "<script>alert('Department and Financial Summary updated successfully!'); window.location.href='editDetails.php';</script>";
    } else {
        echo "Error updating records: " . $conn->error;
    }
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Update Department & Financial Summary</title>
    <style>
        body {
            font-family: Arial, sans-serif;
            margin: 50px;
            background-color: #f4f4f4;
        }

        .container {
            max-width: 600px;
            background: white;
            padding: 20px;
            border-radius: 8px;
            box-shadow: 0 0 10px rgba(0, 0, 0, 0.1);
        }

        h2 {
            text-align: center;
            color: #4A47A3;
        }

        label {
            font-weight: bold;
            display: block;
            margin-top: 10px;
        }

        input[type="text"], input[type="number"] {
            width: 100%;
            padding: 8px;
            margin-top: 5px;
            border: 1px solid #ddd;
            border-radius: 4px;
        }

        button {
            width: 100%;
            background: #4A47A3;
            color: white;
            padding: 10px;
            margin-top: 20px;
            border: none;
            border-radius: 4px;
            font-size: 16px;
            cursor: pointer;
        }

        button:hover {
            background: #333190;
        }

        
    </style>
</head>
<body>

    <h2>Update Department & Financial Summary</h2>

    <form method="POST">
        <label>Department Name:</label>
        <input type="text" name="deptName" value="<?= $row['deptName'] ?>" required><br>

        <label>About Department:</label>
        <input type="text" name="aboutDept" value="<?= $row['aboutDept'] ?>" required><br>

        <label>Department Head:</label>
        <input type="text" name="deptHead" value="<?= $row['deptHead'] ?>" required><br>

        <label>About Head:</label>
        <input type="text" name="aboutHead" value="<?= $row['aboutHEAD'] ?>" required><br>

        <label>Weekly Goal:</label>
        <input type="text" name="weekGoal" value="<?= $row['weekGoal'] ?>" required><br>

        <label>Monthly Goal:</label>
        <input type="text" name="monthlyGoal" value="<?= $row['monthlyGoal'] ?>" required><br>

        <!-- <label>Department Image URL:</label>
        <input type="text" name="deptImage" value="<?= $row['deptImage'] ?>"><br> -->

        <h3>Financial Summary</h3>

        <label>Revenue (Rs.):</label>
        <input type="number" name="revenue" value="<?= $row['revenue'] ?>" required><br>

        <label>Investment (Rs.):</label>
        <input type="number" name="investment" value="<?= $row['investment'] ?>" required><br>

        <label>Loss (Rs.):</label>
        <input type="number" name="loss" value="<?= $row['loss'] ?>" required><br>

        <label>Period:</label>
        <input type="text" name="period" value="<?= $row['period'] ?>" required><br>

        <button type="submit">Update</button>
    </form>

</body>
</html>

<?php
$conn->close();
?>
