<?php
// Database connection
$conn = new mysqli('localhost', 'your_db_username', 'your_db_password', 'ServiceDock');

// Check connection
if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}

// Get data from the login form
$email = $_POST['email'];
$phone_number = $_POST['phone_number'];
$password = $_POST['password'];

// Fetch user data from the database
$sql = "SELECT id, password FROM users WHERE email = ? AND phone_number = ?";
$stmt = $conn->prepare($sql);
$stmt->bind_param("ss", $email, $phone_number);
$stmt->execute();
$result = $stmt->get_result();

if ($result->num_rows > 0) {
    $user = $result->fetch_assoc();
    if (password_verify($password, $user['password'])) {
        echo "Login successful";
        // Start session or redirect to dashboard as needed
    } else {
        echo "Incorrect password";
    }
} else {
    echo "No account found with the provided email and phone number";
}

$stmt->close();
$conn->close();
?>
