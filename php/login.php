<?php
session_start(); // Start the session

// Database connection
$conn = new mysqli("localhost", "root", "", "your_database_name"); // Replace with actual database details
if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}

// Check if form is submitted
if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    $email = $_POST['email'];
    $password = $_POST['password'];

    // Sanitize inputs
    $email = $conn->real_escape_string($email); // Prevent SQL injection

    // Check credentials
    $sql = "SELECT * FROM users WHERE email='$email'";
    $result = $conn->query($sql);
    if ($result->num_rows > 0) {
        $row = $result->fetch_assoc();
        if (password_verify($password, $row['password'])) {
            // Successful login
            $_SESSION['username'] = $row['username'];
            header("Location: index.html"); // Redirect to dashboard page
            exit(); // Make sure no further code is executed
        } else {
            echo "Invalid password.";
        }
    } else {
        echo "No account found with that email.";
    }
}

$conn->close();
?>
