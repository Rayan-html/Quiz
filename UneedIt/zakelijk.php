<!--<!DOCTYPE html>-->
<!--<html lang="en">-->
<!--<head>-->
<!--    <meta charset="UTF-8">-->
<!--    <title>Zakelijk</title>-->
<!--    <link rel="stylesheet" href="zakelijkstyle.css">-->
<!--    <script src="zakelijkscript.js"></script>-->
<!--</head>-->
<!--<body>-->
<!--<nav id="navbar">-->
<!--    <div id="logonav">-->
<!--        <img src="Photos/cropped-logo%20UNEED-IT.png">-->
<!--    </div>-->
<!--    <div id="logoptions">-->
<!--        <ul>-->
<!--            <li class="redc"> <a href="home.html">Home</a> </li>-->
<!--            <li class="bluec"> <a href="OverOns.html">Over ons </a></li>-->
<!--            <li class="redc"> <a href="service.html">Service </a></li>-->
<!--            <li class="bluec" > <a href="zakelijk.html">Zakelijk </a></li>-->
<!--            <li class="redc"> <a href="faq.html">Faq </a> </li>-->
<!--            <li class="bluec"><a href="Bezorgdiensten.html"> Bezorgdiensten </a></li>-->
<!--            <li class="redc"> <a href="account.php">Account </a> </li>-->
<!--        </ul>-->
<!--    </div>-->
<!--</nav>-->
<!--<main id="mainZakelijk">-->
<!--    <div class="block-text">-->
<!--        <h1>Welkom!</h1>-->
<!--        <p>We zijn blij om u te kunnen helpen. Hoe kunnen wij assisteren?</p>-->
<!---->
<!--        <button onclick="checkLoginStatus()">Ontvang hulp</button>-->
<!--        <button id="verzoekenBtn" style="display: --><?php //echo isset($_SESSION['is_admin']) && $_SESSION['is_admin'] ? 'block' : 'none'; ?><!--" onclick="viewRequests()">Verzoeken bekijken</button>-->
<!--    </div>-->
<!--</main>-->
<!--<script>-->
<!--    function checkLoginStatus() {-->
<!--        let xhr = new XMLHttpRequest();-->
<!--        xhr.open("GET", "checklogstatus.php", true);-->
<!--        xhr.onload = function() {-->
<!--            if (xhr.status == 200) {-->
<!--                if (xhr.responseText.trim() === "logged_in") {-->
<!---->
<!--                    let roleCheckXHR = new XMLHttpRequest();-->
<!--                    roleCheckXHR.open("GET", "checkUserRole.php", true);-->
<!--                    roleCheckXHR.onload = function() {-->
<!--                        if (roleCheckXHR.status == 200) {-->
<!--                            if (roleCheckXHR.responseText.trim() === "admin") {-->
<!--                                document.getElementById("verzoekenBtn").style.display = "block";-->
<!--                            } else {-->
<!--                                document.getElementById("verzoekenBtn").style.display = "none";-->
<!--                            }-->
<!--                        }-->
<!--                    };-->
<!--                    roleCheckXHR.send();-->
<!--                } else {-->
<!--                    window.location.href = "login_or_signup.html";-->
<!--                }-->
<!--            }-->
<!--        };-->
<!--        xhr.send();-->
<!--    }-->
<!--</script>-->
<!--</body>-->
<!--</html>-->


<?php
session_start();
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>Zakelijk</title>
    <link rel="stylesheet" href="zakelijkstyle.css">
    <script src="zakelijkscript.js"></script>
</head>
<body>
<nav id="navbar">
    <div id="logonav">
        <img src="Photos/cropped-logo%20UNEED-IT.png" alt="Logo">
    </div>
    <div id="logoptions">
        <ul>
            <li class="redc"> <a href="home.php">Home</a> </li>
            <li class="bluec"> <a href="OverOns.php">Over ons </a></li>
            <li class="redc"> <a href="Service.php">Service </a></li>
            <li class="bluec" > <a href="zakelijk.php">Zakelijk </a></li>
            <li class="redc"> <a href="faq.php">Faq </a> </li>
            <li class="bluec"><a href="Bezorgdiensten.php"> Bezorgdiensten </a></li>
            <li class="redc"> <a href="account.php">Account </a> </li>
        </ul>
    </div>
</nav>
<main id="mainZakelijk">
    <div class="block-text">
        <h1>Welkom!</h1>
        <p>We zijn blij om u te kunnen helpen. Hoe kunnen wij assisteren?</p>
        <div class="buttons">
            <button onclick="checkLoginStatus()">Ontvang hulp</button>
            <button id="verzoekenBtn" style="display: <?php echo isset($_SESSION['is_admin']) && $_SESSION['is_admin'] ? 'block' : 'none'; ?>;" onclick="viewRequests()">Verzoeken bekijken</button>
        </div>
    </div>
</main>
<script>
    function checkLoginStatus() {
        let xhr = new XMLHttpRequest();
        xhr.open("GET", "checklogstatus.php", true);
        xhr.onload = function() {
            if (xhr.status == 200) {
                if (xhr.responseText.trim() === "logged_in") {
                    let roleCheckXHR = new XMLHttpRequest();
                    roleCheckXHR.open("GET", "checkUserRole.php", true);
                    roleCheckXHR.onload = function() {
                        if (roleCheckXHR.status == 200) {
                            if (roleCheckXHR.responseText.trim() === "admin") {
                                document.getElementById("verzoekenBtn").style.display = "block";
                            } else {
                                document.getElementById("verzoekenBtn").style.display = "none";
                            }
                        }
                    };
                    roleCheckXHR.send();
                } else {
                    window.location.href = "login_or_signup.php";
                }
            }
        };
        xhr.send();
    }

    window.onload = function() {
        checkLoginStatus();
    };

    function viewRequests() {
        window.location.href = "verzoeken.php";
    }
</script>
</body>
</html>
