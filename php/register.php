<?php
// Database connection
$servername = "localhost"; // Change this to your server
$username = "root"; // Change this to your database username
$password = ""; // Change this to your database password
$dbname = "servicedock"; // Change this to your database name

// Create connection
$conn = new mysqli($servername, $username, $password, $dbname);

// Check connection
if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}

// Check if the form is submitted
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    // Get the form data
    $username = $_POST['username'];
    $email = $_POST['email'];
    $phone = $_POST['phone'];
    $password = $_POST['password']; // It's a good idea to hash the password before saving it

    // Hash the password
    $hashed_password = password_hash($password, PASSWORD_DEFAULT);

    // Prepare the SQL query to insert data
    $sql = "INSERT INTO users (username, email, phone, password) VALUES ('$username', '$email', '$phone', '$hashed_password')";

    if ($conn->query($sql) === TRUE) {
        // Registration successful
        echo "New record created successfully";
        header("Location: index.html"); // Redirect after successful registration
    } else {
        // Error in insertion
        echo "Error: " . $sql . "<br>" . $conn->error;
    }
}

// Close the database connection
$conn->close();
?>
