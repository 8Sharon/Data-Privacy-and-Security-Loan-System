<?php
session_start();
include('db_connect.php');?>
<!DOCTYPE html>
<html>
    <head>
        <title>Admin Dashboard</title>
        <link rel="stylesheet" href="dashboard.css">
        <script src="https://cdn.jsdelivr.net/npm/chart.js"></script>
    </head>
    <body>
    <?php 
    if (isset($_SESSION['email'])){
      $email=$_SESSION['email'];
      $query=mysqli_query($conn, "SELECT admins.* FROM `admins` WHERE admins.email='$email'");
      while ($row=mysqli_fetch_array($query)){
        echo $row['first_name'].''.$row['last_name'];
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
                <a id="about-us" class="dropdown-link">About Us</a> 
                <a id="terms" class="dropdown-link">Terms of Service</a>                       
                <a id="sign-out" class="dropdown-link">Sign Out</a>
              </div>
            </div>
            <div class="notification-icon">
              <img src="bell.png" alt="notification" class="bell-img" id="notification-icon">
              <span class="red-dot" id="notification-dot"></span>
              <div class="alert-dropdown" id="alert-dropdown">
    <?php
    $alertQuery = "SELECT * FROM alerts"; 

    $alertResult = $conn->query($alertQuery);
    if ($alertResult->num_rows > 0) {
        // Loop through all alerts and display them
        while ($alert = $alertResult->fetch_assoc()) {
            echo "<p>" . htmlspecialchars($alert['message']) . "</p>";
        }
    } else {
        echo "<p>No new alerts.</p>";
    }
    ?>
</div>
             </div>
        </div>

          <div class="container" id="main-container">
            <div class="sidebar">
              <div class="sidebar-item" id="dashboard-link">Dashboard</div>
              <div class="sidebar-item" id="risks-link">Risks</div>
              <div class="sidebar-item" id="reports-link">Reports</div>
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
  

            <div class="content-section" id="dashboard-content" style="display:block;">
    <h2>Dashboard</h2>
    <p>Welcome to your admin dashboard. Here you can view loan applications over time.</p>
    <div class="chart-container" style="position: relative; height:400px; width:80%;">
        <canvas id="loanChart"></canvas>
    </div>

    <div id="loan-details" style="margin-top: 20px; display: none;">
        <h3>Loan Details</h3>
        <table id="loan-details-table" border="1">
            <thead>
                <tr>
                    <th>Client Name</th>
                    <th>Loan Amount</th>
                    <th>Loan Type</th>
                    <th>Start Date</th>
                    <th>Due Date</th>
                </tr>
            </thead>
            <tbody id="loan-details-content"></tbody>
        </table>
        <button id="close-details" class="btn-close">Close</button>
    </div>
</div>

                        

    <div class="content-section" id="risks-content" style="display:none;">
    <h2>Risks</h2>
    <div class="outer">
    <table class="heatmap-table" id="risk-table">
        <thead>
            <tr>
                <th>Email</th>
                <th>Risk Level</th>
            </tr>
        </thead>
        <tbody id="risk-table-body">
            <?php
            // Query to fetch clients with failed login attempts >= 3
            $checkHighRiskQuery = "SELECT email, failed_attempts FROM client_login WHERE failed_attempts >= 3";
            $highRiskResult = $conn->query($checkHighRiskQuery);

            // Check if there are any users with failed attempts >= 3
            if ($highRiskResult->num_rows > 0) {
                // Loop through the results and display them in the table
                while ($row = $highRiskResult->fetch_assoc()) {
                    echo "<tr style='background-color: red;'>"; // Add red background color for high-risk users
                    echo "<td>" . $row['email'] . "</td>"; // Display email
                    echo "<td>High Risk</td>"; // Display risk level
                    echo "</tr>";
                }
            } else {
                // If no high-risk users, display a message indicating no high-risk clients
                echo "<tr><td colspan='2'>No high-risk </td></tr>";
            }
            ?>
        </tbody>
    </table>
</div>
    </div>
<div class="content-section" id="reports-content" style="display:none;">
    <h2>Reports</h2>
    <p>Generate a detailed report of all loans.</p>
    <button class="generate-report-btn" id="generate-report-btn" style="background-color: red; height: 40px;">Generate Report</button>
</div>

    <script>

      // Sidebar links
      document.getElementById('dashboard-link').addEventListener('click', function() {
          hideAllSections();
          document.getElementById('dashboard-content').style.display = 'block';
    
      });

      document.getElementById('risks-link').addEventListener('click', function() {
          hideAllSections();
          document.getElementById('risks-content').style.display = 'block';
          
      });

      document.getElementById('reports-link').addEventListener('click', function() {
          hideAllSections();
          document.getElementById('reports-content').style.display = 'block';
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
      window.location.href = "admin.php";
      hideAllSections();
      document.getElementById("apply-section").style.display = "block";
      document.getElementById("profile-dropdown").style.display = "none";
    });
    // Profile dropdown toggle
document.getElementById("profile-icon").addEventListener("click", function(event) {
  var dropdown = document.getElementById("profile-dropdown");
  dropdown.style.display = dropdown.style.display === "block" ? "none" : "block";
  event.stopPropagation(); // Prevent click from closing immediately
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
      document.getElementById("dashboard-content").style.display = "none";
      document.getElementById("risks-content").style.display = "none";
      document.getElementById("reports-content").style.display = "none";
      document.getElementById("about-content").style.display = "none";
      document.getElementById("terms-content").style.display = "none";
    }

      // Generate report button
      document.getElementById('generate-report-btn').addEventListener('click', function() {
          window.location.href = 'generate_loan_report.php';
      });

   // Check if there's an alert when the page loads
window.onload = function() {
    const notificationDot = document.getElementById('notification-dot');
    const alertDropdown = document.getElementById('alert-dropdown');
    <?php
    $alertQuery = "SELECT COUNT(*) AS alert_count FROM alerts"; // Corrected line
    $alertCountResult = $conn->query($alertQuery);
    $alertCount = $alertCountResult->fetch_assoc()['alert_count'];
    if ($alertCount > 0) {
        echo 'notificationDot.style.display = "block";';
    }
    ?>

    // Show alert details when clicked on the notification icon
    document.getElementById('notification-icon').addEventListener('click', function() {
        alertDropdown.style.display = alertDropdown.style.display === 'block' ? 'none' : 'block';
    });
}
// Fetch loan data for the chart from the database using PHP
<?php
// SQL query to get the count of loan applications per minute (modify as needed)
$query = "SELECT DATE_FORMAT(start_date, '%Y-%m-%d %H:%i') AS minute, COUNT(*) AS loan_count FROM loan GROUP BY minute ORDER BY minute ASC";
$result = $conn->query($query);

$labels = [];
$data = [];

if ($result->num_rows > 0) {
    while ($row = $result->fetch_assoc()) {
        $labels[] = $row['minute'];
        $data[] = $row['loan_count'];
    }
}

echo "var chartLabels = " . json_encode($labels) . ";";
echo "var chartData = " . json_encode($data) . ";";
?>

// Create the chart using Chart.js
const ctx = document.getElementById('loanChart').getContext('2d');
const loanChart = new Chart(ctx, {
    type: 'line',
    data: {
        labels: chartLabels,
        datasets: [{
            label: 'Loan Applications',
            data: chartData,
            borderColor: 'rgb(192, 75, 75)',
            fill: false
        }]
    },
    options: {
        responsive: true,
        onClick: function(event, elements) {
            if (elements.length > 0) {
                const index = elements[0].index; // Get the index of the clicked point
                const selectedMinute = chartLabels[index];

                // Fetch loan details for the selected minute (AJAX request)
                fetchLoanDetails(selectedMinute);
            }
        }
    }
});

// Fetch loan details based on the selected minute
function fetchLoanDetails(selectedMinute) {
    const xhr = new XMLHttpRequest();
    xhr.open('POST', 'fetch_loan_details.php', true);
    xhr.setRequestHeader('Content-Type', 'application/x-www-form-urlencoded');
    xhr.onload = function() {
        if (xhr.status == 200) {
            const loanDetails = JSON.parse(xhr.responseText);
            populateLoanDetailsTable(loanDetails);
        }
    };
    xhr.send('minute=' + selectedMinute);
}

// Populate the loan details table
function populateLoanDetailsTable(loanDetails) {
    const tableBody = document.getElementById('loan-details-content');
    tableBody.innerHTML = ''; // Clear the previous content

    loanDetails.forEach(loan => {
        const row = document.createElement('tr');
        row.innerHTML = `
            <td>${loan.first_name} ${loan.last_name}</td>
            <td>${loan.loan_amount}</td>
            <td>${loan.loan_type}</td>
            <td>${loan.start_date}</td>
            <td>${loan.due_date}</td>
        `;
        tableBody.appendChild(row);
    });

    // Show the loan details section
    document.getElementById('loan-details').style.display = 'block';
}

// Close the loan details section
document.getElementById('close-details').addEventListener('click', function() {
    document.getElementById('loan-details').style.display = 'none';
});

    </script>
    </body>
</html> 