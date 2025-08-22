<?php
include '../../Department/config.php'; // Include database connection

// Fetch employee data
$sql = "SELECT * FROM employees";
$result = $conn->query($sql);
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Employee List</title>
    <style>
        body {
            font-family: Arial, sans-serif;
            margin: 20px;
            background-color: #f5f5f5;
        }
        h2 {
            text-align: center;
            color: #333;
        }
        table {
            width: 100%;
            border-collapse: collapse;
            margin-top: 20px;
            background: white;
            box-shadow: 0px 0px 10px rgba(0, 0, 0, 0.1);
        }
        th, td {
            border: 1px solid #ddd;
            padding: 10px;
            text-align: left;
        }
        th {
            background-color: #8000ff;
            color: white;
        }
        tr:nth-child(even) {
            background-color: #f2f2f2;
        }
        .actions {
            display: flex;
            gap: 10px;
        }
        .btn {
            padding: 5px 10px;
            text-decoration: none;
            color: white;
            border-radius: 5px;
            font-size: 14px;
            cursor: pointer;
            border: none;
        }
        .btn-edit {
            background-color: #28a745;
        }
        .btn-delete {
            background-color: #dc3545;
        }
    </style>
</head>
<body>

    <h2>Employee List</h2>

    <table>
        <thead>
            <tr>
                <th>ID</th>
                <th>Employee Name</th>
                <th>Email</th>
                <th>About</th>
                <th>Attendance %</th>
                <th>Daily Goals</th>
                <th>Weekly Goals</th>
                <th>Joining Date</th>
                <th>Department</th>
                <th>Head Name</th>
                <th>Actions</th>
            </tr>
        </thead>
        <tbody>
            <?php
            if ($result->num_rows > 0) {
                while ($row = $result->fetch_assoc()) {
                    echo "<tr>";
                    echo "<td>" . $row["id"] . "</td>";
                    echo "<td>" . $row["empName"] . "</td>";
                    echo "<td>" . $row["email"] . "</td>";
                    echo "<td>" . $row["aboutEmployee"] . "</td>";
                    echo "<td>" . $row["attendance_percentage"] . "%</td>";
                    echo "<td>" . $row["dailyGoals"] . "</td>";
                    echo "<td>" . $row["weeklyGoals"] . "</td>";
                    echo "<td>" . $row["joining_date"] . "</td>";
                    echo "<td>" . $row["deptName"] . "</td>";
                    echo "<td>" . $row["headName"] . "</td>";
                    echo "<td class='actions'>
                            <a href='editEmp.php?id=" . $row["id"] . "' class='btn btn-edit'>Edit</a>
                            <a href='deleteEmp.php?id=" . $row["id"] . "' class='btn btn-delete' onclick='return confirm(\"Are you sure?\")'>Delete</a>
                          </td>";
                    echo "</tr>";
                }
            } else {
                echo "<tr><td colspan='11'>No employees found</td></tr>";
            }
            ?>
        </tbody>
    </table>

</body>
</html>

<?php
$conn->close(); // Close the database connection
?>
