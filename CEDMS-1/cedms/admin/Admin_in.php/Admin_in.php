<?php
// database_connection.php
$servername = "localhost";
$username = "root";
$password = "";
$dbname = "company_db";

// Create connection
$conn = new mysqli($servername, $username, $password, $dbname);

// Check connection
if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}
?>

<?php
// admin_in.php
session_start();
require_once 'db.php';

// Handle Sign In
if ($_SERVER["REQUEST_METHOD"] == "POST" && isset($_POST['signin'])) {
    $username = $conn->real_escape_string($_POST['username']);
    $password = $_POST['password'];

    $sql = "SELECT id, username, password FROM admins WHERE username = ?";
    $stmt = $conn->prepare($sql);
    $stmt->bind_param("s", $username);
    $stmt->execute();
    $result = $stmt->get_result();

    if ($result->num_rows === 1) {
        $admin = $result->fetch_assoc();
        
        // Verify password (using password_verify for secure hashing)
        if (password_verify($password, $admin['password'])) {
            $_SESSION['admin_id'] = $admin['id'];
            $_SESSION['username'] = $admin['username'];
            header("Location: admin.php");
            exit();
        } else {
            $error = "Invalid username or password";
        }
    } else {
        $error = "Invalid username or password";
    }
    $stmt->close();
}

// Handle Sign Up
if ($_SERVER["REQUEST_METHOD"] == "POST" && isset($_POST['signup'])) {
    $username = $conn->real_escape_string($_POST['username']);
    $email = $conn->real_escape_string($_POST['email']);
    $password = password_hash($_POST['password'], PASSWORD_DEFAULT);

    // Check if username or email already exists
    $check_sql = "SELECT * FROM admins WHERE username = ? OR email = ?";
    $check_stmt = $conn->prepare($check_sql);
    $check_stmt->bind_param("ss", $username, $email);
    $check_stmt->execute();
    $check_result = $check_stmt->get_result();

    if ($check_result->num_rows > 0) {
        $signup_error = "Username or email already exists";
    } else {
        // Insert new admin
        $insert_sql = "INSERT INTO admins (username, email, password) VALUES (?, ?, ?)";
        $insert_stmt = $conn->prepare($insert_sql);
        $insert_stmt->bind_param("sss", $username, $email, $password);
        
        if ($insert_stmt->execute()) {
            $signup_success = "Account created successfully. Please sign in.";
        } else {
            $signup_error = "Error creating account: " . $conn->error;
        }
        $insert_stmt->close();
    }
    $check_stmt->close();
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Admin Login</title>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.6.0/css/all.min.css" />
    <link rel="stylesheet" href="Admin_in.css">
</head>
<body>
    <div class="container">
       <div class="Sign-in-Sign-up">
        <form action="" method="POST" class="sign-in-form">
            <h2 class="title">Sign In</h2>
            <?php 
            if (isset($error)) {
                echo "<p style='color:red;'>$error</p>";
            }
            ?>
            <div class="input-field">
                <i class="fas fa-user"></i>
                <input type="text" name="username" placeholder="Username" required>
            </div>
            <div class="input-field">
                <i class="fas fa-lock"></i>
                <input type="password" name="password" placeholder="Password" required>
            </div>
            <input type="submit" name="signin" value="Sign in" class="btn"> 
          
            <p class="account-text">Don't have an account? <a href="#" id="sign-up-btn2">Sign Up</a></p>
        </form>

        <form action="" method="POST" class="sign-up-form">
            <h2 class="title">Sign Up</h2>
            <?php 
            if (isset($signup_error)) {
                echo "<p style='color:red;'>$signup_error</p>";
            }
            if (isset($signup_success)) {
                echo "<p style='color:green;'>$signup_success</p>";
            }
            ?>
            <div class="input-field">
                <i class="fas fa-user"></i>
                <input type="text" name="username" placeholder="Username" required>
            </div>
            <div class="input-field">
                <i class="fas fa-envelope"></i>
                <input type="email" name="email" placeholder="Email" required>
            </div>
            <div class="input-field">
                <i class="fas fa-lock"></i>
                <input type="password" name="password" placeholder="Password" required>
            </div>
            <input type="submit" name="signup" value="Sign up" class="btn"> 
            
            <p class="account-text">Already have an account? <a href="#" id="sign-in-btn2">Sign In</a></p>
        </form>
     </div>   

    <div class="panels-container">
        <div class="panel left-panel">
            <div class="content">
                <h3>Already Admin?</h3>
                <p>Sign in to access your admin dashboard and manage your system.</p>
                <button class="btn" id="sign-in-btn">Sign in</button>
            </div>
        </div>

        <div class="panel right-panel">
            <div class="content">
                <h3>New Admin?</h3>
                <p>Create an account to get started with your admin management portal.</p>
                <button class="btn" id="sign-up-btn">Sign up</button>
            </div>
        </div>
    </div>

    <script src="Admin_in.js"></script>
</body>
</html>