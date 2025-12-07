<?php
session_start();

// Database configuration
$host = 'localhost';
$username = 'root';
$password = '';
$database = 'shopeasy_db';
$table = 'users';

// Connect to MySQL
$conn = new mysqli($host, $username, $password, $database);

// Check connection
if ($conn->connect_error) {
    header("Location: login.php?error=1");
    exit();
}

// Get form data
$email = trim($_POST['email'] ?? '');
$password = $_POST['password'] ?? '';

// Basic validation
if (empty($email) || empty($password)) {
    header("Location: login.php?error=1");
    exit();
}

// Check if user exists
$sql = "SELECT id, first_name, last_name, email, password FROM $table WHERE email = ?";
$stmt = $conn->prepare($sql);
$stmt->bind_param("s", $email);
$stmt->execute();
$stmt->store_result();

if ($stmt->num_rows === 0) {
    $stmt->close();
    $conn->close();
    header("Location: login.php?error=1");
    exit();
}

// Fetch user data
$stmt->bind_result($user_id, $first_name, $last_name, $user_email, $hashed_password);
$stmt->fetch();
$stmt->close();

// Verify password
if (password_verify($password, $hashed_password)) {
    // Set session variables
    $_SESSION['user_id'] = $user_id;
    $_SESSION['user_email'] = $user_email;
    $_SESSION['user_name'] = $first_name . ' ' . $last_name;
    $_SESSION['logged_in'] = true;
    
    // Redirect to index page
    header("Location: dashboard.php");
    exit();
} else {
    // Invalid password
    header("Location: login.php?error=1");
    exit();
}

$conn->close();
?>