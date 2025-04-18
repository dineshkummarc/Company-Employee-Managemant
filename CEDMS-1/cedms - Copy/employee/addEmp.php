<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Add Employee</title>
    <style>
        body {
            font-family: Arial, sans-serif;
            background-color: #f4f4f4;
            margin: 0;
            padding: 20px;
        }
        .container {
            width: 50%;
            margin: auto;
            background: white;
            padding: 20px;
            border-radius: 8px;
            box-shadow: 0 0 10px rgba(0, 0, 0, 0.1);
        }
        h2 {
            text-align: center;
            color: #333;
        }
        label {
            font-weight: bold;
        }
        input, textarea, select {
            width: 95%;
            padding: 10px;
            margin-top: 5px;
            margin-bottom: 15px;
            border: 1px solid #ccc;
            border-radius: 5px;
            margin-right: 10px;
        }
        button {
            width: 100%;
            padding: 10px;
            background: #8000ff;
            color: white;
            border: none;
            cursor: pointer;
            border-radius: 5px;
            font-size: 16px;
        }
        button:hover {
            background: #218838;
        }
    </style>
</head>
<body>

<div class="container">
    <h2>Add Employee</h2>
    <form action="dbEmp.php" method="POST">
        <label for="empName">Employee Name:</label>
        <input type="text" id="empName" name="empName" required>

        <label for="email">Email:</label>
        <input type="email" id="email" name="email" required>

        <label for="aboutEmployee">About Employee:</label>
        <textarea id="aboutEmployee" name="aboutEmployee" rows="3"></textarea>

        <label for="attendance_percentage">Attendance Percentage:</label>
        <input type="number" id="attendance_percentage" name="attendance_percentage" step="0.01" min="0" max="100" required>

        <label for="dailyGoals">Daily Goals:</label>
        <textarea id="dailyGoals" name="dailyGoals" rows="2"></textarea>

        <label for="weeklyGoals">Weekly Goals:</label>
        <textarea id="weeklyGoals" name="weeklyGoals" rows="2"></textarea>

        <label for="joining_date">Joining Date:</label>
        <input type="date" id="joining_date" name="joining_date" required>

        <label for="deptName">Department Name:</label>
        <input type="text" id="deptName" name="deptName" required>

        <label for="headName">Head Name:</label>
        <input type="text" id="headName" name="headName" required>

        <button type="submit">Add Employee</button>
    </form>
</div>

</body>
</html>
