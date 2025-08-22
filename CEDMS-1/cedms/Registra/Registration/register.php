<?php

$servername = "localhost";
$username = "root"; 
$password = ""; 
$dbname = "company_db";


$conn = new mysqli($servername, $username, $password);


if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}


$sql = "CREATE DATABASE IF NOT EXISTS $dbname";
if ($conn->query($sql) !== TRUE) {
    die("Error creating database: " . $conn->error);
}


$conn->select_db($dbname);


$sql = "CREATE TABLE IF NOT EXISTS companies (
    id INT(11) AUTO_INCREMENT PRIMARY KEY,
    admin_first_name VARCHAR(50) NOT NULL,
    admin_last_name VARCHAR(50) NOT NULL,
    ceo_name VARCHAR(100) NOT NULL,
    ceo_image VARCHAR(255),
    company_name VARCHAR(100) NOT NULL,
    about_company TEXT,
    ownership_type VARCHAR(50) NOT NULL,
    password VARCHAR(255) NOT NULL,
    company_logo VARCHAR(255),
    employee_count INT(11),
    department_count INT(11),
    created_at TIMESTAMP DEFAULT CURRENT_TIMESTAMP
)";

if ($conn->query($sql) !== TRUE) {
    die("Error creating table: " . $conn->error);
}

// Create partners table if not exists
$sql = "CREATE TABLE IF NOT EXISTS partners (
    id INT(11) AUTO_INCREMENT PRIMARY KEY,
    company_id INT(11),
    first_name VARCHAR(50) NOT NULL,
    last_name VARCHAR(50) NOT NULL,
    FOREIGN KEY (company_id) REFERENCES companies(id)
)";

if ($conn->query($sql) !== TRUE) {
    die("Error creating table: " . $conn->error);
}

// Create departments table if not exists
$sql = "CREATE TABLE IF NOT EXISTS departments (
    id INT(11) AUTO_INCREMENT PRIMARY KEY,
    company_id INT(11),
    name VARCHAR(100) NOT NULL,
    FOREIGN KEY (company_id) REFERENCES companies(id)
)";

if ($conn->query($sql) !== TRUE) {
    die("Error creating table: " . $conn->error);
}

// Process form submission
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    // Get form data
    $ceo_name = $_POST['ceo_name'];
    $company_name = $_POST['company_name'];
    $about_company = $_POST['about_company'];
    $ownership_type = $_POST['ownership'];
    $password = password_hash($_POST['password'], PASSWORD_DEFAULT); // Hash the password
    
    
    // Handle CEO image upload
    $ceo_image = "";
    if(isset($_FILES['ceo_image']) && $_FILES['ceo_image']['error'] == 0) {
        $target_dir = "uploads/";
        
        // Create directory if it doesn't exist
        if (!file_exists($target_dir)) {
            mkdir($target_dir, 0777, true);
        }
        
        $ceo_image = $target_dir . time() . "_" . basename($_FILES["ceo_image"]["name"]);
        move_uploaded_file($_FILES["ceo_image"]["tmp_name"], $ceo_image);
    }
    
    // Handle company logo upload
    $company_logo = "";
    if(isset($_FILES['logo_upload']) && $_FILES['logo_upload']['error'] == 0) {
        $target_dir = "uploads/";
        
        // Create directory if it doesn't exist
        if (!file_exists($target_dir)) {
            mkdir($target_dir, 0777, true);
        }
        
        $company_logo = $target_dir . time() . "_" . basename($_FILES["logo_upload"]["name"]);
        move_uploaded_file($_FILES["logo_upload"]["tmp_name"], $company_logo);
    }
    
    // Insert company data
    $stmt = $conn->prepare("INSERT INTO companies (ceo_name, ceo_image, company_name, about_company, ownership_type, password, company_logo) VALUES ( ?, ?, ?, ?, ?, ?, ?)");
    $stmt->bind_param("sssssss",  $ceo_name, $ceo_image, $company_name, $about_company, $ownership_type, $password, $company_logo);
    
    if ($stmt->execute()) {
        $company_id = $conn->insert_id;
        
        // Insert partners data
        if ($ownership_type == "Partnership" && isset($_POST['partner_first_name']) && isset($_POST['partner_last_name'])) {
            // Handle multiple partners from form
            $partner_first_names = $_POST['partner_first_name'];
            $partner_last_names = $_POST['partner_last_name'];
            
            // Check if they are arrays (multiple partners)
            if (is_array($partner_first_names) && is_array($partner_last_names)) {
                for ($i = 0; $i < count($partner_first_names); $i++) {
                    if (!empty($partner_first_names[$i]) && !empty($partner_last_names[$i])) {
                        $stmt = $conn->prepare("INSERT INTO partners (company_id, first_name, last_name) VALUES (?, ?, ?)");
                        $stmt->bind_param("iss", $company_id, $partner_first_names[$i], $partner_last_names[$i]);
                        $stmt->execute();
                    }
                }
            } else {
                // Single partner
                if (!empty($partner_first_names) && !empty($partner_last_names)) {
                    $stmt = $conn->prepare("INSERT INTO partners (company_id, first_name, last_name) VALUES (?, ?, ?)");
                    $stmt->bind_param("iss", $company_id, $partner_first_names, $partner_last_names);
                    $stmt->execute();
                }
            }
        }
        //mat daalo
        // Insert departments data
        if (isset($_POST['department_name'])) {
            $department_names = $_POST['department_name'];
            
            // Check if it's an array (multiple departments)
            if (is_array($department_names)) {
                foreach ($department_names as $dept_name) {
                    if (!empty($dept_name)) {
                        $stmt = $conn->prepare("INSERT INTO departments (company_id, name) VALUES (?, ?)");
                        $stmt->bind_param("is", $company_id, $dept_name);
                        $stmt->execute();
                    }
                }
            } else {
                //mat daalo
                // Single department
                if (!empty($department_names)) {
                    $stmt = $conn->prepare("INSERT INTO departments (company_id, name) VALUES (?, ?)");
                    $stmt->bind_param("is", $company_id, $department_names);
                    $stmt->execute();
                }
            }
        }
        
        // Start session and store company ID
        session_start();
        $_SESSION['company_id'] = $company_id;
        
        // Redirect to company page
        header("Location: ../../comapny/company.php");
        exit();
    } else {
        echo "Error: " . $stmt->error;
    }
    
    $stmt->close();
}

$conn->close();
?>