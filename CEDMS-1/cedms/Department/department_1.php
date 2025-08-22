<?php
    include 'config.php';
    $deptId = 1;

    // Fetch department details
    $sql = "SELECT * FROM department WHERE id = $deptId";
    $result = $conn->query($sql);
    if ($result->num_rows > 0) {
        $row = $result->fetch_assoc();
    } else {
        die('Department not found');
    }

    // Fetch financial details based on company_id
    $financial_sql = "SELECT * FROM financial_summary WHERE company_id = {$row['company_id']}";
    $financial_result = $conn->query($financial_sql);
    $financial_data = $financial_result ? $financial_result->fetch_assoc() : null;

    $conn->close();
    ?>
    <!DOCTYPE html>
    <html lang="en">
    <head>
        <meta charset="UTF-8">
        <meta name="viewport" content="width=device-width, initial-scale=1.0">
        <title><?php echo htmlspecialchars($row['deptName']); ?> - Department</title>
        <link rel="stylesheet" href="Head.css">
    </head>
    <body>
        <header>
            <div class="logo">Logo</div>
            <nav>
                <ul>
                    <li><a href="../employee/addEmp.php">Add Employee</a></li>
                    <li><a href="../employee/viewEmp.php">Know your Employees</a></li>
                    <li><a href="../CURD/editDetails.php">Edit Details</a></li>
                </ul>
            </nav>
        </header>
        <main>
            <section class="container" id="home">
                <div class="content">
                    <h1><?php echo htmlspecialchars($row['deptHead']); ?></h1>
                    <div class="highlight-container">
                        <span class="highlight">from</span>
                        <span class="highlight2"><?php echo htmlspecialchars($row['deptName']); ?></span>
                    </div>
                    <p class="description"><?php echo htmlspecialchars($row['aboutHEAD']); ?></p>
                    <button class="cta-button"><?php echo htmlspecialchars($row['deptName']); ?> →</button>
                </div>
                <div class="image-container">
                    <?php if (!empty($row['deptImage'])): ?>
                        <img src="<?php echo htmlspecialchars($row['deptImage']); ?>" alt="Department Image">
                    <?php endif; ?>
                </div>
            </section>

            <section class="about-section" id="about">
                <h1>About the department</h1>
                <hr>
                <p><?php echo htmlspecialchars($row['aboutDept']); ?></p>
            </section>

            <section class="goal-container" id="goal">
                <h1>Goals</h1>
                <div class="goal-section">
                    <div class="goal-box">
                        <h2>Weekly</h2>
                        <div class="content-box">
                        <?php echo htmlspecialchars($row['weekGoal']); ?>
                        </div>
                    </div>
                    <div class="goal-box">
                        <h2>Monthly</h2>
                        <div class="content-box">
                        <?php echo htmlspecialchars($row['monthlyGoal']); ?>
                        </div>
                    </div>
                </div>
            </section>

            <!-- Financial Summary Section -->
            <div class="summary-container" id="summary">
                <div class="summary-box">
                    <div class="card">
                        <h2>Revenue Generated</h2>
                        <div class="card-info">
                            <h1><?php echo number_format($financial_data['revenue'] ?? 0); ?> Rs.</h1>
                        </div>
                    </div>
                    <div class="card">
                        <h2>Amount Invested</h2>
                        <div class="card-info">
                            <h1><?php echo number_format($financial_data['investment'] ?? 0); ?> Rs.</h1>
                        </div>
                    </div>
                    <div class="card">
                        <h2>Loss Occurred</h2>
                        <div class="card-info">
                            <h1><?php echo number_format($financial_data['loss'] ?? 0); ?> Rs.</h1>
                        </div>
                    </div>
                    <div class="card">
                        <h2>Financial Period</h2>
                        <div class="card-info">
                            <h1><?php echo htmlspecialchars($financial_data['period'] ?? 'N/A'); ?></h1>
                        </div>
                    </div>
                </div>
            </div>
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