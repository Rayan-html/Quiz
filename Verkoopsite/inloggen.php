<?php
ini_set('display_errors', 1);
error_reporting(E_ALL);
session_start();

include_once "db_connect.php";

$error = ""; // Initieer de variabele voor foutmeldingen

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    // Verkrijg gebruikersnaam en wachtwoord uit het formulier
    $gebruikersnaam = $_POST["gebruikersnaam"];
    $wachtwoord = $_POST["wachtwoord"];

    // Query om gebruiker op te halen op basis van gebruikersnaam
    $query = "SELECT id, gebruikersnaam, wachtwoord FROM gebruikers WHERE gebruikersnaam = ?";
    $stmt = $conn->prepare($query);
    $stmt->bind_param("s", $gebruikersnaam);
    $stmt->execute();
    $result = $stmt->get_result();

    // Controleer of er een rij is gevonden
    if ($result->num_rows == 1) {
        // Haal de gebruikersgegevens op
        $row = $result->fetch_assoc();

        // Controleer of het ingevoerde wachtwoord overeenkomt met het gehashte wachtwoord in de database
        if (password_verify($wachtwoord, $row["wachtwoord"])) {
            // Sla de gebruikersnaam op in de sessie in plaats van gebruiker_id
            $_SESSION["gebruiker"] = $gebruikersnaam;
            header("Location: index.php");
            exit();
        } else {
            // Toon foutmelding als het wachtwoord onjuist is
            $error = "Ongeldige gebruikersnaam of wachtwoord.";
        }
    } else {
        // Toon foutmelding als de gebruiker niet gevonden is
        $error = "Gebruiker niet gevonden.";
    }

    // Sluit de statement
    $stmt->close();
}
?>
<!DOCTYPE html>
<html lang="nl">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Inloggen</title>
    <link rel="stylesheet" href="login.css">
</head>
<body>

<?php include_once "navbar.php"; ?>
<main>
    <h1>Inloggen</h1>
    <form method="post" action="<?php echo htmlspecialchars($_SERVER["PHP_SELF"]); ?>">
        <label for="gebruikersnaam">Gebruikersnaam:</label>
        <input type="text" id="gebruikersnaam" name="gebruikersnaam" required><br><br>
        <label for="wachtwoord">Wachtwoord:</label>
        <input type="password" id="wachtwoord" name="wachtwoord" required><br><br>
        <input type="submit" value="Inloggen">
    </form>
    <?php if(!empty($error)) { ?>
        <p><?php echo $error; ?></p>
    <?php } ?>
    <p>Heb je nog geen account? <a href="registreren.php">Registreer hier</a>.</p>
</main>

</body>
</html>
