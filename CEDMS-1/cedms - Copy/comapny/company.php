<<<<<<< HEAD:cedms - Copy/comapny/company.php
<?php
// Start session to access stored company_id
session_start();

// Check if company_id is set in session
if (!isset($_SESSION['company_id'])) {
    // If not logged in or registered, redirect to registration page
    header("Location: ../Registra/Registration/Registration.php");
    exit();
}

// Database connection settings
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

$company_id = $_SESSION['company_id'];

// Get company information
$sql = "SELECT * FROM companies WHERE id = ?";
$stmt = $conn->prepare($sql);
$stmt->bind_param("i", $company_id);
$stmt->execute();
$result = $stmt->get_result();

if ($result->num_rows > 0) {
    $company = $result->fetch_assoc();
} else {
    die("Company not found");
}

$sql = "SELECT * FROM company_goals WHERE id = ? ORDER BY id DESC LIMIT 1";
$stmt = $conn->prepare($sql);
$stmt->bind_param("i", $company_id);
$stmt->execute();
$goals_result = $stmt->get_result();
$goals = $goals_result->fetch_assoc();



// Get partners if it's a partnership company
$partners = [];
if ($company['ownership_type'] == 'Partnership') {
    $sql = "SELECT * FROM partners WHERE company_id = ?";
    $stmt = $conn->prepare($sql);
    $stmt->bind_param("i", $company_id);
    $stmt->execute();
    $partners_result = $stmt->get_result();
    
    while ($row = $partners_result->fetch_assoc()) {
        $partners[] = $row;
    }
}

$conn->close();
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title><?php echo htmlspecialchars($company['company_name']); ?></title>
    <link rel="stylesheet" href="company.css">
</head>
<body>
    <header>
        <div class="logo">
            <?php if (!empty($company['company_logo'])): ?>
                <img src="<?php echo htmlspecialchars($company['company_logo']); ?>" alt="Company Logo" style="max-height: 50px;">
            <?php else: ?>
                Logo
            <?php endif; ?>
        </div>
        <nav>
            <ul>
                <li><a href="#home">Home</a></li>

                <li><a href="../CURD/editDetails.php">All Departments</a></li>
                <li><a href="../Department/Department.php">Create department</a></li>
            </ul>
        </nav>
    </header>

    <section>
        <div class="home" id="home">
            <div class="homeText">
                <h1 style="font-size: 42px;"><?php echo htmlspecialchars($company['company_name']); ?></h1>
                <h1 style="font-size: 46px;"><?php echo htmlspecialchars($company['ownership_type']); ?> Company</h1>
                <h1 style="font-size: 42px;">CEO: <?php echo htmlspecialchars($company['ceo_name']); ?></h1>
                <h3>Our Partners:</h3>
                        <h2>
                            <?php foreach ($partners as $partner): ?>
                                <?php echo htmlspecialchars($partner['first_name'] . ' ' . $partner['last_name']); ?>
                            <?php endforeach; ?>
                            </h2>
            </div>
            <div class="homeImg">
                <?php if (!empty($company['ceo_image'])): ?>
                    <img src="<?php echo htmlspecialchars($company['ceo_image']); ?>" alt="CEO Image">
                <?php else: ?>
                    <img src="gr.png" alt="Default Image">
                <?php endif; ?>
            </div>
        </div>

        <div class="aboutInfo" id="about">
            <h1>About the Company</h1>
            <div class="about">
                <div class="aboutText">
                    <p><?php echo nl2br(htmlspecialchars($company['about_company'])); ?></p>
                    
                    
                    
                    <?php if (!empty($departments)): ?>
                        <h3>Our Departments:</h3>
                        <ul>
                            <?php foreach ($departments as $department): ?>
                                <li><?php echo htmlspecialchars($department['name']); ?></li>
                            <?php endforeach; ?>
                        </ul>
                    <?php endif; ?>
                </div>
                <div class="aboutImg">
                    <?php if (!empty($company['company_logo'])): ?>
                        <img src="<?php echo htmlspecialchars($company['company_logo']); ?>" alt="Company Logo">
                    <?php else: ?>
                        <img src="Google_Chrome_icon_(February_2022).svg.png" alt="Default Image">
                    <?php endif; ?>
                </div>
            </div>
        </div>

        <div class="goal-container" id="goal">
    <h1>Goals</h1>
    <div class="goal-section">
        <div class="goal-box">
            <h2>Daily</h2>
            <div class="content-box">
                <p><?php echo !empty($goals['daily_goal']) ? htmlspecialchars($goals['daily_goal']) : "No goal set"; ?></p>
            </div>
        </div>
        <div class="goal-box">
            <h2>Weekly</h2>
            <div class="content-box">
                <p><?php echo !empty($weekGoal) ? htmlspecialchars($goals['week_goal']) : "No goal set"; ?></p>
            </div>
        </div>
        <div class="goal-box">
            <h2>Monthly</h2>
            <div class="content-box">
                <p><?php echo !empty($monthlyGoal) ? htmlspecialchars($goals['monthly_goal']) : "No goal set"; ?></p>
            </div>
        </div>
        <div class="goal-box">
            <h2>Yearly</h2>
            <div class="content-box">
                <p><?php echo !empty($goals['yearly_goal']) ? htmlspecialchars($goals['yearly_goal']) : "No goal set"; ?></p>
            </div>
        </div>
    </div>
