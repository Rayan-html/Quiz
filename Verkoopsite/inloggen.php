<?php
session_start();
include_once "Gebruiker.php"; // Voeg dit toe om de Gebruiker-klasse te includen
ini_set('display_errors', 1);
error_reporting(E_ALL);

include_once "db_connect.php";

$error = ""; // Initieer de variabele voor foutmeldingen

// Controleer of de gebruiker al ingelogd is
if(isset($_SESSION["gebruiker"])) {
    // Als de gebruiker al ingelogd is, kan hij doorgaan naar de laptop_verkoop.php pagina
    header("Location: laptop_verkoop.php");
    exit();
}

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    // Verkrijg gebruikersnaam en wachtwoord uit het formulier
    $gebruikersnaam = $_POST["gebruikersnaam"];
    $wachtwoord = $_POST["wachtwoord"];

    // Query om gebruiker op te halen op basis van gebruikersnaam
    $query = "SELECT id, gebruikersnaam, wachtwoord FROM gebruikers WHERE gebruikersnaam = ?";
    $stmt = $conn->prepare($query);
    $stmt->bind_param("s", $gebruikersnaam);
    $stmt->execute();
    $result = $stmt->get_result();

    // Controleer of er een rij is gevonden
    if ($result->num_rows == 1) {
        // Haal de gebruikersgegevens op
        $row = $result->fetch_assoc();

        // Controleer of het ingevoerde wachtwoord overeenkomt met het gehashte wachtwoord in de database
        if (password_verify($wachtwoord, $row["wachtwoord"])) {
            // Maak een nieuwe Gebruiker instantie aan
            $gebruiker = new Gebruiker($row["id"], $row["gebruikersnaam"], $row["wachtwoord"], $row["email"], $row["adres"]);

            // Sla de gebruiker op in de sessie
            $_SESSION["gebruiker"] = $gebruiker;

            // Stuur de gebruiker door naar de indexpagina
            header("Location: index.php");
            exit();
        } else {
            // Toon foutmelding als het wachtwoord onjuist is
            $error = "Ongeldige gebruikersnaam of wachtwoord.";
        }
    } else {
        // Toon foutmelding als de gebruiker niet gevonden is
        $error = "Gebruiker niet gevonden.";
    }

    // Sluit de statement
    $stmt->close();
}
?>
<!DOCTYPE html>
<html lang="nl">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Inloggen</title>
    <link rel="stylesheet" href="login.css">
</head>
<body>
<nav>
    <ul>
        <li><a href="index.php">Home</a></li>
        <li><a href="boeken_verkoop.php">Boeken</a></li>
        <li><a href="laptop_verkoop.php">Laptops</a></li>
        <li><a href="about.php">Over Ons</a></li>
        <li><a href="contact.php">Contact</a></li>
        <?php if (!isset($_SESSION["gebruiker"])) { ?>
            <li style="float:right"><a href="inloggen.php">Inloggen</a></li>
            <li style="float:right"><a href="registreren.php">Registreren</a></li>
        <?php } ?>
    </ul>
    <?php if (isset($_SESSION["gebruiker"])) { ?>
        <div>Welkom, <?php echo $_SESSION["gebruiker"]->getGebruikersnaam(); ?></div>
    <?php } ?>
</nav>

<main>
    <h1>Inloggen</h1>
    <form method="post" action="<?php echo htmlspecialchars($_SERVER["PHP_SELF"]); ?>">
        <label for="gebruikersnaam">Gebruikersnaam:</label>
        <input type="text" id="gebruikersnaam" name="gebruikersnaam" required><br><br>
        <label for="wachtwoord">Wachtwoord:</label>
        <input type="password" id="wachtwoord" name="wachtwoord" required><br><br>
        <input type="submit" value="Inloggen">
    </form>
    <?php if(!empty($error)) { ?>
        <p><?php echo $error; ?></p>
    <?php } ?>
    <p>Heb je nog geen account? <a href="registreren.php">Registreer hier</a>.</p>
</main>

</body>
</html>
