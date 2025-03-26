<?php
session_start();
include('db_connect.php');
?>
<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>Trust Loan Application</title>
  <link rel="stylesheet" href="home.css">
</head>
<body>
  <?php
  if(isset($_SESSION['email'])){
    $email=$_SESSION['email'];
    $query=mysqli_query($conn, "SELECT client_login.* FROM `client_login` WHERE client_login.email='$email'");
    while ($row=mysqli_fetch_array($query)){
      echo $row['email'].''.$row['password'];
    }
  }
  ?>
  :)
  <div class="navbar">
    <div class="welcome-message">
      <h1>Welcome to Trust Loan - Quality is Our Assurance</h1>
    </div>
    <div class="profile-icon">
      <img src="user.png" alt="Profile" class="profile-img" id="profile-icon">
      
      <div class="dropdown-content" id="profile-dropdown">
        <a id="profile-details" class="dropdown-link">My Profile</a>
        <a id="loan-status" class="dropdown-link">Repayment</a>
        <a id="about-us" class="dropdown-link">About Us</a> 
        <a id="terms" class="dropdown-link">Terms of Service</a>                       
        <a id="sign-out" class="dropdown-link">Sign Out</a>
      </div>
    </div>
  </div>

  <div class="main-content">
    <div class="apply-section" id="apply-section">
      <button class="apply-button" id="apply-button">
        <span>Click here to Apply</span>
        <i class="arrow-down"></i>
      </button>
    </div>

    
    <div class="form-container" id="form-container" style="display:none;">
  <form action="submit-details.php" method="POST" id="loan-form">
    <!-- Step 1: Client Details -->
    <div class="form-step" id="step-1">
      <h1>Client Details</h1>
      <label for="first-name">First Name <span class="required">*</span></label>
      <input type="text" id="first-name" name="first_name" placeholder="Enter your first name" required>
      <label for="last-name">Last Name <span class="required">*</span></label>
      <input type="text" id="last-name" name="last_name" placeholder="Enter your last name" required>
      <label for="phone_number">Phone Number <span class="required">*</span></label>
      <input type="tel" id="phone" name="phone_number" placeholder="Enter your phone number" required>
      <label for="national-id">National ID <span class="required">*</span></label>
      <input type="text" id="national-id" name="national_id" placeholder="Enter your national ID" required>
      <label for="dob">Date of Birth <span class="required">*</span></label>
      <input type="date" id="dob" name="date_of_birth" required>
      <label for="address">Address <span class="required">*</span></label>
      <textarea id="address" name="address" placeholder="Enter your address" required></textarea>
      <div class="form-buttons">
        <button type="button" id="next-1" class="btn-next">Next</button>
      </div>
    </div>

    <!-- Step 2: Guarantor Details -->
    <div class="form-step" id="step-2" style="display:none;">
      <h1>Guarantor Details</h1>
      <label for="g-first-name">First Name <span class="required">*</span></label>
      <input type="text" id="g-first-name" name="g_first_name" placeholder="Enter guarantor's first name" required>
      <label for="g-last-name">Last Name <span class="required">*</span></label>
      <input type="text" id="g-last-name" name="g_last_name" placeholder="Enter guarantor's last name" required>
      <label for="g-email">Email Address <span class="required">*</span></label>
      <input type="email" id="g-email" name="g_email" placeholder="Enter guarantor's email" required>
      <label for="g-national-id">National ID <span class="required">*</span></label>
      <input type="text" id="g-national-id" name="g_national_id" placeholder="Enter guarantor's national ID" required>
      <label for="g-address">Address <span class="required">*</span></label>
      <textarea id="address" id="g-address" name="g_address" placeholder="Enter your address" required></textarea>
      <label for="g-relationship">Relationship <span class="required">*</span></label>
      <select id="g-relationship" name="g_relationship" required>
        <option value="spouse">Spouse</option>
        <option value="brother">Brother</option>
        <option value="sister">Sister</option>
        <option value="parent">Parent</option>
        <option value="relative">Relative</option>
        <option value="friend">Friend</option>
      </select>
      <div class="form-buttons">
        <button type="button" id="back-1" class="btn-back">Back</button>
        <button type="button" id="next-2" class="btn-next">Next</button>
      </div>
    </div>

    <!-- Step 3: Loan Information -->
    <div class="form-step" id="step-3" style="display:none;">
      <h1>Loan Information</h1>
      <label for="loan-amount">Loan Amount <span class="required">*</span></label>
      <input type="number" id="loan-amount" name="loan_amount" placeholder="Enter loan amount" required>
      <label for="loan-type">Loan Type <span class="required">*</span></label>
      <select id="loan-type" name="loan_type" required>
        <option value="personal">Personal</option>
        <option value="business">Business</option>
        <option value="Student">Student</option>
        <option value="mortgage">mortgage</option>
        <option value="vehicle">vehicle</option>
        <option value="insurance">insurance</option>
      </select>
      <label for="interest-rate">Interest Rate (%) Monthly <span class="required">*</span></label>
      <input type="number" id="interest-rate" name="interest_rate" placeholder="automatically set" required readonly>
      <label for="repayment-period">Repayment Period (Months) <span class="required">*</span></label>
      <input type="number" id="repayment-period" name="repayment_period" placeholder="Enter repayment period" required>
      <label for="start-date">Start Date <span class="required">*</span></label>
      <input type="date" id="start-date" name="start_date" required>
      <label for="due-date">Due Date <span class="required">*</span></label>
      <input type="date" id="due-date" name="due_date" required>
      <div class="form-buttons">
        <button type="button" id="back-2" class="btn-back">Back</button>
        <button type="button" id="finish" class="btn-finish">Finish</button>
      </div>
    </div>

    <!-- Confirmation Dialog -->
    <div id="confirmation-dialog" style="display:none;">
      <h2>Are you sure you want to submit?</h2>
      <label for="confirmation-checkbox">
        <input type="checkbox" id="confirmation-checkbox"> I confirm that the information is correct.
      </label>
      <div class="form-buttons">
        <input class="btn-submit" type="submit" id="submit-form" name="submit" value="Submit">
        <input type="button" id="cancel-submit" name="cancel" value="Cancel">
      </div>
    </div>
  </form>
