<?php
session_start();

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    // Retrieve data
    $username = $_POST['username'];
    $password = $_POST['password'];

    // Connection details
    $servername = "localhost";
    $dbusername = "user_info_user";
    $dbpassword = "user_info_password";
    $dbname = "user_info";

    // Create new MySQLi instance
    $conn = new mysqli($servername, $dbusername, $dbpassword, $dbname);

    // Check connectie
    if ($conn->connect_error) {
        die("Connection failed: " . $conn->connect_error);
    }

    // Execute SQL Query
    $sql = "SELECT id, username, password FROM users WHERE username = ?";
    $stmt = $conn->prepare($sql);
    $stmt->bind_param("s", $username);
    $stmt->execute();
    $result = $stmt->get_result();

    if ($result->num_rows === 1) {
        $row = $result->fetch_assoc();
        $hashedPassword = $row['password'];

        // checks the password
        if (password_verify($password, $hashedPassword)) {
            $_SESSION['username'] = $row['username'];
            header("Location: index.php");
            exit();
        }
    }

    // Close the prepared statement and the database connection
    $stmt->close();
    $conn->close();
}

// back to home page if login not good
header("Location: index.php");
exit();
?>
<?php
