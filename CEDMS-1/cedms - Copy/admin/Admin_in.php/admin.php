<?php
// admin.php
session_start();

// Check if admin is logged in
if (!isset($_SESSION['admin_id'])) {
    header("Location: admin_in.php");
    exit();
}

// Database connection
require_once 'db.php';

// Fetch admin details
$admin_id = $_SESSION['admin_id'];
$sql = "SELECT username FROM admins WHERE id = ?";
$stmt = $conn->prepare($sql);
$stmt->bind_param("i", $admin_id);
$stmt->execute();
$result = $stmt->get_result();
$admin = $result->fetch_assoc();
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Admin Dashboard</title>
    <link rel="stylesheet" href="admin.css">
</head>
<body>
    <div class="sidebar">
        <div class="admin-id">
            <img src="image1.jpg" alt="Admin">
            <span><?php echo htmlspecialchars($admin['username']); ?></span>
        </div>
        <div class="sidebar-item" data-page="employee">Employee</div>
        <div class="sidebar-item" data-page="departments">Departments</div>
        <div class="sidebar-item" data-page="subscription">Subscription</div>
        <div class="sidebar-item" data-page="goals">Goals</div>
        <div class="sidebar-item" data-page="revenue">Revenue</div>
        <div class="sidebar-item" data-page="logout">
            <a href="logout.php">Logout</a>
        </div>
    </div>
    <div class="content-area" id="contentArea">
        <!-- Dynamic content will be loaded here -->
        <h1>Welcome, <?php echo htmlspecialchars($admin['username']); ?></h1>
    </div>
    <script src="admin.js"></script>
</body>
</html>