<?php
//take email and password
$username = $_POST['Email'];
$password = $_POST['password'];

//enter server info
$servername = "localhost";
$email = "your_email";
$password = "your_password";
$dbname = "db2";

//establish connection using info
$conn = new mysqli($servername, 'root', ' ');
 
?>