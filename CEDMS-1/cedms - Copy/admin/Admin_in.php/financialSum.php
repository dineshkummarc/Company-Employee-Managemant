<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Financial Summary Form</title>
    <link rel="stylesheet" href="Department.css"> <!-- Your CSS file -->
</head>
<body>

<div class="container">
    <div class="header">
        <h2>Financial Summary</h2>
    </div>

    <div class="form-container">
        <form action="finSumConn.php" method="POST">  
            <div class="form-group">
                <label for="company_id">Company ID:</label>
                <input type="number" id="company_id" name="company_id" required>
            </div>
 
            <div class="form-group">
                <label for="revenue">Revenue (Rs.):</label>
                <input type="number" id="revenue" name="revenue" required>
            </div>

            <div class="form-group">
                <label for="investment">Investment (Rs.):</label>
                <input type="number" id="investment" name="investment" required>
            </div>

            <div class="form-group">
                <label for="loss">Loss (Rs.):</label>
                <input type="number" id="loss" name="loss" required>
            </div>

            <div class="form-group">
                <label for="period">Period:</label>
                <input type="text" id="period" name="period" placeholder="e.g., March 2025" required>
            </div>

            <button type="submit">Submit</button>
        </form>
    </div>
</div>

</body>
</html>
