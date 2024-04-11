<?php
include_once "gebruiker.php";
include_once "laptop.php";
session_start();
ini_set('display_errors', 1);
error_reporting(E_ALL);

// Controleer of de gebruiker is ingelogd
if (!isset($_SESSION["gebruiker"]) || !$_SESSION["gebruiker"] instanceof Gebruiker) {
    header("Location: inloggen.php");
    exit();
}

// Include het db_connect.php bestand
include_once "db_connect.php";

$error = "";

// Controleer of het formulier is ingediend
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    // Haal de gebruikersgegevens op uit de sessie
    $gebruiker = $_SESSION["gebruiker"];
    // Controleer of de gebruikersgegevens correct zijn opgeslagen
    if (!$gebruiker instanceof Gebruiker || !$gebruiker->getId()) {
        // Als de gebruikersgegevens niet correct zijn, doorsturen naar de inlogpagina
        header("Location: inloggen.php");
        exit();
    }

    // Haal de gebruikers-ID op via de methode getId van de Gebruiker klasse
    $gebruikers_id = $gebruiker->getId();

    // Haal de gegevens van het formulier op
    $merk = $_POST["merk"] ?? '';
    $model = $_POST["model"] ?? '';
    $specificaties = $_POST["specificaties"] ?? '';
    $prijs = $_POST["prijs"] ?? '';

    // Controleer of alle vereiste velden zijn ingevuld
    if (empty($merk) || empty($model) || empty($specificaties) || empty($prijs)) {
        $error = "Alle velden moeten worden ingevuld.";
    } else {
        // Voeg de laptopgegevens toe aan de database
        $query = "INSERT INTO laptops (gebruikers_id, merk, model, specificaties, prijs) VALUES (?, ?, ?, ?, ?)";
        $stmt = $conn->prepare($query);
        if (!$stmt) {
            // Als er een fout optreedt bij het voorbereiden van de query, toon een foutmelding
            $error = "Er is een fout opgetreden bij het voorbereiden van de query: " . $conn->error;
        } else {
            // Bind de parameters aan de query
            $stmt->bind_param("isssd", $gebruikers_id, $merk, $model, $specificaties, $prijs);
            if ($stmt->execute()) {
                // Als het toevoegen succesvol is, stuur de gebruiker door naar een succespagina of ergens anders
                header("Location: success.php");
                exit();
            } else {
                // Als er een fout optreedt, toon een foutmelding
                $error = "Er is een fout opgetreden bij het uitvoeren van de query: " . $stmt->error;
            }
        }

        // Sluit de statement
        $stmt->close();
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
    <title>Laptop Toevoegen</title>
    <link rel="stylesheet" href="index.css">
</head>
<body>
<?php include_once "navbar.php"; ?>

<main>
    <h1>Laptop Toevoegen</h1>
    <form method="post" action="<?php echo htmlspecialchars($_SERVER["PHP_SELF"]); ?>">
        <label for="merk">Merk:</label>
        <input type="text" id="merk" name="merk" required><br><br>
        <label for="model">Model:</label>
        <input type="text" id="model" name="model" required><br><br>
        <label for="specificaties">Specificaties:</label>
        <textarea id="specificaties" name="specificaties" rows="4" cols="50" required></textarea><br><br>
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
