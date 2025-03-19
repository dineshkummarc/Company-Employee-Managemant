<?php
include '../Department/config.php'; // Include database connection

// SQL Query to fetch department and financial details
$sql = "SELECT 
            d.id AS department_id,
            d.deptName,
            d.aboutDept,
            d.deptHead,
            d.aboutHEAD,
            d.company_id,
            d.weekGoal,
            d.monthlyGoal,
            d.deptImage,
            d.created_at AS dept_created_at,
            f.id AS financial_id,
            COALESCE(f.revenue, 0) AS revenue,
            COALESCE(f.investment, 0) AS investment,
            COALESCE(f.loss, 0) AS loss,
            f.period,
            f.created_at AS financial_created_at
        FROM department d
        LEFT JOIN financial_summary f 
            ON d.company_id = f.company_id";

$result = $conn->query($sql);
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Department & Financial Summary</title>
    <style>
        body {
            font-family: Arial, sans-serif;
            margin: 20px;
        }
        table {
            width: 100%;
            border-collapse: collapse;
            margin-top: 20px;
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
        .update{
            padding: 8px 12px;
            border: none;
            color: white;
            border-radius: 4px;
            cursor: pointer;
            text-decoration: none;
    background-color: #8000ff;
    width: 70px;
    margin-bottom: 10px;
}
.delete{
    
            padding: 8px 12px;
            border: none;
            color: white;
            border-radius: 4px;
            cursor: pointer;
            text-decoration: none;
    background-color: #8000ff;
    margin-top: 10px;

}
    </style>
</head>
<body>

    <h2 style="text-align: center;">Department & Financial Summary</h2>

    <table>
        <thead>
            <tr>
                <th>Department ID</th>
                <th>Department Name</th>
                <th>About Department</th>
                <th>Department Head</th>
                <th>About Head</th>
                <th>Company ID</th>
                
                <th>Weekly Goal</th>
                <th>Mothly Goal</th>
                <th>Image</th>
                <th>Revenue (Rs.)</th>
                <th>Investment (Rs.)</th>
                <th>Loss (Rs.)</th>
                <th>Period</th>
                <th>operations</th>
            </tr>
        </thead>
        <tbody>
            <?php
            if ($result->num_rows > 0) {
                while ($row = $result->fetch_assoc()) {
                    echo "<tr>";
                    echo "<td>" . $row["department_id"] . "</td>";
                    echo "<td>" . $row["deptName"] . "</td>";
                    echo "<td>" . $row["aboutDept"] . "</td>";
                    echo "<td>" . $row["deptHead"] . "</td>";
                    echo "<td>" . $row["aboutHEAD"] . "</td>";
                    echo "<td>" . $row["company_id"] . "</td>";
                    echo "<td>" . $row["weekGoal"] . "</td>";
                    echo "<td>" . $row["monthlyGoal"] . "</td>";
                    echo "<td>" . $row["deptImage"] . "</td>";
                    echo "<td>" . $row["revenue"] . "</td>";
                    echo "<td>" . $row["investment"] . "</td>";
                    echo "<td>" . $row["loss"] . "</td>";
                    echo "<td>" . $row["period"] . "</td>";
                    echo "<td>
        <a href='update.php?id=" . $row["department_id"] . "'><button class='update'>Edit</button></a>
        <a href='delete.php?delete_id=" . $row["department_id"] . "' class='delete' onclick='return confirm(\"Are you sure you want to delete this record?\");'>Delete</a>
      </td>";

                    echo "</tr>";
                    
                }
                
            } else {
                echo "<tr><td colspan='12'>No records found</td></tr>";
            }
            ?>
        </tbody>
    </table>

</body>
</html>

<?php
$conn->close(); // Close the database connection
?>
