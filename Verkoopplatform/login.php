<!DOCTYPE html>
<html lang="nl">
<head>
    <meta charset="UTF-8">
    <title>Inloggen</title>
    <link rel="stylesheet" href="login.css">
</head>
<body>
<div class="container">
    <h1>Inloggen</h1>
    <form action="<?php echo htmlspecialchars($_SERVER["PHP_SELF"]); ?>" method="post" class="login-form">
        <label for="email">E-mailadres:</label>
        <input type="email" id="email" name="email" required>
        <br><br>
        <label for="wachtwoord">Wachtwoord:</label>
        <input type="password" id="wachtwoord" name="wachtwoord" required>
        <br><br>
        <input type="submit" value="Inloggen">
    </form>
    <?php
    // Databaseconfiguratie
    $servername = "localhost";
    $username = "root"; // Vul je gebruikersnaam in voor de database
    $password = "root"; // Vul je wachtwoord in voor de database
    $database = "verkoopplatform"; // Vul de naam van je database in

    // Variabele voor foutmelding
    $foutmelding = "";

    // PDO connectie
    try {
        $conn = new PDO("mysql:host=$servername;dbname=$database", $username, $password);
        $conn->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
    } catch (PDOException $e) {
        $foutmelding = "Connectie met database mislukt: " . $e->getMessage();
    }

    // Functies
    function valideer_email($email) {
        if (!filter_var($email, FILTER_VALIDATE_EMAIL)) {
            throw new Exception("Ongeldig e-mailadres.");
        }
    }

    // Verwerk formulierdata
    if ($_SERVER["REQUEST_METHOD"] == "POST") {
        $email = $_POST["email"];
        $wachtwoord = $_POST["wachtwoord"];

        // Valideer data
        try {
            valideer_email($email);

            // SQL query voorbereiden om gebruiker te zoeken
            $sql = "SELECT * FROM gebruikers WHERE email = ?";
            $stmt = $conn->prepare($sql);
            $stmt->execute([$email]);

            // Controleer of de gebruiker bestaat
            $user = $stmt->fetch();
            if (!$user) {
                throw new Exception("Gebruiker met dit e-mailadres is niet gevonden.");
            }

            // Wachtwoord controleren
            if (!password_verify($wachtwoord, $user["wachtwoord"])) {
                throw new Exception("Ongeldig wachtwoord.");
            }

            // Inloggen gelukt! (Sessie starten, etc.)
            echo "U bent succesvol ingelogd!";
        } catch (Exception $e) {
            $foutmelding = "Foutmelding: " . $e->getMessage();
        }
    }
    ?>
    <p class="foutmelding">
        <?php echo $foutmelding; ?>
    </p>
</div>
</body>
</html>
