<?php
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>Login</title>
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
        <h2 class="form-title">Login</h2>
        <form id="registration-form" action="auth.php" method="post">
            <input type="text" class="" name="Naam" id="Naam" placeholder="Naam"><br>
            <input type="text" class="" name="email" id="email" placeholder="Email"><br>
            <input type="password" class="" name="password" id="password" placeholder="Password"><br>
            <button type="submit" >Log in</button>
        </form>
    </div>
</main>
</body>
</html>

