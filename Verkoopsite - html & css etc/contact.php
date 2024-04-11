<?php

// Start de sessie
session_start();

// Controleer of de gebruiker niet is ingelogd
if (!isset($_SESSION["gebruiker"])) {
    // Als de gebruiker niet is ingelogd, stuur hem/haar door naar de inlogpagina
    header("Location: inloggen.php");
    exit();
}

?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
    <link rel="stylesheet" href="contact.css">

</head>
<body>

    <div id="center">
    <a href="index.html" class="title">ENGINEER</a>
</div>


<div class="container">
    <h2>Contact Us</h2>
    <form action="#" method="post">
        <div class="form-group">
            <label for="name">Name:</label>
            <input type="text" id="name" name="name" required>
        </div>
        <div class="form-group">
            <label for="email">Email:</label>
            <input type="email" id="email" name="email" required>
        </div>
        <div class="form-group">
            <label for="message">Message:</label>
            <textarea id="message" name="message" required></textarea>
        </div>
        <div class="form-group">
            <div class="new">
            <button type="submit">Submit</button>
        </div>
        </div>
    </form>
</div>


</body>
</html>
