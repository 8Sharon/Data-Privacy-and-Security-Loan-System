<?php
$host = "127.0.0.1"; 
$username = "root"; 
$password = ""; 
$dbname = "loan"; 


$conn = new mysqli($host, $username, $password, $dbname);


if ($conn->connect_error) {
    die("Could not connect: " . $conn->connect_error);
}

?>