<?php
session_start();
?>

<!DOCTYPE html>
<html>
<head>
    <title>Techniekmarkt - Home</title>
    <link rel="stylesheet" href="main.css">
</head>
<body>
<div class="container">
    <h1 class="title">TECHNIEKMARKT</h1>
    <nav class="navbar">
        <ul>
            <li><a href="boeken.php">Boeken</a></li>
            <li><a href="laptops.php">Laptops</a></li>
            <li><a href="home.php">Home</a></li>
        </ul>
    </nav>
    <div class="content">
        <?php
        if (isset($_SESSION['username'])) {
            echo '<p class="welcome">Welcome, ' . $_SESSION['username'] . '</p>';
            echo '<form action="logout.php" method="POST"><button type="submit" name="logout">Logout</button></form>';
        } else {
            echo '<p class="welcome">Welcome to Techniekmarkt! Please register or login.</p>';
        }
        ?>
    </div>
    <div class="form-container">
        <?php
        if (!isset($_SESSION['username'])) {
            echo '<button onclick="window.location.href=\'login.php\'">Login</button>
            <button onclick="window.location.href=\'register.php\'">Register</button>';
        }
        ?>
    </div>
</div>
</body>
</html>
