<?php
// Database connection
$host = 'localhost';
$user = 'root';
$password = '';
$database = 'eco_friendly_shop';

$conn = new mysqli($host, $user, $password, $database);

// Check connection
if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}

// Handle registration
if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    $email = $_POST['email'];
    $password = $_POST['password'];
    $hashedPassword = password_hash($password, PASSWORD_BCRYPT);

    // Check if the email is already registered
    $checkQuery = "SELECT * FROM users WHERE email = ?";
    $stmt = $conn->prepare($checkQuery);
    $stmt->bind_param("s", $email);
    $stmt->execute();
    $result = $stmt->get_result();

    if ($result->num_rows > 0) {
        echo "Email is already registered.";
    } else {
        // Insert new user into the database
        $query = "INSERT INTO users (email, password) VALUES (?, ?)";
        $stmt = $conn->prepare($query);
        $stmt->bind_param("ss", $email, $hashedPassword);

        if ($stmt->execute()) {
            echo "Registration successful!";
        } else {
            echo "Error: " . $stmt->error;
        }
    }
}
?>
