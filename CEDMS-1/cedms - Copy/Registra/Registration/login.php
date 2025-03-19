<?php
// Start session
session_start();


$servername = "localhost";
$username = "root";
$password = ""; 
$dbname = "company_db";


if ($_SERVER["REQUEST_METHOD"] == "POST") {
   
    $company_name = $_POST['company_name'];
    $user_password = $_POST['password']; // Renamed to avoid confusion
    
   
    $conn = new mysqli($servername, $username, $password, $dbname);
    
   
    if ($conn->connect_error) {
        die("Connection failed: " . $conn->connect_error);
    }
    
   
    $stmt = $conn->prepare("SELECT id, password FROM companies WHERE company_name = ?");
    $stmt->bind_param("s", $company_name);
    $stmt->execute();
    $result = $stmt->get_result();
    
    if ($result->num_rows > 0) {
        $row = $result->fetch_assoc();
        
        // Verify password
        if (password_verify($user_password, $row['password'])) {
            // Set session variables
            $_SESSION['company_id'] = $row['id'];
            
            // Redirect to company page
            header("Location: ../../comapny/company.php");
            exit();
        } else {
            $error_message = "Invalid password";
        }
    } else {
        $error_message = "Company not found";
    }
    
    $conn->close();
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Login</title>
    <link rel="stylesheet" href="Registration.css">
    <style>
        .error-message {
            color: red;
            margin-bottom: 10px;
        }
    </style>
</head>
<body>
    <div class="container">
        <header>
            <div class="logo">Logo</div>
            <div class="tabs">
                <a href="Registration.php">
                    <button class="tab">New Joinee</button>
                </a>
                <button class="tab active">Already a User??</button>
            </div>
        </header>
        <form id="login-form" action="login.php" method="POST">
            <?php if (isset($error_message)): ?>
                <div class="error-message"><?php echo $error_message; ?></div>
            <?php endif; ?>
            
            <div class="form-group">
                <label for="company-name">Company Name</label>
                <input type="text" id="company-name" name="company_name" placeholder="Company Name" required>
            </div>
            <br>
            <div class="form-group">
                <label for="password">Password</label>
                <input type="password" id="password" name="password" placeholder="Password" required>
            </div>
            <br>
            <div class="form-group">
                <button type="submit" id="submit-button">Login</button>
            </div>
        </form>
    </div>
</body>
</html>