<?php
include 'db_config.php';

$sql = "SELECT * FROM companies";
$result = $conn->query($sql);

echo "<h2>Registered Companies</h2>";
if ($result->num_rows > 0) {
    echo "<table border='1'><tr><th>ID</th><th>Company Name</th><th>CEO Name</th><th>Employees</th></tr>";
    while ($row = $result->fetch_assoc()) {
        echo "<tr><td>{$row['id']}</td><td>{$row['company_name']}</td><td>{$row['ceo_name']}</td><td>{$row['employees']}</td></tr>";
    }
    echo "</table>";
} else {
    echo "No companies found.";
}
$conn->close();
?>
