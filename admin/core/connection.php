<?php
// Database configuration
$host = 'localhost';
$username = 'root';
$password = '';
$database = 'myproject_db';

// Create a connection
$conn = new mysqli($host, $username, $password, $database);

// Check the connection
if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}

?>