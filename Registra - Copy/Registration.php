<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Registration Form</title>
    <link rel="stylesheet" href="Registration.css">
    <style>
        #password, #employees, #departments, #department-names {
            padding: 0.5rem;
            border: 1px solid #ccc;
            border-radius: 4px;
            font-size: 1rem;
        }
    </style>
</head>
<body>
    <div class="container">
        <header>
            <div class="logo">Logo</div>
            <div class="tabs">
                <button class="tab">New Joinee</button>
                <button class="tab">
                    <a href="Already.html" style="text-decoration: none; color: inherit;">Already a User??</a>
                </button>
            </div>
        </header>

        <form id="registration-form" action="register.php" method="POST" enctype="multipart/form-data">
    <!-- Add this hidden field for PHP to recognize POST data -->
    <input type="hidden" name="form_submitted" value="1">
    
  
            <div class="form-row">
                <div class="form-group">
                    <label for="first-name">Admin First Name</label>
                    <input type="text" id="first-name" name="first-name" placeholder="First Name" required>
                </div>
                <div class="form-group">
                    <label for="last-name">Admin Last Name</label>
                    <input type="text" id="last-name" name="last-name" placeholder="Last Name" required>
                </div>
            </div>
            
            <div class="form-group">
                <label for="ceo-name">CEO Name</label>
                <input type="text" id="ceo-name" name="ceo-name" placeholder="CEO Name" required>
            </div>
            <br>

            <div class="form-group">
                <label for="ceo-image">Upload CEO Image</label>
                <input type="file" id="ceo-image" name="ceo-image" accept="image/jpeg, image/png" required>
            </div>
            <br>

            <div class="form-group">
                <label for="company-name">Company Name</label>
                <input type="text" id="company-name" name="company-name" placeholder="Company Name" required>
            </div>
            <br>

            <div class="form-group">
                <label for="about-company">About the Company</label>
                <textarea id="about-company" name="about-company" placeholder="Write about the company" rows="4"></textarea>
            </div>

            <div class="form-group">
                <input type="radio" name="ownership" id="sole-proprietorship" value="Sole Proprietorship" required>
                <label for="sole-proprietorship">Sole Proprietorship</label>

                <input type="radio" name="ownership" id="partnership" value="Partnership">
                <label for="partnership">Partnership</label>
            </div>

            <div class="partner-section" id="partner-section"></div>

            <div class="form-group">
                <label for="password">Password</label>
                <input type="password" id="password" name="password" placeholder="Password" required>
            </div>
            <br>

            <div class="form-group">
                <label for="logo-upload">Upload Company Logo</label>
                <input type="file" id="logo-upload" name="logo-upload" accept="image/jpeg, image/png" required>
            </div>
            <br>

            <div class="form-group">
                <label for="employees">Number of Employees</label>
                <input type="number" id="employees" name="employees" placeholder="Enter number of employees" required>
            </div>
            <br>

            <div class="form-group">
                <label for="departments">Number of Departments</label>
                <input type="number" id="departments" name="departments" placeholder="Enter number of departments" required>
            </div>
            <br>

            <div class="form-group">
                <label for="department-names">Names of Departments</label>
                <div id="department-list">
                    <div class="department-item">
                        <input type="text" name="department-names[]" placeholder="Department Name" required>
                        <button type="button" onclick="addDepartment()">+</button>
                    </div>
                </div>
            </div>
            <br>

            <div class="form-group">
                <button type="submit" id="submit-button">Submit</button>
            </div>
        </form>
    </div>

    <script>
        function addDepartment() {
            const departmentList = document.getElementById('department-list');
            const newDepartment = document.createElement('div');
            newDepartment.className = 'department-item';
            newDepartment.innerHTML = `
                <input type="text" name="department-names[]" placeholder="Department Name" required>
                <button type="button" onclick="removeDepartment(this)">-</button>
            `;
            departmentList.appendChild(newDepartment);
        }

        function removeDepartment(button) {
            button.parentElement.remove();
        }
    </script>

</body>
</html>
