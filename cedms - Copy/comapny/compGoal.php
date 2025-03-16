<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Department Form</title>
    <link rel="stylesheet" href="../Department/Department.css">
</head>
<body>
     <form method="POST" action="dbCompGoals.php" enctype="multipart/form-data">
            <div class="form-container" style="width: 800px; max-width:800px; margin: auto;margin-top: 120px;">
                <h2 style="text-align:center">Goals of Company</h2>
            <div class="form-group">
                    <label><h2>Weekly Goal:</h2></label>
                    <textarea id="weekGoal" name="weekGoal" required></textarea>
                </div>
                <div class="form-group">
                    <label><h2>Monthly Goal:</h2></label>
                    <textarea id="monthlyGoal" name="monthlyGoal" required></textarea>
                </div>
                </div>
            <button class="deptBtn" style="width: 800px; margin: auto; margin-left: 370px;" type="submit">Next Step</button>
        </form>
        </body>
</html>
