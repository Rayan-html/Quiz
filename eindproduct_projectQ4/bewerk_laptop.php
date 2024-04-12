<?php
//Sessie starte-->
session_start();
include_once "gebruiker.php";
include_once "laptop.php";
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

// Controleer of het laptop-ID is ingesteld via de URL-parameter
if (!isset($_GET["id"])) {
    header("Location: laptops_verkoop.php");
    exit();
}

// Haal het laptop-ID op uit de URL-parameter
$laptop_id = $_GET["id"];

// Controleer of het formulier is ingediend
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    // Haal de gegevens van het formulier op
    $laptop_id = $_POST["laptop_id"];
    $merk = $_POST["merk"];
    $model = $_POST["model"];
    $specificaties = $_POST["specificaties"];
    $prijs = $_POST["prijs"];

    // Valideer de ingevoerde gegevens
    if (empty($merk) || empty($model) || empty($specificaties) || empty($prijs)) {
        $error = "Vul alle vereiste velden in.";
    } else {
        // Update de laptopgegevens in de database
        $query = "UPDATE laptops SET merk=?, model=?, specificaties=?, prijs=? WHERE id=?";
        $stmt = $conn->prepare($query);
        if ($stmt) {
            // Bind de parameters aan de query
            $stmt->bind_param("ssssd", $merk, $model, $specificaties, $prijs, $laptop_id);
            if ($stmt->execute()) {
                // Update van de laptop is gelukt
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

// Query om de laptop op te halen op basis van het ID
$query = "SELECT * FROM laptops WHERE id=?";
$stmt = $conn->prepare($query);
$stmt->bind_param("d", $laptop_id);
$stmt->execute();
$result = $stmt->get_result();

// Haal de laptopgegevens op
$laptop = $result->fetch_assoc();

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
    <title>Laptop Bewerken</title>
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
    <h1>Laptop Bewerken</h1>
    <?php if ($success): ?>
        <p class="success">De laptop is succesvol bijgewerkt!</p>
    <?php else: ?>
        <form method="post" action="">
            <!-- Voeg dit toe binnen de form tag -->
            <input type="hidden" name="laptop_id" value="<?php echo $laptop_id; ?>">
            <label for="merk">Merk:</label>
            <input type="text" id="merk" name="merk" value="<?php echo $laptop['merk']; ?>" required><br><br>
            <label for="model">Model:</label>
            <input type="text" id="model" name="model" value="<?php echo $laptop['model']; ?>" required><br><br>
            <label for="specificaties">Specificaties:</label>
            <textarea id="specificaties" name="specificaties" rows="4" cols="50" required><?php echo $laptop['specificaties']; ?></textarea><br><br>
            <label for="prijs">Prijs:</label>
            <input type="number" id="prijs" name="prijs" value="<?php echo $laptop['prijs']; ?>" required><br><br>
            <input type="submit" value="Bijwerken">
        </form>
        <?php if (!empty($error)): ?>
            <p class="error"><?php echo $error; ?></p>
        <?php endif; ?>
    <?php endif; ?>
</main>

</body>
</html>

