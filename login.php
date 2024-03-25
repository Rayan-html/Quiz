<?php
error_reporting(E_ALL);
ini_set('display_errors', 1);

session_start();

// Check if the user is already logged in, redirect to home.php
if (isset($_SESSION['username'])) {
    header("Location: home.php");
    exit;
}

// Check if the user is submitting the login form
if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    // Database connection details
    $host = "localhost";
    $dbUsername = "root"; // Replace with your MySQL username
    $dbPassword = "root"; // Replace with your MySQL password
    $dbName = "user_info"; // Replace with your database name

    // Get the entered username and password
    $username = $_POST['username'];
    $password = $_POST['password'];

    // Create a connection to the database
    $conn = new mysqli($host, $dbUsername, $dbPassword, $dbName);
    if ($conn->connect_error) {
        die("Connection failed: " . $conn->connect_error);
    }

    // Prepare the query to fetch the hashed password
    $stmt = $conn->prepare("SELECT password FROM users WHERE username = ?");
    if (!$stmt) {
        die("Prepare failed: " . $conn->error);
    }

    // Bind the username parameter and execute the query
    $stmt->bind_param("s", $username);
    if (!$stmt->execute()) {
        die("Execution failed: " . $stmt->error);
    }

    $result = $stmt->get_result();

    // Check if a matching row is found
    if ($result->num_rows > 0) {
        $row = $result->fetch_assoc();
        $hashedPassword = $row['password'];

        // Verify the entered password with the hashed password
        if (password_verify($password, $hashedPassword)) {
            // Store the username in the session
            $_SESSION['username'] = $username;

            // Redirect to the home.php page
            header("Location: home.php");
            exit;
        } else {
            $errorMessage = "Invalid username or password. Please try again.";
        }
    } else {
        $errorMessage = "Invalid username or password. Please try again.";
    }

    // Close the statement and database connection
    $stmt->close();
    $conn->close();
}
?>

<!DOCTYPE html>
<html>
<head>
    <title>Techniekmarkt - Login</title>
    <link rel="stylesheet" type="text/css" href="main.css">
</head>
<body>
<nav class="navbar">
    <ul>
        <li><a href="boeken.php">Boeken</a></li>
        <li><a href="laptops.php">Laptops</a></li>
        <li><a href="home.php">Home</a></li>
    </ul>
</nav>
<div class="container">
    <h1 class="title">TECHNIEKMARKT</h1>
    <nav class="navbar">
        <ul>
            <li><a href="boeken.php">Boeken</a></li>
            <li><a href="laptop.php">Laptops</a></li>
            <li><a href="home.php">Home</a></li>
        </ul>
    </nav>
    <div class="content">
        <p class="welcome">Welcome to Techniekmarkt! Please login.</p>
    </div>
    <div class="form-container">
        <form id="login-form" action="login.php" method="POST">
            <input type="text" name="username" placeholder="Username" value="" required>
            <input type="password" name="password" placeholder="Password" value="" required>
            <button type="submit">Login</button>
        </form>
        <button onclick="toggleForm('register-form')">Register</button>
    </div>
</div>
</body>
</html>
