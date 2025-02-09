<?php
include 'db_config.php';

// Debug mode
error_reporting(E_ALL);
ini_set('display_errors', 1);

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    echo "Form submitted\n";
    
    // Debug form data
    echo "POST data:\n";
    print_r($_POST);
    
    echo "\nFILES data:\n";
    print_r($_FILES);
    
    // Check upload directory
    $target_dir = "uploads/";
    if (!is_dir($target_dir)) {
        if (!mkdir($target_dir, 0777, true)) {
            die("Failed to create upload directory");
        }
    }
    
    // Validate file uploads
    if (!isset($_FILES['ceo-image']) || $_FILES['ceo-image']['error'] !== UPLOAD_ERR_OK) {
        die("CEO image upload failed: " . $_FILES['ceo-image']['error']);
    }
    
    if (!isset($_FILES['logo-upload']) || $_FILES['logo-upload']['error'] !== UPLOAD_ERR_OK) {
        die("Logo upload failed: " . $_FILES['logo-upload']['error']);
    }
    
    // Handle file uploads
    $ceo_image_path = $target_dir . basename($_FILES['ceo-image']['name']);
    $logo_path = $target_dir . basename($_FILES['logo-upload']['name']);
    
    if (!move_uploaded_file($_FILES['ceo-image']['tmp_name'], $ceo_image_path)) {
        die("Failed to move CEO image");
    }
    
    if (!move_uploaded_file($_FILES['logo-upload']['tmp_name'], $logo_path)) {
        die("Failed to move logo");
    }
    
    // Get form data with validation
    $admin_first_name = $_POST['first-name'] ?? '';
    $admin_last_name = $_POST['last-name'] ?? '';
    $ceo_name = $_POST['ceo-name'] ?? '';
    $company_name = $_POST['company-name'] ?? '';
    $about_company = $_POST['about-company'] ?? '';
    $ownership_type = $_POST['ownership'] ?? '';
    $password = isset($_POST['password']) ? password_hash($_POST['password'], PASSWORD_BCRYPT) : '';
    $employees = isset($_POST['employees']) ? intval($_POST['employees']) : 0;
    $departments = isset($_POST['departments']) ? intval($_POST['departments']) : 0;
    $department_names = isset($_POST['department-names']) ? implode(", ", $_POST['department-names']) : '';
    
    // Use prepared statement
    $stmt = $conn->prepare("INSERT INTO companies (
        admin_first_name, admin_last_name, ceo_name, ceo_image, 
        company_name, about_company, ownership_type, password, 
        logo, employees, departments, department_names
    ) VALUES (?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?)");
    
    if (!$stmt) {
        die("Prepare failed: " . $conn->error);
    }
    
    $stmt->bind_param("sssssssssiis", 
        $admin_first_name, $admin_last_name, $ceo_name, $ceo_image_path,
        $company_name, $about_company, $ownership_type, $password,
        $logo_path, $employees, $departments, $department_names
    );
    
    if (!$stmt->execute()) {
        die("Execute failed: " . $stmt->error);
    }
    
    echo "Registration successful!";
    
    $stmt->close();
    $conn->close();
} else {
    echo "No POST data received";
}
?>