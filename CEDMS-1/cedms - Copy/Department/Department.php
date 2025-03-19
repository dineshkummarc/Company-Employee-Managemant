<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Department Form</title>
    <link rel="stylesheet" href="Department.css">
</head>
<body>

    <div class="container">
        <div class="header">
            <h2>DEPARTMENT</h2>
            <div class="hamburger">
                <span></span>
                <span></span>
                <span></span>
            </div>
            <div class="menu">
    <ul>
        <li><a href="department_20.php"> Marketing Departmment</li>
        <li><a href="department_20.php"> Publicity Departmment</li>
        <li><a href="department_20.php">  Departmment</li>
        <li><a href="department_20.php">AI Departmment</li>
        <!-- <?php
        include 'config.php';
        $sql = "SELECT deptName FROM department ORDER BY id DESC"; // Fetch departments
        $result = $conn->query($sql);
        
        if ($result->num_rows > 0) {
            while ($row = $result->fetch_assoc()) {
                echo "<li>" . htmlspecialchars($row['deptName']) . "</li>";
            }
        } else {
            echo "<li>No Departments Available</li>";
        }
        ?> -->
    </ul>
</div>
    </div>
<script>
    document.querySelector(".hamburger").addEventListener("click", function () {
        document.querySelector(".menu").classList.toggle("show");
    });
</script>

        
        
        <form method="POST" action="deptConn.php" enctype="multipart/form-data">
            <div class="form-container">
                <div class="form-group">
                    <label><h2>Department Name:</h2></label>
                    <input type="text" id="deptName" name="deptName" required>
                </div>
                <div class="form-group">
                    <label><h2>About Department:</h2></label>
                    <textarea id="aboutDept" name="aboutDept" required></textarea>
                </div>
                <div class="form-group">
                    <label><h2>Department Head:</h2></label>
                    <input type="text" id="deptHead" name="deptHead" required>
                </div>
                <div class="form-group">
                    <label><h2>About Department Head:</h2></label>
                    <textarea id="aboutHead" name="aboutHead" required></textarea>
                </div>
                <div class="form-group">
                    <label><h2>Company ID:</h2></label>
                    <input type="number" id="company-id" name="company_id" required>
                </div>
                <div class="form-group">
                    <label><h2>Weekly Goal:</h2></label>
                    <textarea id="weekGoal" name="weekGoal" required></textarea>
                </div>
                <div class="form-group">
                    <label><h2>Monthly Goal:</h2></label>
                    <textarea id="monthlyGoal" name="monthlyGoal" required></textarea>
                </div>
                <div class="form-group">
                    <label><h2>Department Image:</h2></label>
                    <input type="file" id="deptImage" name="deptImage" accept="image/*" >
                </div>
            </div>
            <button class="deptBtn" type="submit">Next Step</button>
        </form>
    </div>

</body>
</html>

