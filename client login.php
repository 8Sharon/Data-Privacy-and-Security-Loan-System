
<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>Login - TRUST LOAN</title>
  <link rel="stylesheet" href="client login.css">
</head>
<body>
  
<div class="navbar">
  <div class="logo">
    <img src="Trust loan.jpg" alt="TRUST LOAN Logo"> 
  </div>
  <p class="slogan">Quality is Our Assurance</p>
</div>
<div class="login-container" id="logincontainer">
  <h1>Sign in to your Account</h1>
  
  <form action="register.php" method="POST">
  <input type="hidden" name="logincontainer" value="1">
    
    <label for="email">Your Email Address <span class="required">*</span></label>
    <input type="email" id="email" name="email" placeholder="Enter your email" required>
    
    <label for="password">Enter Password <span class="required">*</span> </label>
    <input type="password" id="password" name="password" placeholder="Enter your password" 
           pattern="^(?=.*[a-z])(?=.*[A-Z])(?=.*[@#&*]).{6,}$" 
           title="Password must be at least 6 characters long, contain an uppercase letter, a lowercase letter, and a special character (@, #, &, *)." required>
    
    <div class="remember-forgot-container">
      <div class="remember-me">
        <input type="checkbox" id="remember" name="remember">
        <label for="remember">Remember Me</label>
      </div>  
      <div class="forgot-password">
        <a href="#" id="forgotPasswordLink">Forgot Password?</a>
      </div>
    </div>
    
    <input class="btn" type="submit" name="signin" value="SignIn">
    
    <p>Don't have an account? <a href="#" id="registerLink">Register</a></p>
    
  </form>
</div>


<div class="register-container" id="registercontainer" style="display: none;">
  <h1>Register</h1>
  
  <form action="register.php" method="POST">
  <input type="hidden" name="registercontainer" value="1">
    <label for="newEmail">Your Email Address <span class="required">*</span></label>
    <input type="email" id="newEmail" name="email" placeholder="Enter your email" required>
    
    <label for="newPassword">Set Password <span class="required">*</span></label>
    <input type="password" id="newPassword" name="password" placeholder="Set your password" 
           pattern="^(?=.*[a-z])(?=.*[A-Z])(?=.*[@#&*]).{6,}$" 
           title="Password must be at least 6 characters long, contain an uppercase letter, a lowercase letter, and a special character (@, #, &, *)." required>
    
           <input class="btn" type="submit" name="register" value="Register">
    
    <p>Already have an account? <a href="#" id="backToLoginLink">Back to Login</a></p>
    
  </form>
</div>

<div class="forgot-password-container" id="forgotPasswordContainer" style="display: none;">
  <h1>Reset Your Password</h1>
  
  <form id="resetPasswordForm" action="reset_password.php" method="POST">
    
    <label for="resetEmail">Your Email Address <span class="required">*</span></label>
    <input type="email" id="resetEmail" name="email" placeholder="Enter your email to reset password" required>
    
    <label for="newPassword">Set New Password <span class="required">*</span></label>
    <input type="password" id="newPasswordReset" name="newPassword" placeholder="Enter new password" 
           pattern="^(?=.*[a-z])(?=.*[A-Z])(?=.*[@#&*]).{6,}$" 
           title="Password must be at least 6 characters long, contain an uppercase letter, a lowercase letter, and a special character (@, #, &, *)." required>
    
    <label for="confirmPassword">Confirm New Password <span class="required">*</span></label>
    <input type="password" id="confirmPassword" name="confirmPassword" placeholder="Confirm new password" required>
    
    <button type="submit" class="btn-reset">Reset Password</button>
    
    <p>Remembered your password? <a href="#" id="backToLoginFromResetLink">Back to Login</a></p>
  </form>
</div>

<script>
  // Show and Hide Sections Based on User Actions
  document.getElementById('registerLink').addEventListener('click', function(event) {
    event.preventDefault();
    document.getElementById('logincontainer').style.display = 'none';
    document.getElementById('registercontainer').style.display = 'block';
  });

  document.getElementById('backToLoginLink').addEventListener('click', function(event) {
    event.preventDefault();
    document.getElementById('registercontainer').style.display = 'none';
    document.getElementById('logincontainer').style.display = 'block';
  });

  document.getElementById('forgotPasswordLink').addEventListener('click', function(event) {
    event.preventDefault();
    document.getElementById('logincontainer').style.display = 'none';
    document.getElementById('forgotPasswordContainer').style.display = 'block';
  });

  document.getElementById('backToLoginFromResetLink').addEventListener('click', function(event) {
    event.preventDefault();
    document.getElementById('forgotPasswordContainer').style.display = 'none';
    document.getElementById('logincontainer').style.display = 'block';
  });
</script>
</body>
</html>
