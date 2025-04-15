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
$username = $_POST['username'] ?? null;
$password = $_POST['password'] ?? null;
$bill_id = $_POST['sleepid'] ?? null;

// Validate inputs
if (empty($username) || empty($password) || empty($bill_id)) {
    echo "Please fill in all required fields.";
    exit();
}

// Query to validate user
$sql = "SELECT uname, password FROM users WHERE id = ?";
$stmt = $conn->prepare($sql);
$stmt->bind_param("s", $bill_id);
$stmt->execute();
$result = $stmt->get_result();

if ($result->num_rows > 0) {
    $row = $result->fetch_assoc();

    // Verify the hashed password
    if (password_verify($password, $row['password']) && $username === $row['uname']) {
        // Successful login
        echo "<script>
                localStorage.setItem('bill_id', '" . $bill_id . "');
                sessionStorage.setItem('ebill_id', '" . $bill_id . "');  
                console.log('Username and bill ID saved in localStorage');
                window.location.href = 'home.html';
              </script>";
        exit();
    } else {
        // Invalid username or password
        echo "Invalid username or password.";
    }
} else {
    // Invalid username or bill ID
    echo "Invalid username or bill ID.";
}

// Close the statement and connection
$stmt->close();
$conn->close();
?>