</div>


        <!-- summary -->
        <div class="summary-container" id="summary">
            <div class="summary-box">
                <div class="card">
                    <h1>Revenue Generated</h1>
                    <div class="card-info">
                        <h1>6580</h1>
                    </div>
                </div>
                <div class="card">
                    <h1>Amount Invested</h1>
                    <div class="card-info">
                        <h1>6580</h1>
                    </div>
                </div>
                <div class="card">
                    <h1>Loss Occurred</h1>
                    <div class="card-info">
                        <h1>6580</h1>
                    </div>
                </div>
            </div>
        </div>
    </section>

    <!-- footer -->
    <footer class="footer" id="footer">
        <link rel="stylesheet" href="footer.css">
        <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.6.0/css/all.min.css" integrity="sha512-Kc323vGBEqzTmouAECnVceyQqyqdsSiqLQISBL29aUW4U/M7pSPA/gEUZQqv1cwx4OnYxTxve5UMg5GT6L4JJg==" crossorigin="anonymous" referrerpolicy="no-referrer" />
        <div class="footer-container">
            <div class="footer-about">
                <h2>About <?php echo htmlspecialchars($company['company_name']); ?></h2>
                <p><?php echo htmlspecialchars(substr($company['about_company'], 0, 200)) . '...'; ?></p>
            </div>
            <div class="footer-links">
                <h2>Quick Links</h2>
                <ul>
                    <li><a href="#home">Home</a></li>
                    <li><a href="#about">About</a></li>
                    <li><a href="#footer">Contact Us</a></li>
                </ul>
            </div>
            <div class="footer-contact">
                <h2>Contact Us</h2>
                <ul>
                    <li>Email: support@<?php echo strtolower(str_replace(' ', '', $company['company_name'])); ?>.com</li>
                    <li>Phone: 91+ 7310638297</li>
                    <li>Address: Janakpuri, Delhi - 201301</li>
                </ul>
            </div>
            <div class="footer-social">
                <h2>Follow Us</h2>
                <ul>
                    <li>
                        <a href="#" target="_blank">
                            <i class="fab fa-facebook-f"></i>
                        </a>
                    </li>
                    <li>
                        <a href="#" target="_blank">
                            <i class="fab fa-twitter"></i>
                        </a>
                    </li>
                    <li>
                        <a href="#" target="_blank">
                            <i class="fa-brands fa-instagram"></i>
                        </a>
                    </li>
                    <li>
                        <a href="#" target="_blank">
                            <i class="fa-brands fa-linkedin-in"></i>
                        </a>
                    </li>
                </ul>
            </div>
        </div>
        <div class="footer-bottom">
            <p>&copy; 2024 <?php echo htmlspecialchars($company['company_name']); ?>. All rights reserved.</p>
        </div>
    </footer>
</body>