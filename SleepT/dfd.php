<?php
// Start session
session_start();

// Database connection
$servername = "localhost";
$dbUsername = "root";
$dbPassword = "";
$dbName = "sleept";

$conn = new mysqli($servername, $dbUsername, $dbPassword, $dbName);

// Check connection
if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}

// Get form data
$username = $_POST['username'];
$password = $_POST['password'];
$sleep_id = $_POST['sleepid'];

// Hash the password for security
$hashedPassword = password_hash($password, PASSWORD_DEFAULT);

// Check if the username or sleep ID already exists
$sql = "SELECT * FROM users WHERE uname = ? OR id = ?";
$stmt = $conn->prepare($sql);
$stmt->bind_param("ss", $username, $sleep_id);
$stmt->execute();
$result = $stmt->get_result();

if ($result->num_rows > 0) {
    echo "Username or Sleep ID already exists.";
} else {
    // Insert the new user into the users table
    $sql = "INSERT INTO users (id, uname, password) VALUES (?, ?, ?)";
    $stmt = $conn->prepare($sql);
    $stmt->bind_param("sss", $sleep_id, $username, $hashedPassword);

    if ($stmt->execute()) {
        // Insert user ID into the sleep_history table
        $sql = "INSERT INTO sleep_history (id) VALUES (?)";
        $stmt = $conn->prepare($sql);
        $stmt->bind_param("s", $sleep_id);

        if ($stmt->execute()) {
            // Store sleepid in localStorage using JavaScript
            echo "<script>
                localStorage.setItem('sleepid', '$sleep_id');
                alert('Registration successful! You can now log in.');
                window.location.href = 'loginform.html';
            </script>";
            exit();
        } else {
            echo "Error inserting sleep history data: " . $stmt->error;
        }
    } else {
        echo "Error inserting user data: " . $stmt->error;
    }
}

// Close the statement and connection
$stmt->close();
$conn->close();
?>
