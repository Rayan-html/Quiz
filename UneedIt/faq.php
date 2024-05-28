<?php ?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>FAQ</title>
    <link rel="stylesheet" href="style.css">

</head>
<body>
<nav id="navbar">
    <div id="logonav">
        <img src="Photos/cropped-logo%20UNEED-IT.png">
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
<div class="faq-container">
    <div class="question" onclick="toggleAnswer(1)">What is Lorem Ipsum?</div>
    <div class="answer" id="answer1">
        Lorem Ipsum is simply dummy text of the printing and typesetting industry. Lorem Ipsum has been the industry's standard dummy text ever since the 1500s.
    </div>
    <div class="question" onclick="toggleAnswer(2)">Why do we use it?</div>
    <div class="answer" id="answer2">
        It is a long established fact that a reader will be distracted by the readable content of a page when looking at its layout.
    </div>
    <div class="question" onclick="toggleAnswer(3)">Where does it come from?</div>
    <div class="answer" id="answer3">
        Contrary to popular belief, Lorem Ipsum is not simply random text. It has roots in a piece of classical Latin literature from 45 BC.
    </div>
    <div class="question" onclick="toggleAnswer(4)">Is it safe to use Lorem Ipsum?</div>
    <div class="answer" id="answer4">
        Yes, Lorem Ipsum is safe to use and has been used as placeholder text in the printing and typesetting industry for centuries.
    </div>
    <div class="question" onclick="toggleAnswer(5)">Is it safe to use Lorem Ipsum?</div>
    <div class="answer" id="answer5">
        Yes, Lorem Ipsum is safe to use and has been used as placeholder text in the printing and typesetting industry for centuries.
    </div>
    <div class="question" onclick="toggleAnswer(6)">Is it safe to use Lorem Ipsum?</div>
    <div class="answer" id="answer6">
        Yes, Lorem Ipsum is safe to use and has been used as placeholder text in the printing and typesetting industry for centuries.
    </div>
</div>
<script>
    function toggleAnswer(id) {
        var answer = document.getElementById('answer' + id);
        answer.classList.toggle('show');
    }
</script>
</body>
</html>
