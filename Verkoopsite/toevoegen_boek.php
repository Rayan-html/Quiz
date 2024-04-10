<?php
include_once "gebruiker.php";
include_once "boek.php";
session_start();
ini_set('display_errors', 1);
error_reporting(E_ALL);

// Include de db_connect.php bestand
include_once "db_connect.php";

$error = "";

// Controleer of het formulier is ingediend
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    // Controleer of de gebruiker is ingelogd
    if (!isset($_SESSION["gebruiker"])) {
        // Stuur de gebruiker door naar de inlogpagina als deze niet is ingelogd
        header("Location: inloggen.php");
        exit();
    }

    // Haal de gebruikersgegevens op uit de sessie
    $gebruiker = $_SESSION["gebruiker"];
    // Haal de gebruikers-ID op via de methode getId van de Gebruiker klasse
    $gebruikers_id = $gebruiker->getId();

    // Haal de gegevens van het formulier op
    $titel = $_POST["titel"];
    $auteur = $_POST["auteur"];
    $beschrijving = $_POST["beschrijving"];
    $prijs = $_POST["prijs"];

    // Voeg de boekgegevens toe aan de database
    $query = "INSERT INTO boeken (gebruikers_id, titel, auteur, beschrijving, prijs) VALUES (?, ?, ?, ?, ?)";
    $stmt = $conn->prepare($query);
    $stmt->bind_param("isssd", $gebruikers_id, $titel, $auteur, $beschrijving, $prijs);
    if ($stmt->execute()) {
        // Als het toevoegen succesvol is, stuur de gebruiker door naar een succespagina of ergens anders
        header("Location: boeken_verkoop.php");
        exit();
    } else {
        // Als er een fout optreedt, toon een foutmelding
        $error = "Er is een fout opgetreden bij het toevoegen van het boek. Probeer het opnieuw.";
    }

    // Sluit de statement en verbinding
    $stmt->close();
    $conn->close();
}
?>

<!DOCTYPE html>
<html lang="nl">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Boek Toevoegen</title>
    <link rel="stylesheet" href="index.css">
</head>
<body>

<nav>
    <ul>
        <li><a href="index.php">Home</a></li>
        <li><a href="boeken_verkoop.php">Boeken</a></li>
        <li><a href="laptop_verkoop.php">Laptops</a></li>
        <li><a href="about.php">Over Ons</a></li>
        <li><a href="contact.php">Contact</a></li>
        <?php if (isset($_SESSION["gebruiker"])) { ?>
            <li style="float:right"><a href="?logout=1">Uitloggen</a></li>
        <?php } else { ?>
            <li style="float:right"><a href="inloggen.php">Inloggen</a></li>
            <li style="float:right"><a href="registreren.php">Registreren</a></li>
        <?php } ?>
    </ul>
    <?php if (isset($_SESSION["gebruiker"])) { ?>
        <div>Welkom, <?php echo $_SESSION["gebruiker"]->getGebruikersnaam(); ?></div>
    <?php } ?>
</nav>

<main>
    <h1>Boek Toevoegen</h1>
    <form method="post" action="<?php echo htmlspecialchars($_SERVER["PHP_SELF"]); ?>">
        <label for="titel">Titel:</label>
        <input type="text" id="titel" name="titel" required><br><br>
        <label for="auteur">Auteur:</label>
        <input type="text" id="auteur" name="auteur" required><br><br>
        <label for="beschrijving">Beschrijving:</label>
        <textarea id="beschrijving" name="beschrijving" rows="4" cols="50"></textarea><br><br>
        <label for="prijs">Prijs:</label>
        <input type="number" id="prijs" name="prijs" required><br><br>
        <input type="submit" value="Toevoegen">
    </form>
    <?php if(!empty($error)) { ?>
        <p><?php echo $error; ?></p>
    <?php } ?>
</main>

</body>
</html>
