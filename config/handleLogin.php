<?php
session_start();
include 'dbconn.php';
// Handle form submission
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $email = trim($_POST['email']);
    $password = trim($_POST['password']);

    // Input validation
    if (empty($email) || empty($password)) {
        die("Email and password are required.");
    }

    if (!filter_var($email, FILTER_VALIDATE_EMAIL)) {
        die("Invalid email format.");
    }

    // Check if the user exists
    $stmt = $conn->prepare("SELECT id, first_name, password_hash FROM users WHERE email = ?");
    $stmt->bind_param("s", $email);
    $stmt->execute();
    $stmt->store_result();

    if ($stmt->num_rows > 0) {
        $stmt->bind_result($userId, $firstName, $hashedPassword);
        $stmt->fetch();

        // Verify the password
        if (password_verify($password, $hashedPassword)) {
            // Set session variables
            $_SESSION['user_id'] = $userId;
            $_SESSION['first_name'] = $firstName;

            // Redirect to Dashboard
            header("Location: ../Dashboard.php");
            exit();
        } else {
            die("Invalid password.");
        }
    } else {
        die("No user found with this email address.");
    }

    $stmt->close();
}

$conn->close();
?>