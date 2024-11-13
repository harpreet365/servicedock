<?php
// Database connection
$conn = new mysqli('localhost', 'your_db_username', 'your_db_password', 'ServiceDock');

// Check connection
if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}

// Get data from the registration form
$username = $_POST['username'];
$email = $_POST['email'];
$phone_number = $_POST['phone_number'];
$password = password_hash($_POST['password'], PASSWORD_DEFAULT); // Hash password for security

// Insert data into the users table
$sql = "INSERT INTO users (username, email, phone_number, password) VALUES (?, ?, ?, ?)";
$stmt = $conn->prepare($sql);
$stmt->bind_param("ssss", $username, $email, $phone_number, $password);

if ($stmt->execute()) {
    echo "Registration successful";
} else {
    echo "Error: " . $stmt->error;
}

$stmt->close();
$conn->close();
?>
