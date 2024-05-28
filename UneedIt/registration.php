<?php ?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>Title</title>
    <link rel="stylesheet" href="registrationstyle.css">
</head>
<body>
<nav id="navbar">
    <div id="logonav">
        <img src="Photos/cropped-logo%20UNEED-IT.png">
    </div>
    <div id="logoptions">
        <ul>
            <li class="redc"> <a href="home.html">Home</a> </li>
            <li class="bluec"> <a href="OverOns.html">Over ons </a></li>
            <li class="redc"> <a href="service.html">Service </a></li>
            <li class="bluec" > <a href="zakelijk.html">Zakelijk </a></li>
            <li class="redc"> <a href="faq.html">Faq </a> </li>
            <li class="bluec"><a href="Bezorgdiensten.html"> Bezorgdiensten </a></li>
            <li class="redc"> <a href="account.php">Account </a> </li>
        </ul>
    </div>
</nav>
<main class="main-content">
    <div class="form-container">
        <h1 class="form-title">Registration</h1>
        <form id="registration-form" action="check.php" method="post">
            <label for="naam">Name:</label>
            <input type="text" name="naam" id="naam" placeholder="Name" required><br>
            <label for="telefoonnummer">Phone:</label>
            <input type="text" name="telefoonnummer" id="telefoonnummer" placeholder="Phone Number" required><br>
            <label for="email">Email:</label>
            <input type="email" name="email" id="email" placeholder="Email" required><br>
            <label for="address">Address:</label>
            <input type="text" name="address" id="address" placeholder="Address" required><br>
            <label for="password">Password:</label>
            <input type="password" name="password" id="password" placeholder="Password" required><br>
            <button type="submit">Register</button>
        </form>
    </div>
</main>
</body>
</html>