</div>
      <div id="confirmation-dialog" style="display:none;">
        <h2>Are you sure you want to submit?</h2>
        <label for="confirmation-checkbox">
          <input type="checkbox" id="confirmation-checkbox"> I confirm that the information is correct.
        </label>
        <div class="form-buttons">
        <input class="btn-submit" type="submit" id="submit-form" name="submit" value="Submit">
        <input class="btn-cancel" type="button" id="cancel-submit" name="cancel" value="Cancel">

        </div>
      </div>
    </div>

    <!-- Content Sections for Dropdown -->
    <div class="content-section" id="profile-content" style="display:none;">
      <h2>My Profile</h2>
      <p id="profile-info">No profile data available. Please fill out the application first.</p>
      <!-- Add more profile content here as needed -->
    </div>

    <div class="content-section" id="repayment-content" style="display:none;">
      <h2>Repayment</h2>
      <p>Complete the form below to make a loan repayment.</p>
      
      <div class="repayment-form-container"> 
        <form action="submit-repayment.php" method="POST">
          <label for="repayment-loan-type">Loan Type <span class="required">*</span></label>
          <select id="repayment-loan-type" name="loan_type" required>
            <option value="" disabled selected>Select loan type</option>
            <option value="student">Student Loan</option>
            <option value="business">Business Loan</option>
            <option value="personal">Personal Loan</option>
            <option value="mortgage">mortgage Loan</option>
            <option value="vehicle">vehicle Loan</option>
            <option value="insurance">insurance Loan</option>
          </select>
    
          <label for="payment-method">Payment Method <span class="required">*</span></label>
          <select id="payment-method" name="payment_method" required>
            <option value="" disabled selected>Select payment method</option>
            <option value="bank">Bank</option>
            <option value="mpesa">M-Pesa</option>
            <option value="paypal">PayPal</option>
            <option value="visa">Visa Card</option>
            <option value="mastercard">Mastercard</option>
          </select>
    
          <label for="amount-paid">Amount Paid <span class="required">*</span></label>
          <input type="number" id="amount-paid" name="amount_paid" placeholder="Enter amount paid" required>
    
          <div class="form-buttons">
          <input class="btn" type="submit" id="repayment-submit" name="submit" value="Submit" style="background-color: blue; color: white; border: none; padding: 10px 20px; font-size: 16px; cursor: pointer;">

          </div> 
        </form>
      </div>
    </div>
    

    <div class="content-section" id="about-content" style="display:none;">
      <h2>About Us</h2>
      <p>Trust Loan Microfinance is a leading provider of financial services dedicated to empowering individuals, families, and small businesses through affordable and accessible loans. Founded on the principles of trust, transparency, and community development, we specialize in providing microloans to underserved populations, helping them achieve financial independence and improve their quality of life.

        Our goal is to foster sustainable economic growth in communities by offering financial products tailored to meet the needs of low-income and entrepreneurial individuals. Through responsible lending practices and customer-focused services, Trust Loan Microfinance strives to be a catalyst for positive social change.</p>
        <h3>Mission</h3>
        <p> Our mission is to provide financial solutions that promote economic stability, social progress, and personal empowerment. We are committed to breaking down financial barriers for underserved populations by offering accessible microcredit and financial services that foster self-reliance, stimulate business growth, and improve livelihoods.</p>
        <h3>Vision</h3>
        <p>Our vision is to create a world where everyone, regardless of their background or financial status, has the opportunity to build a better future. We aim to be a trusted partner in transforming communities through financial inclusion, enabling individuals and families to thrive through entrepreneurship and sustainable income.</p>
        <h3>Our Services</h3>
        <p>At Trust Loan Microfinance, we offer a variety of financial products designed to meet the unique needs of our clients:</p>
        <ul>
         <li>Microloans: Small loans for individuals and micro-businesses to support personal growth and business expansion.</li>
         <li>Savings Accounts: Safe and flexible savings options for individuals and groups.</li>
         <li>Financial Literacy Programs: Workshops and training to improve financial management skills for long-term success.</li>
         <li>Insurance: Affordable insurance products that protect businesses and individuals against unexpected risks.</li>
        </ul>
      <h3>Core Values</h3>
      <ul>
        <li>Integrity</li>
        <li>Innovation</li>
        <li>Security</li>
        <li>Customer-Centric</li>
        <li>Sustainability</li>
      </ul>
      <h3>Awards and Recognition</h3>
      <p>Trust Loan Microfinance is proud to have been recognized for its contribution to community development and financial inclusion. Some of our recent awards include:</p>
      <ul>
        <li>East African Microfinance Innovation Award(2024)</li>
        <li>Financial Inclusion Excellence Award (2023)</li>
        <li>Client Satisfaction Excellence Award(2022)</li>
        <li>Best Microfinance Institution Award(2021)</li>
      </ul>
    </div>

    <div class="content-section" id="terms-content" style="display:none;">
      <h2>Terms of Service</h2>
      <p>By using our services, you agree to the following terms:</p>
      <ul>
        <li>All loans are subject to approval based on eligibility criteria.</li>
        <li>Interest rates are fixed as per the agreement.</li>
        <li>Late payments may attract penalties as specified in the loan agreement.</li>
        <li>Trust Loan reserves the right to update terms at any time with prior notice.</li>
        <li>Customers are advised to read and understand all loan agreements before acceptance.</li>
      </ul>
      <h6>subjected to copyright@2025</h6>
    </div>
  </div>

  <script>  

    // Toggle dropdown visibility
    document.getElementById("profile-icon").addEventListener("click", function(event) {
      var dropdown = document.getElementById("profile-dropdown");
      dropdown.style.display = dropdown.style.display === "block" ? "none" : "block";
      event.stopPropagation(); // Prevent click from closing immediately
    });

    // Handle "Apply" button click
    document.getElementById("apply-button").addEventListener("click", function() {
      hideAllSections();
      document.getElementById("form-container").style.display = "block";
      document.getElementById("step-1").style.display = "block";
      window.scrollTo(0, 0);
    });

    // Form Navigation Logic
