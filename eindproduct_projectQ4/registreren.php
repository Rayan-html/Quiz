<?php
include_once "gebruiker.php"; // Inclusief gebruiker.php bestand
include_once "db_connect.php"; // Inclusief db_connect.php bestand
ini_set('display_errors', 1); // Zet weergave van fouten aan
error_reporting(E_ALL); // Rapporteer alle fouten

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    // Als het verzoekstype POST is, verwerk dan het formulier

    $gebruikersnaam = $_POST["gebruikersnaam"];
    $wachtwoord = password_hash($_POST["wachtwoord"], PASSWORD_DEFAULT); // Wachtwoord hashen met bcrypt
    $email = $_POST["email"];
    $adres = $_POST["adres"];

    // Voorbereiden en uitvoeren van de query om een nieuwe gebruiker toe te voegen aan de database
    $query = "INSERT INTO gebruikers (gebruikersnaam, wachtwoord, email, adres) VALUES (?, ?, ?, ?)";
    $stmt = $conn->prepare($query);
    $stmt->bind_param("ssss", $gebruikersnaam, $wachtwoord, $email, $adres);
    $stmt->execute();

    if ($stmt->affected_rows > 0) {
        // Als er rijen zijn beïnvloed, betekent dit dat de gebruiker met succes is toegevoegd aan de database

        // Maak een Gebruiker object zonder de id parameter
        $gebruiker = new Gebruiker(null, $gebruikersnaam, $wachtwoord, $email, $adres);

        // Sla de gebruiker op in de sessie
        $_SESSION["gebruiker"] = $gebruiker;

        // Stuur de gebruiker door naar de startpagina
        header("Location: index.php");
        exit(); // Stop verdere uitvoering van het script
    } else {
        // Als er geen rijen zijn beïnvloed, is er een fout opgetreden bij het toevoegen van de gebruiker aan de database
        $error = "Er is een fout opgetreden tijdens de registratie. Probeer het opnieuw.";
    }

    $stmt->close(); // Sluit de prepared statement
}
?>

<!DOCTYPE html>
<html lang="nl">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Registreren</title>
    <link rel="stylesheet" href="registreren.css">
</head>
<body>
<nav>
    <ul>
        <li><a href="index.php">Home</a></li>
        <li><a href="boeken_verkoop.php">Boeken</a></li>
        <li><a href="laptop_verkoop.php">Laptops</a></li>
        <li><a href="about.php">Over Ons</a></li>
        <li><a href="contact.php">Contact</a></li>
        <?php if (!empty($gebruikersnaam)) { ?>
            <li style="float:right"><a href="?logout=1">Uitloggen</a></li>
        <?php } else { ?>
            <li style="float:right"><a href="inloggen.php">Inloggen</a></li>
            <li style="float:right"><a href="registreren.php">Registreren</a></li>
        <?php } ?>
    </ul>
    <?php if (!empty($gebruikersnaam)) { ?>
        <div>Welkom, <?php echo $gebruikersnaam; ?></div>
    <?php } ?>
</nav>

<main>
    <div class="login-box">
        <h2>Registreren</h2>
        <form method="post" action="<?php echo htmlspecialchars($_SERVER["PHP_SELF"]); ?>">
            <div class="user-box">
                <input type="text" name="gebruikersnaam" required="">
                <label>Gebruikersnaam</label>
            </div>
            <div class="user-box">
                <input type="password" name="wachtwoord" required="">
                <label>Wachtwoord</label>
            </div>
            <div class="user-box">
                <input type="email" name="email" required="">
                <label>Email</label>
            </div>
            <div class="user-box">
                <input type="text" name="adres" required="">
                <label>Adres</label>
            </div>
            <button type="submit">
                <span></span>
                <span></span>
                <span></span>
                <span></span>
                Registreren
            </button>
        </form>
        <?php if (isset($error)) { ?>
            <p><?php echo $error; ?></p>
        <?php } ?>
    </div>
</main>

</body>
</html>
