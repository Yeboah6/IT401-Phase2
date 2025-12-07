<?php
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
    header("Location: index.php?error=db_error");
    exit();
}

// Enable error reporting for debugging (remove in production)
mysqli_report(MYSQLI_REPORT_ERROR | MYSQLI_REPORT_STRICT);

// Get form data and sanitize
$first_name = trim($_POST['first_name'] ?? '');
$last_name = trim($_POST['last_name'] ?? '');
$email = trim($_POST['email'] ?? '');
$age = trim($_POST['age'] ?? '');
$mobile_number = trim($_POST['number'] ?? '');
$address = trim($_POST['address'] ?? '');
$country = trim($_POST['country'] ?? '');
$region = trim($_POST['region'] ?? '');
$school = trim($_POST['school'] ?? '');
$password = $_POST['password'] ?? '';
$confirm_password = $_POST['confirm_password'] ?? '';

// Store form data in session for redisplay on error
$form_data = compact('first_name', 'last_name', 'email', 'age', 'mobile_number', 
                     'address', 'country', 'region', 'school');

// Comprehensive validation
$errors = [];

// Validate First Name
if (empty($first_name) || strlen($first_name) < 2) {
    $errors[] = 'First name must be at least 2 characters';
}

// Validate Last Name
if (empty($last_name) || strlen($last_name) < 2) {
    $errors[] = 'Last name must be at least 2 characters';
}

// Validate Email
if (empty($email) || !filter_var($email, FILTER_VALIDATE_EMAIL)) {
    $errors[] = 'Invalid email address';
}

// Validate Age
if (!is_numeric($age) || $age < 1 || $age > 120) {
    $errors[] = 'Age must be between 1 and 120';
}

// Validate Phone Number
$cleaned_phone = preg_replace('/[^\d+]/', '', $mobile_number);
if (empty($mobile_number) || !preg_match('/^[\+]?[0-9][\d]{0,15}$/', $cleaned_phone) || strlen($cleaned_phone) < 10) {
    $errors[] = 'Invalid phone number';
}

// Validate Address
if (empty($address) || strlen($address) < 5) {
    $errors[] = 'Address must be at least 5 characters';
}

// Validate Country
if (empty($country) || strlen($country) < 2) {
    $errors[] = 'Country must be at least 2 characters';
}

// Validate Region
if (empty($region) || strlen($region) < 2) {
    $errors[] = 'Region must be at least 2 characters';
}

// Validate School
if (empty($school) || strlen($school) < 2) {
    $errors[] = 'School must be at least 2 characters';
}

// Validate Password
if (strlen($password) < 6) {
    $errors[] = 'Password must be at least 6 characters';
}

// Validate Password Confirmation
if ($password !== $confirm_password) {
    $errors[] = 'Passwords do not match';
}

// If there are validation errors, redirect back with error message
if (!empty($errors)) {
    // Store form data in session for redisplay
    session_start();
    $_SESSION['form_data'] = $form_data;
    
    // Redirect with appropriate error
    if (in_array('Invalid email address', $errors)) {
        header("Location: index.php?error=invalid_email");
    } elseif (in_array('Age must be between 1 and 120', $errors)) {
        header("Location: index.php?error=invalid_age");
    } elseif (in_array('Invalid phone number', $errors)) {
        header("Location: index.php?error=invalid_phone");
    } elseif (in_array('Password must be at least 6 characters', $errors)) {
        header("Location: index.php?error=password_length");
    } elseif (in_array('Passwords do not match', $errors)) {
        header("Location: index.php?error=password_mismatch");
    } else {
        header("Location: index.php?error=validation_error");
    }
    exit();
}

// Check if email already exists
$check_email_sql = "SELECT id FROM $table WHERE email = ?";
$stmt = $conn->prepare($check_email_sql);
$stmt->bind_param("s", $email);
$stmt->execute();
$stmt->store_result();

if ($stmt->num_rows > 0) {
    $stmt->close();
    $conn->close();
    session_start();
    $_SESSION['form_data'] = $form_data;
    header("Location: index.php?error=email_exists");
    exit();
}
$stmt->close();

// Hash password for security
$hashed_password = password_hash($password, PASSWORD_DEFAULT);

// Create users table if it doesn't exist
$create_table_sql = "CREATE TABLE IF NOT EXISTS users (
    id INT(11) AUTO_INCREMENT PRIMARY KEY,
    first_name VARCHAR(100) NOT NULL,
    last_name VARCHAR(100) NOT NULL,
    email VARCHAR(255) NOT NULL UNIQUE,
    age INT(3) NOT NULL,
    mobile_number VARCHAR(20) NOT NULL,
    address TEXT NOT NULL,
    country VARCHAR(100) NOT NULL,
    region VARCHAR(100) NOT NULL,
    school VARCHAR(255) NOT NULL,
    password VARCHAR(255) NOT NULL,
    registration_date TIMESTAMP DEFAULT CURRENT_TIMESTAMP,
    INDEX idx_email (email)
)";

if (!$conn->query($create_table_sql)) {
    session_start();
    $_SESSION['form_data'] = $form_data;
    header("Location: index.php?error=db_error");
    exit();
}

// Prepare and execute insert statement
$insert_sql = "INSERT INTO $table (first_name, last_name, email, age, mobile_number, address, country, region, school, password) 
               VALUES (?, ?, ?, ?, ?, ?, ?, ?, ?, ?)";

$stmt = $conn->prepare($insert_sql);
$stmt->bind_param("sssissssss", 
    $first_name, 
    $last_name, 
    $email, 
    $age, 
    $mobile_number, 
    $address, 
    $country, 
    $region, 
    $school, 
    $hashed_password
);

if ($stmt->execute()) {
    // Get the last inserted ID
    $user_id = $stmt->insert_id;
    
    $stmt->close();
    $conn->close();
    
    // Start session and store user data
    session_start();
    $_SESSION['user_id'] = $user_id;
    $_SESSION['user_email'] = $email;
    $_SESSION['user_name'] = $first_name . ' ' . $last_name;
    $_SESSION['logged_in'] = true;
    
    // Clear form data from session
    unset($_SESSION['form_data']);
    
    // Redirect to index page with success
    header("Location: dashboard.php?success=1");
    exit();
} else {
    $stmt->close();
    $conn->close();
    session_start();
    $_SESSION['form_data'] = $form_data;
    header("Location: index.php?error=db_error");
    exit();
}
?>