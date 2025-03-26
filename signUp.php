<?php
session_start(); // Move to top
include('db_connect.php');

// Ensure the connection is valid
if (!$conn) {
    die("Connection failed: " . mysqli_connect_error());
}

// Registration logic
if (isset($_POST['register'])) {  
    $first_name = $_POST['first_name'];
    $last_name = $_POST['last_name'];
    $email = $_POST['email'];
    $password = $_POST['password'];
    $password = md5($password);
    $checkEmail= "SELECT * From admins where email='$email'";

    $result=$conn->query($checkEmail);

    if ($result->num_rows > 0) {
        echo "Email address already exists";
    } else{
        $insertQuery="INSERT INTO admins(first_name, last_name, email, password)
                    VALUES('$first_name', '$last_name', '$email', '$password')";
                     if ($conn->query ($insertQuery)==TRUE){
                        header("location: admin.php");
                    
                     }
                     else{
                        echo "error: ".$conn->error;
                     }
    }
}
?>
