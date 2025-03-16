<?php
        include 'config.php';
        $deptId = 11;
        $sql = "SELECT * FROM department WHERE id = $deptId";
        $result = $conn->query($sql);
        if ($result->num_rows > 0) {
            $row = $result->fetch_assoc();
        }
        $conn->close();
        ?>
        <!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title><?php echo htmlspecialchars($row['deptName']); ?> - Department</title>
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
                <img src="image1.jpg" alt="EMPLOYEE PIC">
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
    </main>

    <footer class="footer" id="footer">
        <div class="footer-container">
            <div class="footer-about">
                <h2>About Employee</h2>
                <p>Unlocking Farming Potential. Our courses teach farmers to cultivate new crops, boosting yields and income. Join our community and grow a better future!</p>
            </div>
        </div>
        <div class="footer-bottom">
            <p>&copy; 2024 Employee. All rights reserved.</p>
        </div>
    </footer>
</body>
</html>