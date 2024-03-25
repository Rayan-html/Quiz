<!DOCTYPE html>
<html>
<head>
    <title>Register - Techniekmarkt</title>
    <link rel="stylesheet" type="text/css" href="main.css">
</head>
<body>
<nav class="navbar">
    <ul>
        <li><a href="bibliotheek.php">Boeken</a></li>
        <li><a href="contact.php">Laptops</a></li>
        <li><a href="home.php">Home</a></li>
    </ul>
</nav>
<div class="register_form">
    <h2>Register</h2>
    <form action="register_handler.php" method="POST">
        <label for="email">Email:</label>
        <input type="email" id="email" name="email" required>

        <label for="username">Username:</label>
        <input type="text" id="username" name="username" required>

        <label for="password">Password:</label>
        <input type="password" id="password" name="password" required>

        <label for="confirm_password">Confirm Password:</label>
        <input type="password" id="confirm_password" name="confirm_password" required>

        <input type="submit" value="Register">
    </form>
</div>
</body>
</html>
