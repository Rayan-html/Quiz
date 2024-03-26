<?php

error_reporting(E_ALL);
ini_set('display_errors', 1);

session_start();

class Database {
    private $conn;

    public function __construct($host, $dbUsername, $dbPassword, $dbName) {
        $this->conn = new mysqli($host, $dbUsername, $dbPassword, $dbName);
        if ($this->conn->connect_error) {
            die("Connection failed: " . $this->conn->connect_error);
        }
    }

    public function prepareStatement($sql) {
        return $this->conn->prepare($sql);
    }

    public function executeStatement($stmt) {
        return $stmt->execute();
    }

    public function getResultSet($stmt) {
        return $stmt->get_result();
    }

    public function closeConnection() {
        $this->conn->close();
    }
}

class Auth {
    private $db;

    public function __construct(Database $db) {
        $this->db = $db;
    }

    public function login($username, $password) {
        // Prepare the query to fetch the hashed password
        $stmt = $this->db->prepareStatement("SELECT password FROM users WHERE username = ?");
        $stmt->bind_param("s", $username);
        $this->db->executeStatement($stmt);
        $result = $this->db->getResultSet($stmt);

        // Check if a matching row is found
        if ($result->num_rows > 0) {
            $row = $result->fetch_assoc();
            $hashedPassword = $row['password'];

            // Verify the entered password with the hashed password
            if (password_verify($password, $hashedPassword)) {
                // Store the username in the session
                $_SESSION['username'] = $username;
                return true;
            }
        }
        return false;
    }
}

class LoginForm {
    private $auth;

    public function __construct(Auth $auth) {
        $this->auth = $auth;
    }

    public function processLogin() {
        if ($_SERVER['REQUEST_METHOD'] === 'POST') {
            if (isset($_POST['username']) && isset($_POST['password'])) {
                $username = $_POST['username'];
                $password = $_POST['password'];
                if ($this->auth->login($username, $password)) {
                    header("Location: home.php");
                    exit;
                } else {
                    $errorMessage = "Invalid username or password. Please try again.";
                }
            }
        }
    }
}

// Database connection details
$host = "localhost";
$dbUsername = "root"; // Replace with your MySQL username
$dbPassword = "root"; // Replace with your MySQL password
$dbName = "user_info"; // Replace with your database name

// Create a connection to the database
$db = new Database($host, $dbUsername, $dbPassword, $dbName);

// Initialize Auth and LoginForm objects
$auth = new Auth($db);
$loginForm = new LoginForm($auth);

// Process login form submission
$loginForm->processLogin();

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
        <?php if (isset($errorMessage)) echo "<p>$errorMessage</p>"; ?>
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

