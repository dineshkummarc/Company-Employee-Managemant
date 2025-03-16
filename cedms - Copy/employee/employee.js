// Add form submission logic
document.getElementById('login-form').addEventListener('submit', function (e) {
    e.preventDefault(); // Prevent the default form submission
    const username = document.getElementById('username').value;
    const company = document.getElementById('company').value;
    const password = document.getElementById('password').value;
  
    if (username && company && password) {
      alert(`Welcome, ${username} from ${company}!`);
    } else {
      alert('Please fill in all fields.');
    }
  });
  