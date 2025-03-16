<?php
include '../Department/config.php'; // Include database connection

// Fetch the latest department details
$sql = "SELECT * FROM department ORDER BY id DESC LIMIT 1"; // Modify table name if needed
$result = $conn->query($sql);

if ($result->num_rows > 0) {
    $row = $result->fetch_assoc();

    // Fetch details from the database
    $deptName = htmlspecialchars($row['deptName']);
    $aboutDept = htmlspecialchars($row['aboutDept']);
    $deptHead = htmlspecialchars($row['deptHead']);
    $aboutHEAD = htmlspecialchars($row['aboutHEAD']);
    $weekGoal = htmlspecialchars($row['weekGoal']);
    $monthlyGoal = htmlspecialchars($row['monthlyGoal']);

    // $revenueGenerated = number_format($row['revenueGenerated']); // Format number
    // $lossOccurred = number_format($row['lossOccurred']); // Format number
    // $members = htmlspecialchars($row['members']);
} else {
    // Default values if no data is found
    $deptHead = "Not Available";
    $deptName = "Not Available";
    $aboutDept = "Not Available";
    $aboutHead = "Not Available";
    // $weeklyGoal = "No Goal Set";
    // $monthlyGoal = "No Goal Set";
    // $revenueGenerated = "0";
    // $lossOccurred = "0";
    // $members = "0";
}

// Fetch the latest financial summary
$sql_financial = "SELECT * FROM financial_summary ORDER BY id DESC LIMIT 1";
$result_financial = $conn->query($sql_financial);

if ($result_financial->num_rows > 0) {
    $row_financial = $result_financial->fetch_assoc();

    // Fetch details from the database
    $revenueGenerated = number_format($row_financial['revenue']);
    $investmentMade = number_format($row_financial['investment']);
    $lossOccurred = number_format($row_financial['loss']);
} else {
    // Default values if no data is found
    $revenueGenerated = "0";
    $investmentMade = "0";
    $lossOccurred = "0";
}


$conn->close();
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Employee Page</title>
    <link rel="stylesheet" href="Head.css">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.6.0/css/all.min.css" integrity="sha512-Kc323vGBEqzTmouAECnVceyQqyqdsSiqLQISBL29aUW4U/M7pSPA/gEUZQqv1cwx4OnYxTxve5UMg5GT6L4JJg==" crossorigin="anonymous" referrerpolicy="no-referrer" />
</head>
<body>
    
    <header>
        <div class="logo">Logo</div>
        <nav>
            <ul>
                <li><a href="#home">Edit Details</a></li>
                
               
            </ul>
        </nav>
    </header>

    <main>



<!-- about employee -->

        <section class="container" id="home">
            <div class="content">
                <h1><?php echo $deptHead; ?></h1>
                <div class="highlight-container">
                    <span class="highlight">from</span>
                    <span class="highlight2"><?php echo $deptName; ?></span>
                </div>
                <p class="description"><?php echo $aboutHEAD; ?></p>
                <button class="cta-button"><?php echo $deptName; ?> →</button>
            </div>
            <div class="image-container">
                <img src="image1.jpg" alt="EMPLOYEE PIC">
            </div>
        </section>
       
       <!-- about department -->

        <section class="about-section" id="about">
            <h1>About the department</h1>
            <hr>
            <p>
            <?php echo $aboutDept; ?>
            </p>
        </section>
        
        

<section class="goal-container" id="goal">
    <h1>Goals</h1>
    <div class="goal-section">
        <div class="goal-box">
            <h2>Weekly</h2>
            <div class="content-box">
            <?php echo $weekGoal; ?>
            </div>
        </div>
        <div class="goal-box">
            <h2>Monthly</h2>
            <div class="content-box">
            <?php echo $monthlyGoal; ?>
            </div>
        </div>
    </div>
</section>




<!-- summary -->
<!-- summary -->
<div class="summary-container" id="summary">
    <div class="summary-box">
        <div class="card">
            <h1>Revenue Generated</h1>
            <div class="card-info">
                <h1><?php echo $revenueGenerated; ?> Rs.</h1>
            </div>
        </div>
        <div class="card">
            <h1>Amount Invested</h1>
            <div class="card-info">
                <h1><?php echo $investmentMade; ?> Rs.</h1>
            </div>
        </div>
        <div class="card">
            <h1>Loss Occurred</h1>
            <div class="card-info">
                <h1><?php echo $lossOccurred; ?> Rs.</h1>
            </div>
        </div>
    </div>
</div>



<!-- members -->
<section id="members" class="member-container">
    <h1>Members</h1>
    <div class="members-grid">
        <div class="member-box">
            <p>vanshika</p>
        </div>
        <div class="member-box"></div>
        <div class="member-box"></div>
        <div class="member-box"></div>
        <div class="member-box"></div>
        <div class="member-box"></div>
        <div class="member-box"></div>
        <div class="member-box"></div>
    </div>
</section>


    </main>

    <footer class="footer" id="footer">
        <div class="footer-container">
            <div class="footer-about">
                <h2>About Employee</h2>
                <p>Unlocking Farming Potential. Our courses teach farmers to cultivate new crops, boosting yields and income. Join our community and grow a better future!</p>
            </div>
            <div class="footer-links">
                <h2>Quick Links</h2>
                <ul>
                    <li><a href="#home">Home</a></li>
                    <li><a href="#about">About</a></li>
                    <li><a href="#goal">Goals</a></li>
                    <li><a href="#summary">Summary</a></li>
                    <li><a href="#members">Members</a></li>
                </ul>
            </div>
            <div class="footer-contact">
                <h2>Contact Us</h2>
                <ul>
                    <li>Email: support@employee.com</li>
                    <li>Phone: +91 7310638297</li>
                    <li>Address: Janakpuri, Delhi - 201301</li>
                </ul>
            </div>
            <div class="footer-social">
                <h2>Follow Us</h2>
                <ul>
                    <li><a href="#" target="_blank"><i class="fab fa-facebook-f"></i></a></li>
                    <li><a href="#" target="_blank"><i class="fab fa-twitter"></i></a></li>
                    <li><a href="#" target="_blank"><i class="fa-brands fa-instagram"></i></a></li>
                    <li><a href="#" target="_blank"><i class="fa-brands fa-linkedin-in"></i></a></li>
                </ul>
            </div>
        </div>
        <div class="footer-bottom">
            <p>&copy; 2024 Employee. All rights reserved.</p>
        </div>
    </footer>
    
</body>
</html>
