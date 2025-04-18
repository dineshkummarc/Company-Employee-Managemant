<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>Responsive Form</title>
  <link rel="stylesheet" href="employee.css">
</head>
<body>
  <div class="container">
    <form id="login-form" action="dbMainEmp.php" method="POST">
      <label for="username">UserName</label>
      <input type="text" id="username" name="username" placeholder="Enter your username" required>

      <label for="company">Company Name</label>
      <input type="text" id="company" name="company" placeholder="Enter your company name" required>

      <!-- <label for="password">Password</label>
      <input type="password" id="password" name="password" placeholder="Enter your password" required> -->

      <label for="deptName">Department Name</label>
      <input type="text" id="deptName" name="deptName" placeholder="Enter your deptName" required>

      <button type="submit">Submit</button>
    </form>
  </div>
  <script src="Already.js"></script>
</body>
</html>
