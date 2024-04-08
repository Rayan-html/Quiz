<?php
// Start de sessie
session_start();

// Controleer of de gebruiker op "Uitloggen" heeft geklikt
if (isset($_GET['logout'])) {
    // Vernietig de sessie
    session_destroy();
    // Verwijder de gebruiker uit de sessievariabelen
    unset($_SESSION["gebruiker"]);
}

// Andere code gaat hier verder

// Controleer of de gebruiker is ingelogd
$gebruikersnaam = isset($_SESSION["gebruiker"]) ? $_SESSION["gebruiker"] : '';

// Inclusie van Gebruiker.php
include_once "Gebruiker.php";
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

<?php include_once "navbar.php"; ?>

<main>
    <h1>Welkom <?php echo $gebruikersnaam ? $gebruikersnaam : "Gast"; ?>!</h1>
    <!-- Hier komt de inhoud van de homepagina -->
</main>

</body>
</html>
