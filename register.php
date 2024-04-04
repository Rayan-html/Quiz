<!--<!DOCTYPE html>-->
<!--<html>-->
<!--<head>-->
<!--    <title>Register - Techniekmarkt</title>-->
<!--    <link rel="stylesheet" type="text/css" href="main.css">-->
<!--</head>-->
<!--<body>-->
<!--<nav class="navbar">-->
<!--    <ul>-->
<!--        <li><a href="bibliotheek.php">Boeken</a></li>-->
<!--        <li><a href="contact.php">Laptops</a></li>-->
<!--        <li><a href="home.php">Home</a></li>-->
<!--    </ul>-->
<!--</nav>-->
<!--<div class="register_form">-->
<!--    <h2>Register</h2>-->
<!--    <form action="register_handler.php" method="POST">-->
<!--        <label for="email">Email:</label>-->
<!--        <input type="email" id="email" name="email" required>-->
<!---->
<!--        <label for="username">Username:</label>-->
<!--        <input type="text" id="username" name="username" required>-->
<!---->
<!--        <label for="password">Password:</label>-->
<!--        <input type="password" id="password" name="password" required>-->
<!---->
<!--        <label for="confirm_password">Confirm Password:</label>-->
<!--        <input type="password" id="confirm_password" name="confirm_password" required>-->
<!---->
<!--        <input type="submit" value="Register">-->
<!--    </form>-->
<!--</div>-->
<!--</body>-->
<!--</html>-->

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Register - Techniekmarkt</title>
    <link rel="stylesheet" href="main.css">
</head>
<body>
<nav class="navbar">
    <ul>
        <li><a href="bibliotheek.php">Boeken</a></li>
        <li><a href="contact.php">Laptops</a></li>
        <li><a href="home.php">Home</a></li>
    </ul>
</nav>
<div class="container">
    <h2 class="title">Register</h2>
    <div class="form-container">
        <form action="register_handler.php" method="POST">
            <div class="form-group">
                <label for="email">Email:</label>
                <input type="email" id="email" name="email" required>
            </div>

            <div class="form-group">
                <label for="username">Username:</label>
                <input type="text" id="username" name="username" required>
            </div>

            <div class="form-group">
                <label for="password">Password:</label>
                <input type="password" id="password" name="password" required>
            </div>

            <div class="form-group">
                <label for="confirm_password">Confirm Password:</label>
                <input type="password" id="confirm_password" name="confirm_password" required>
            </div>

            <button type="submit">Register</button>
        </form>
    </div>
</div>
</body>
</html>

