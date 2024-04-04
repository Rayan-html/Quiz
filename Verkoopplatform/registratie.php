<!DOCTYPE html>
<html lang="nl">
<head>
    <meta charset="UTF-8">
    <title>Registratie</title>
    <link rel="stylesheet" href="registratie.css">
</head>
<body>
<div class="container">
    <h1>Registreer voor een account</h1>
    <form action="<?php echo htmlspecialchars($_SERVER["PHP_SELF"]); ?>" method="post" class="registratie-form">
        <label for="email">E-mailadres:</label>
        <input type="email" id="email" name="email" required>
        <br><br>
        <label for="geboortedatum">Geboortedatum:</label>
        <input type="date" id="geboortedatum" name="geboortedatum" required>
        <br><br>
        <label for="postcode">Postcode:</label>
        <input type="text" id="postcode" name="postcode" required>
        <br><br>
        <label for="straatnaam_huisnummer">Straatnaam en huisnummer:</label>
        <input type="text" id="straatnaam_huisnummer" name="straatnaam_huisnummer" required>
        <br><br>
        <label for="wachtwoord">Wachtwoord:</label>
        <input type="password" id="wachtwoord" name="wachtwoord" required>
        <br><br>
        <label for="wachtwoord_bevestiging">Wachtwoord bevestigen:</label>
        <input type="password" id="wachtwoord_bevestiging" name="wachtwoord_bevestiging" required>
        <br><br>
        <input type="submit" value="Registreren">
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
    function hash_wachtwoord($wachtwoord) {
        return password_hash($wachtwoord, PASSWORD_DEFAULT);
    }

    function valideer_wachtwoord($wachtwoord, $wachtwoord_bevestiging) {
        if ($wachtwoord !== $wachtwoord_bevestiging) {
            throw new Exception("De wachtwoorden komen niet overeen.");
        }
    }

    function valideer_email($email) {
        if (!filter_var($email, FILTER_VALIDATE_EMAIL)) {
            throw new Exception("Ongeldig e-mailadres.");
        }
    }

    // Verwerk formulierdata
    if ($_SERVER["REQUEST_METHOD"] == "POST") {
        $email = $_POST["email"];
        $geboortedatum = $_POST["geboortedatum"];
        $postcode = $_POST["postcode"];
        $straatnaam_huisnummer = $_POST["straatnaam_huisnummer"];
        $wachtwoord = $_POST["wachtwoord"];
        $wachtwoord_bevestiging = $_POST["wachtwoord_bevestiging"];

        // Valideer data
        try {
            valideer_email($email);
            valideer_wachtwoord($wachtwoord, $wachtwoord_bevestiging);

            // Hashed wachtwoord genereren
            $hashed_wachtwoord = hash_wachtwoord($wachtwoord);

            // SQL query voorbereiden en uitvoeren om gebruiker toe te voegen
            $sql = "INSERT INTO gebruikers (email, geboortedatum, postcode, straatnaam_huisnummer, wachtwoord)
                VALUES (?, ?, ?, ?, ?)";
            $stmt = $conn->prepare($sql);
            $stmt->execute([$email, $geboortedatum, $postcode, $straatnaam_huisnummer, $hashed_wachtwoord]);

            // Controleer of het toevoegen gelukt is
            if ($stmt->rowCount() === 1) {
                echo "Uw account is succesvol geregistreerd! U kunt nu inloggen.";
            } else {
                throw new PDOException("Er is een fout opgetreden bij het registreren van uw account.");
            }
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
