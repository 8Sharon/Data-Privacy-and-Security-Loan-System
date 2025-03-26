<?php
session_start(); 
include('db_connect.php');

// Ensure the connection is valid
if (!$conn) {
    die("Connection failed: " . mysqli_connect_error());

}
// Login logic
if (isset($_POST['signin'])) {
    $email = $_POST['email'];
    $password = $_POST['password'];
    $password = md5($password);

    $sql="SELECT * From admins WHERE email='$email' and password='$password'";
    $result=$conn->query($sql);
    if ($result->num_rows > 0) {
        session_start();
        $row= $result->fetch_assoc();
        $_SESSION['email']=$row['email'];
        header("location: dashboard.php");
        exit();}
        else {
            echo "not found";
        }

    

}
?>