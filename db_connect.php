<?php
$host = 'localhost'; // or your server's host
$db = 'ideliver'; // name of your database
$user = 'root'; // your database username
$pass = ''; // your database password (if any)

$conn = new mysqli($host, $user, $pass, $db);

if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}
?>
