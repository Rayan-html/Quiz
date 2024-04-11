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

// Controleer of het laptop-ID is ingesteld via de URL-parameter
if (!isset($_GET["id"])) {
    header("Location: laptop_verkoop.php");
    exit();
}

// Laptop-ID ophalen uit de URL-parameter
$laptop_id = $_GET["id"];

// Include het db_connect.php bestand
include_once "db_connect.php";

// Query om de laptopgegevens op te halen
$query = "SELECT * FROM laptops WHERE id=?";
$stmt = $conn->prepare($query);
$stmt->bind_param("i", $laptop_id);
$stmt->execute();
$result = $stmt->get_result();

// Controleer of de laptop gevonden is
if ($result->num_rows === 0) {
    echo "Laptop niet gevonden.";
    exit();
}

// Haal de laptopgegevens op
$laptop = $result->fetch_assoc();

// Sluit de statement
$stmt->close();

// Verwijder de laptop als bevestigd
if ($_SERVER["REQUEST_METHOD"] == "POST" && isset($_POST["confirm_delete"]) && $_POST["confirm_delete"] == "Ja") {
    $delete_query = "DELETE FROM laptops WHERE id=?";
    $delete_stmt = $conn->prepare($delete_query);
    $delete_stmt->bind_param("i", $laptop_id);
    if ($delete_stmt->execute()) {
        // Laptop succesvol verwijderd
        header("Location: laptop_verkoop.php");
        exit();
    } else {
        echo "Er is een fout opgetreden bij het verwijderen van de laptop.";
    }
}

// Sluit de verbinding
$conn->close();
?>

<!DOCTYPE html>
<html lang="nl">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Laptop Verwijderen</title>
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
    <h1>Laptop Verwijderen</h1>
    <p>Weet je zeker dat je de volgende laptop wilt verwijderen?</p>
    <table>
        <tr>
            <th>Merk</th>
            <th>Model</th>
            <th>Specificaties</th>
            <th>Prijs</th>
        </tr>
        <tr>
            <td><?php echo $laptop["merk"]; ?></td>
            <td><?php echo $laptop["model"]; ?></td>
            <td><?php echo $laptop["specificaties"]; ?></td>
            <td><?php echo $laptop["prijs"]; ?></td>
        </tr>
    </table>
    <form method="post" action="">
        <input type="hidden" name="confirm_delete" value="Ja">
        <input type="submit" value="Ja, verwijder deze laptop">
        <a href="laptop_verkoop.php">Nee, ga terug</a>
    </form>
</main>

</body>
</html>
