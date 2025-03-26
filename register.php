<?php
include('db_connect.php');
// Ensure the connection is valid
if (!$conn) {
   die("Connection failed: " . mysqli_connect_error());
}
//registration logic
if(isset($_POST['register']))
 {
    $email = $_POST['email'];
    $password = $_POST['password'];
    $password = md5($password);

     $checkEmail= "SELECT*From client_login where email='$email'";
     $result= $conn->query ($checkEmail);
     if ($result->num_rows>0){
        echo "email address already exist";
     }
     else {
        $insertQuery="INSERT INTO client_login (email, password)
                      VALUES('$email', '$password')";
        if ($conn->query($insertQuery)==TRUE){
            header("location: client login.php");
        }
        else{
            echo "error:".$conn->error;
        }

    
     }
    }
    // login logic
if(isset($_POST['signin'])) {
   $email = $_POST['email'];
   $password = $_POST['password'];
   $password = md5($password);

   $sql = "SELECT * FROM client_login WHERE email='$email' AND password='$password'";
   $result = $conn->query($sql);
   if ($result->num_rows > 0) {
       // Reset failed attempts on successful login
       $updateQuery = "UPDATE client_login SET failed_attempts = 0 WHERE email='$email'";
       $conn->query($updateQuery);

       session_start();
       $row = $result->fetch_assoc();
       $_SESSION['email'] = $row['email'];
       header("location: home.php");
   } else {
       // Increment failed login attempts on incorrect credentials
       $updateQuery = "UPDATE client_login SET failed_attempts = failed_attempts + 1 WHERE email='$email'";
       $conn->query($updateQuery);

       // Check if failed attempts exceed 3 and send an alert
       $checkAttemptsQuery = "SELECT failed_attempts FROM client_login WHERE email='$email'";
       $attemptsResult = $conn->query($checkAttemptsQuery);
       $attempts = $attemptsResult->fetch_assoc()['failed_attempts'];

       if ($attempts >= 3) {
           // Create an alert for the admin dashboard
           $alertMessage = "Client with email $email has exceeded 3 failed login attempts.";
           $alertQuery = "INSERT INTO alerts (message) VALUES ('$alertMessage')";
           $conn->query($alertQuery);
       }

       echo "Incorrect email or password.";
   }
}



?>
