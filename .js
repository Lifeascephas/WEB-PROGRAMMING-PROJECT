// Client-side validation for registration form
document.getElementById('registration-form').addEventListener('submit', function(e) {
    const username = document.getElementById('username').value;
    const password = document.getElementById('password').value;
    
    // Example simple validation
    if (username.length < 3 || password.length < 6) {
      alert('Username must be at least 3 characters and password at least 6 characters.');
      e.preventDefault(); // Prevent form submission
    }
  });
  
  // Similar validation can be added for login and data submission forms
  