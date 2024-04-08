<?php
include_once "boek.php"; // Inclusief het bestand met de boekklasse
session_start(); // Start de sessie
ini_set('display_errors', 1);
error_reporting(E_ALL);

// Controleer of de gebruiker is ingelogd
if (!isset($_SESSION["gebruiker"])) {
    header("Location: inloggen.php");
    exit();
}

// Controleer of het boek-ID is ingesteld via de URL-parameter
if (!isset($_GET["id"])) {
    header("Location: boeken_verkoop.php");
    exit();
}

// Boek-ID ophalen uit de URL-parameter
$boek_id = $_GET["id"];

// Include het db_connect.php bestand
include_once "db_connect.php";

// Query om de boekgegevens op te halen
$query = "SELECT * FROM boeken WHERE id=?";
$stmt = $conn->prepare($query);
$stmt->bind_param("i", $boek_id);
$stmt->execute();
$result = $stmt->get_result();

// Controleer of het boek gevonden is
if ($result->num_rows === 0) {
    echo "Boek niet gevonden.";
    exit();
}

// Haal de boekgegevens op
$boek = $result->fetch_assoc();

// Sluit de statement
$stmt->close();

// Verwijder het boek als bevestigd
if ($_SERVER["REQUEST_METHOD"] == "POST" && isset($_POST["confirm_delete"]) && $_POST["confirm_delete"] == "Ja") {
    $delete_query = "DELETE FROM boeken WHERE id=?";
    $delete_stmt = $conn->prepare($delete_query);
    $delete_stmt->bind_param("i", $boek_id);
    if ($delete_stmt->execute()) {
        // Boek succesvol verwijderd
        header("Location: boeken_verkoop.php");
        exit();
    } else {
        echo "Er is een fout opgetreden bij het verwijderen van het boek.";
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
    <title>Boek Verwijderen</title>
    <link rel="stylesheet" href="styles.css">
</head>
<body>

<?php include_once "navbar.php"; ?>

<main>
    <h1>Boek Verwijderen</h1>
    <p>Weet je zeker dat je het volgende boek wilt verwijderen?</p>
    <table>
        <tr>
            <th>Titel</th>
            <th>Auteur</th>
            <th>Genre</th>
            <th>Prijs</th>
        </tr>
        <tr>
            <td><?php echo $boek["titel"]; ?></td>
            <td><?php echo $boek["auteur"]; ?></td>
            <td><?php echo $boek["beschrijving"]; ?></td>
            <td><?php echo $boek["prijs"]; ?></td>
        </tr>
    </table>
    <form method="post" action="">
        <input type="hidden" name="confirm_delete" value="Ja">
        <input type="submit" value="Ja, verwijder dit boek">
        <a href="boeken_verkoop.php">Nee, ga terug</a>
    </form>
</main>

</body>
</html>

