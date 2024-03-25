<?php
session_start();

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    // Retrieve form data
    $email = $_POST['email'];
    $username = $_POST['username'];
    $password = $_POST['password'];
    $confirmPassword = $_POST['confirm_password'];

    // Validate form data (you can add more validation if needed)
    if ($password !== $confirmPassword) {
        die("Error: Passwords do not match.");
    }

    // Hash the password
    $hashedPassword = password_hash($password, PASSWORD_DEFAULT);

    // Database connection details
    $servername = "localhost";
    $dbusername = "user_info_user";
    $dbpassword = "user_info_password";
    $dbname = "user_info";

    // Create a new MySQLi instance
    $conn = new mysqli($servername, $dbusername, $dbpassword, $dbname);

    // Check connection
    if ($conn->connect_error) {
        die("Connection failed: " . $conn->connect_error);
    }

    // Prepare and execute the SQL query using prepared statements
    $sql = "INSERT INTO users (email, username, password) VALUES (?, ?, ?)";
    $stmt = $conn->prepare($sql);
    $stmt->bind_param("sss", $email, $username, $hashedPassword);

    if ($stmt->execute()) {
        // Store the username in the session
        $_SESSION['username'] = $username;

        // Redirect to the home page or wherever you want
        header("Location: home.php");
        exit();
    }

    // Close the prepared statement and the database connection
    $stmt->close();
    $conn->close();
} else {
    header("Location: home.php");
    exit();
}
?>
