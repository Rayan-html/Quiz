<?php
include_once "gebruiker.php";
session_start();
ini_set('display_errors', 1);
error_reporting(E_ALL);

// Controleer of de gebruiker is ingelogd
if (!isset($_SESSION["gebruiker"])) {
    header("Location: inloggen.php");
    exit();
}
?>

<!DOCTYPE html>
<html lang="nl">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Geplaatste Laptops</title>
    <link rel="stylesheet" href="verkoop.css">
</head>
<body>

<?php include_once "navbar.php"; ?>

<main>
    <h1>Geplaatste Laptops</h1>
    <table>
        <tr>
            <th>Merk</th>
            <th>Model</th>
            <th>Specificaties</th>
            <th>Prijs</th>
            <th>Actie</th>
        </tr>
        <?php
        // Include het db_connect.php bestand
        include_once "db_connect.php";

        // Haal alle laptops op uit de database
        $query = "SELECT * FROM laptops";
        $result = $conn->query($query);

        // Loop door de resultaten en toon ze in een tabel
        while ($row = $result->fetch_assoc()) {
            ?>
            <tr>
                <td><?php echo $row["merk"]; ?></td>
                <td><?php echo $row["model"]; ?></td>
                <td><?php echo $row["specificaties"]; ?></td>
                <td><?php echo $row["prijs"]; ?></td>
                <td>
                    <a href="bewerk_laptop.php?id=<?php echo $row["id"]; ?>">Bewerken</a> |
                    <a href="verwijderen_laptop.php?id=<?php echo $row["id"]; ?>">Verwijderen</a>
                </td>
            </tr>
        <?php } ?>
    </table>

    <form method="post" action="toevoegen_laptop.php">
        <!-- Voeg hier je formulierinvoervelden toe -->
        <input type="submit" value="Laptop Toevoegen"> <!-- Dit is de knop om laptops toe te voegen -->
    </form>
</main>

</body>
</html>
