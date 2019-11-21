<?php
$hostname='localhost';
$username='root';
$password='';
$dbname='football';

// create connection
$conn = mysqli_connect($hostname, $username, $password, $dbname);

// Check connection
if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}
echo "Connected successfully";

?>