document.getElementById("next-1").addEventListener("click", function() {
  document.getElementById("step-1").style.display = "none";
  document.getElementById("step-2").style.display = "block";
});
document.getElementById("back-1").addEventListener("click", function() {
  document.getElementById("step-2").style.display = "none";
  document.getElementById("step-1").style.display = "block";
});
document.getElementById("next-2").addEventListener("click", function() {
  document.getElementById("step-2").style.display = "none";
  document.getElementById("step-3").style.display = "block";
});
document.getElementById("back-2").addEventListener("click", function() {
  document.getElementById("step-3").style.display = "none";
  document.getElementById("step-2").style.display = "block";
});
document.getElementById("finish").addEventListener("click", function() {
  document.getElementById("confirmation-dialog").style.display = "block";
});

// Submit Form Logic
document.getElementById("submit-form").addEventListener("click", function(event) {
  if (!document.getElementById("confirmation-checkbox").checked) {
    event.preventDefault(); // Prevent form submission
    alert("Please confirm that the information is correct.");
  }
});

document.getElementById("cancel-submit").addEventListener("click", function() {
  document.getElementById("confirmation-dialog").style.display = "none";
});

    // Dropdown Item Handlers
    document.getElementById("profile-details").addEventListener("click", function() {
      hideAllSections();
      document.getElementById("profile-content").style.display = "block";
      document.getElementById("profile-dropdown").style.display = "none";
    });

    document.getElementById("loan-status").addEventListener("click", function() {
      hideAllSections();
      document.getElementById("repayment-content").style.display = "block";
      document.getElementById("profile-dropdown").style.display = "none";
    });

    document.getElementById("about-us").addEventListener("click", function() {
      hideAllSections();
      document.getElementById("about-content").style.display = "block";
      document.getElementById("profile-dropdown").style.display = "none";
    });

    document.getElementById("terms").addEventListener("click", function() {
      hideAllSections();
      document.getElementById("terms-content").style.display = "block";
      document.getElementById("profile-dropdown").style.display = "none";
    });

    document.getElementById("sign-out").addEventListener("click", function() {
      alert("You have been signed out.");
      window.location.href = "client login.php";
      hideAllSections();
      document.getElementById("apply-section").style.display = "block";
      document.getElementById("profile-dropdown").style.display = "none";
    });

    // Close dropdown when clicking outside
    document.addEventListener("click", function(event) {
      const dropdown = document.getElementById("profile-dropdown");
      const profileIcon = document.getElementById("profile-icon");
      if (!profileIcon.contains(event.target) && !dropdown.contains(event.target)) {
        dropdown.style.display = "none";
      }
    });

    // Helper function to hide all sections
    function hideAllSections() {
      document.getElementById("apply-section").style.display = "none";
      document.getElementById("form-container").style.display = "none";
      document.getElementById("step-1").style.display = "none";
      document.getElementById("step-2").style.display = "none";
      document.getElementById("step-3").style.display = "none";
      document.getElementById("confirmation-dialog").style.display = "none";
      document.getElementById("profile-content").style.display = "none";
      document.getElementById("repayment-content").style.display = "none";
      document.getElementById("about-content").style.display = "none";
      document.getElementById("terms-content").style.display = "none";
    }
    // Helper function to update profile content
  function updateProfileContent(clientData) {
    document.getElementById("profile-info").textContent = 
      `Name: ${clientData.firstName} ${clientData.lastName}, Phone: ${clientData.phone}, National ID: ${clientData.nationalId}, DOB: ${clientData.dob}, Address: ${clientData.address}`;
  }

  // Add event listener to loan amount input to update interest rate automatically
  document.getElementById("loan-amount").addEventListener("input", function() {
    const loanAmount = parseFloat(this.value) || 0;
    const interestRateField = document.getElementById("interest-rate");
    
    if (loanAmount > 0 && loanAmount <= 100000) {
      interestRateField.value = 5;  
    } else if (loanAmount > 100000) {
      interestRateField.value = 10; 
    } else {
      interestRateField.value = ""; 
    }
  });

  // Function to calculate due date based on start date and repayment period
  function calculateDueDate(startDate, repaymentPeriod) {
    const start = new Date(startDate);
    const monthsToAdd = parseInt(repaymentPeriod) || 0;
    const dueDate = new Date(start);
    dueDate.setMonth(start.getMonth() + monthsToAdd);
    return dueDate.toISOString().split('T')[0]; // Returns YYYY-MM-DD format
  }

  // Add event listeners for start date and repayment period changes
  document.getElementById("start-date").addEventListener("change", updateDueDate);
  document.getElementById("repayment-period").addEventListener("input", updateDueDate);

  function updateDueDate() {
    const startDate = document.getElementById("start-date").value;
    const repaymentPeriod = document.getElementById("repayment-period").value;
    const dueDateField = document.getElementById("due-date");

    if (startDate && repaymentPeriod) {
      const periodNum = parseInt(repaymentPeriod);
      if (periodNum > 0 && periodNum <= 120) { // Example: max 10 years
        const calculatedDueDate = calculateDueDate(startDate, periodNum);
        dueDateField.value = calculatedDueDate;
      } else {
        dueDateField.value = "";
        alert("Please enter a repayment period between 1 and 120 months");
      }
    } else {
      dueDateField.value = "";
    }
  }

  </script>
</body>
</html>

    

     </script>
</body>
</html>