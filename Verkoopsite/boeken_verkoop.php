<?php
include_once "Gebruiker.php";
session_start();
ini_set('display_errors', 1);
error_reporting(E_ALL);

// Controleer of de gebruiker is ingelogd
if (!isset($_SESSION["gebruiker"])) {
    header("Location: inloggen.php");
    exit();
}

// Include het db_connect.php bestand
include_once "db_connect.php";

// Haal alle boeken op uit de database
$query = "SELECT * FROM boeken";
$result = $conn->query($query);

// Sluit de database verbinding
$conn->close();
?>

<!DOCTYPE html>
<html lang="nl">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Geplaatste Boeken</title>
    <link rel="stylesheet" href="verkoop.css">
</head>
<body>

<nav>
    <ul>
        <li><a href="index.php">Home</a></li>
        <li><a href="boeken_verkoop.php">Boeken</a></li>
        <li><a href="laptop_verkoop.php">Laptops</a></li>
        <li><a href="about.php">Over Ons</a></li>
        <li><a href="contact.php">Contact</a></li>
        <li style="float:right"><a href="uitloggen.php">Uitloggen</a></li>
    </ul>
    <?php if (isset($_SESSION["gebruiker"])) { ?>
        <div>Welkom, <?php echo $_SESSION["gebruiker"]->getGebruikersnaam(); ?></div>
    <?php } ?>
</nav>

<main>
    <h1>Geplaatste Boeken</h1>
    <table>
        <tr>
            <th>Titel</th>
            <th>Auteur</th>
            <th>Beschrijving</th>
            <th>Prijs</th>
            <th>Actie</th>
        </tr>
        <?php
        // Loop door de resultaten en toon ze in een tabel
        while ($row = $result->fetch_assoc()) {
            ?>
            <tr>
                <td><?php echo $row["titel"]; ?></td>
                <td><?php echo $row["auteur"]; ?></td>
                <td><?php echo $row["beschrijving"]; ?></td>
                <td><?php echo $row["prijs"]; ?></td>
                <td>
                    <a href="bewerk_boek.php?id=<?php echo $row["id"]; ?>">Bewerken</a> |
                    <a href="verwijder_boek.php?id=<?php echo $row["id"]; ?>">Verwijderen</a>
                </td>
            </tr>
        <?php } ?>
    </table>

    <form method="post" action="toevoegen_boek.php">
        <!-- Voeg hier je formulierinvoervelden toe -->
        <input type="submit" value="Boek Toevoegen"> <!-- Dit is de knop om boeken toe te voegen -->
    </form>
</main>

</body>
</html>
