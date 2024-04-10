<?php
session_start();
include_once "gebruiker.php";
include_once "boek.php";
include_once "db_connect.php";
ini_set('display_errors', 1);
error_reporting(E_ALL);

// Controleer of de gebruiker is ingelogd
if (!isset($_SESSION["gebruiker"])) {
    header("Location: inloggen.php");
    exit();
}

// Variabelen initialiseren
$error = "";
$success = false;

// Controleer of het boek-ID is ingesteld via de URL-parameter
if (!isset($_GET["id"])) {
    header("Location: boeken_verkoop.php");
    exit();
}

// Haal het boek-ID op uit de URL-parameter
$boek_id = $_GET["id"];

// Controleer of het formulier is ingediend
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    // Haal de gegevens van het formulier op
    $boek_id = $_POST["boek_id"];
    $titel = $_POST["titel"];
    $auteur = $_POST["auteur"];
    $beschrijving = $_POST["beschrijving"];
    $prijs = $_POST["prijs"];

    // Valideer de ingevoerde gegevens
    if (empty($titel) || empty($auteur) || empty($beschrijving) || empty($prijs)) {
        $error = "Vul alle vereiste velden in.";
    } else {
        // Update de boekgegevens in de database
        $query = "UPDATE boeken SET titel=?, auteur=?, beschrijving=?, prijs=? WHERE id=?";
        $stmt = $conn->prepare($query);
        if ($stmt) {
            // Bind de parameters aan de query
            $stmt->bind_param("ssssd", $titel, $auteur, $beschrijving, $prijs, $boek_id);
            if ($stmt->execute()) {
                // Update van het boek is gelukt
                $success = true;
            } else {
                // Fout bij het uitvoeren van de query
                $error = "Er is een fout opgetreden bij het uitvoeren van de query: " . $stmt->error;
            }
            // Sluit de statement
            $stmt->close();
        } else {
            // Fout bij het voorbereiden van de query
            $error = "Er is een fout opgetreden bij het voorbereiden van de query: " . $conn->error;
        }
    }
}

// Query om het boek op te halen op basis van het ID
$query = "SELECT * FROM boeken WHERE id=?";
$stmt = $conn->prepare($query);
$stmt->bind_param("d", $boek_id);
$stmt->execute();
$result = $stmt->get_result();

// Haal de boekgegevens op
$boek = $result->fetch_assoc();

// Sluit de statement
$stmt->close();

// Sluit de verbinding
$conn->close();
?>

<!DOCTYPE html>
<html lang="nl">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Boek Bewerken</title>
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
    <h1>Boek Bewerken</h1>
    <?php if ($success): ?>
        <p class="success">Het boek is succesvol bijgewerkt!</p>
    <?php else: ?>
        <form method="post" action="">
            <input type="hidden" name="boek_id" value="<?php echo $boek_id; ?>">
            <label for="titel">Titel:</label>
            <input type="text" id="titel" name="titel" value="<?php echo $boek['titel']; ?>" required><br><br>
            <label for="auteur">Auteur:</label>
            <input type="text" id="auteur" name="auteur" value="<?php echo $boek['auteur']; ?>" required><br><br>
            <label for="beschrijving">Beschrijving:</label>
            <textarea id="beschrijving" name="beschrijving" rows="4" cols="50" required><?php echo $boek['beschrijving']; ?></textarea><br><br>
            <label for="prijs">Prijs:</label>
            <input type="number" id="prijs" name="prijs" value="<?php echo $boek['prijs']; ?>" required><br><br>
            <input type="submit" value="Bijwerken">
        </form>
        <?php if (!empty($error)): ?>
            <p class="error"><?php echo $error; ?></p>
        <?php endif; ?>
    <?php endif; ?>
</main>

</body>
</html>
