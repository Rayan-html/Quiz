<?php
// Start de sessie
session_start();

// Controleer of de gebruiker niet is ingelogd
if (!isset($_SESSION["gebruiker"])) {
    // Als de gebruiker niet is ingelogd, stuur hem/haar door naar de inlogpagina
    header("Location: inloggen.php");
    exit();
}

// Include het db_connect.php bestand
include_once "db_connect.php";

// Query om alle boeken op te halen
$query = "SELECT * FROM boeken";
$result = $conn->query($query);

// Haal de gebruikers-ID op uit de sessie
$gebruiker = $_SESSION["gebruiker"];
$gebruikers_id = $gebruiker->getId();

// Sluit de verbinding
$conn->close();
?>

<!DOCTYPE html>
<html lang="nl">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Boeken</title>
    <link rel="stylesheet" href="verkoop.css">
</head>
<body>

<?php include_once "navbar.php";


<main>
    <h1>Boeken</h1>
    <table>
        <thead>
        <tr>
            <th>Titel</th>
            <th>Auteur</th>
            <th>Beschrijving</th>
            <th>Prijs</th>
            <th>Actie</th>
        </tr>
        </thead>
        <tbody>
        <?php
        // Loop door elk boek en toon de gegevens in een rij van de tabel
        while ($row = $result->fetch_assoc()) {
            echo "<tr>";
            echo "<td>" . $row["titel"] . "</td>";
            echo "<td>" . $row["auteur"] . "</td>";
            echo "<td>" . $row["beschrijving"] . "</td>"; // Accessing "beschrijving" key
            echo "<td>" . $row["prijs"] . "</td>";
            echo "<td>";
            if ($row["gebruikers_id"] == $gebruikers_id) {
                // Toon een link om het boek direct te verwijderen zonder bevestiging
                echo "<a href='verwijder_boek.php?id=" . $row["id"] . "'>Verwijder</a>";
                echo " | ";
                // Voeg hier een link toe om het boek te bewerken
                echo "<a href='bewerk_boek.php?id=" . $row["id"] . "'>Bewerk</a>";
            }
            echo "</td>";
            echo "</tr>";
        }
        ?>
        </tbody>
    </table>
</main>

</body>
</html>
