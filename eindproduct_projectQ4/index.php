<?php
include_once "Gebruiker.php";
session_start();


// Controleer of de gebruiker op "Uitloggen" heeft geklikt
if (isset($_GET['logout'])) {
    // Vernietig de sessie
    session_destroy();
    // Verwijder de gebruiker uit de sessievariabelen
    unset($_SESSION["gebruiker"]);
}

// Controleer of de gebruiker is ingelogd
$gebruiker = isset($_SESSION["gebruiker"]) ? $_SESSION["gebruiker"] : null;

// Haal de gebruikersnaam op, indien ingelogd
$gebruikersnaam = $gebruiker ? $gebruiker->getGebruikersnaam() : '';

// Inclusie van Gebruiker.php

?>

<!DOCTYPE html>
<html lang="nl">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Verkoopplatform</title>
    <link rel="stylesheet" href="index.css">
</head>
<body>

<nav>
    <ul>
        <li><a href="index.php">Home</a></li>
        <li><a href="boeken_verkoop.php">Boeken</a></li>
        <li><a href="laptop_verkoop.php">Laptops</a></li>
        <li><a href="about_us.php">Over Ons</a></li>
        <li><a href="contact.php">Contact</a></li>
        <?php if (!empty($gebruikersnaam)) { ?>
            <li style="float:right"><a href="?logout=1">Uitloggen</a></li>
        <?php } else { ?>
            <li style="float:right"><a href="inloggen.php">Inloggen</a></li>
            <li style="float:right"><a href="registreren.php">Registreren</a></li>
        <?php } ?>
    </ul>
    <?php if (!empty($gebruikersnaam)) { ?>
        <div style="float:right;">Welkom, <?php echo $gebruikersnaam; ?></div>
    <?php } ?>
</nav>


<main>
    <h1>Welkom <?php echo $gebruikersnaam ? $gebruikersnaam : "Gast"; ?>!</h1>
    <!-- Hier komt de inhoud van de homepagina -->
</main>

</body>
</html>
