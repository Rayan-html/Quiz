<?php
$mysql = new PDO('mysql:host=localhost;dbname=uneedit', 'root', '');

$stmt = $mysql->prepare("SELECT users.naam, users.telefoonnummer, users.email, users.address, requests.typemachine, requests.garantie, requests.datum, requests.omschrijving FROM `requests` INNER JOIN `users` ON requests.idvanklant = users.id");
$stmt->execute();

$requests = $stmt->fetchAll(PDO::FETCH_ASSOC);
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>Verzoeken</title>
    <link rel="stylesheet" href="verzoekenstyle.css">
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
<h1>Verzoeken</h1>
<div class="requests-container">
    <?php foreach ($requests as $request): ?>
        <div class="request">
            <div class="user-info">
                <h2>Klantgegevens</h2>
                <div class="Klantgegevens">
                    <p><strong>Naam:</strong> <?php echo $request['naam']; ?></p>
                    <p><strong>Telefoonnummer:</strong> <?php echo $request['telefoonnummer']; ?></p>
                    <p><strong>Email:</strong> <?php echo $request['email']; ?></p>
                    <p><strong>Adres:</strong> <?php echo $request['address']; ?></p>
                </div>
            </div>
            <div class="request-info">
                <h2>Verzoekdetails</h2>
                <p><strong>Omschrijving:</strong><br><?php echo $request['omschrijving']; ?></p>
                <div class="Klantgegevens">
                    <p><strong>Typemachine:</strong> <?php echo $request['typemachine']; ?></p>
                    <p><strong>Garantie:</strong> <?php echo $request['garantie']; ?></p>
                    <p><strong>Datum:</strong> <?php echo $request['datum']; ?></p>
                </div>
            </div>
        </div>
    <?php endforeach; ?>
</div>
</body>
</html>
