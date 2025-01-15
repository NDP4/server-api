<?php
$host = 'db';  // Use the service name from docker-compose
$username = 'your-username';
$password = 'your-password';
$dbname = 'your-database';

$conn = new mysqli($host, $username, $password, $dbname);

if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}
