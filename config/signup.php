<?php
// Include the database connection file
include('dbconn.php');

// Check if the form is submitted
if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    // Sanitize and fetch form data
    $first_name = htmlspecialchars(trim($_POST['fname']));
    $last_name = htmlspecialchars(trim($_POST['lname']));
    $email = htmlspecialchars(trim($_POST['email']));
    $password = trim($_POST['password']);
    $confirm_password = trim($_POST['cpassword']);

    // Error array to capture issues
    $errors = [];

    // Validate form inputs
    if (empty($first_name)) {
        $errors[] = "First name is required.";
    }
    if (empty($last_name)) {
        $errors[] = "Last name is required.";
    }
    if (empty($email) || !filter_var($email, FILTER_VALIDATE_EMAIL)) {
        $errors[] = "Valid email is required.";
    }
    if (empty($password) || strlen($password) < 6) {
        $errors[] = "Password must be at least 6 characters.";
    }
    if ($password !== $confirm_password) {
        $errors[] = "Passwords do not match.";
    }

    // If no errors, proceed with database insertion
    if (empty($errors)) {
        // Hash the password
        $password_hash = password_hash($password, PASSWORD_BCRYPT);

        // Prepare and execute the SQL query
        $query = "INSERT INTO users (first_name, last_name, email, password_hash) VALUES (?, ?, ?, ?)";
        if ($stmt = $conn->prepare($query)) {
            $stmt->bind_param("ssss", $first_name, $last_name, $email, $password_hash);

            if ($stmt->execute()) {
                // Redirect to login page on success
                header("Location: ../login.php");
                exit();
            } else {
                echo "Error: " . $stmt->error;
            }

            $stmt->close();
        } else {
            echo "Error: " . $conn->error;
        }
    } else {
        // Display errors
        foreach ($errors as $error) {
            echo "<p style='color: red;'>$error</p>";
        }
    }
}
?>