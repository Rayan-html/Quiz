<?php
ini_set('display_errors', 1);
error_reporting(E_ALL);
session_start();

include_once "db_connect.php";

$error = ""; // Initialize the variable for error messages

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    // Get username and password from the form
    $gebruikersnaam = $_POST["gebruikersnaam"];
    $wachtwoord = $_POST["wachtwoord"];

    // Query to retrieve user based on username
    $query = "SELECT id, gebruikersnaam, wachtwoord FROM gebruikers WHERE gebruikersnaam = ?";
    $stmt = $conn->prepare($query);
    $stmt->bind_param("s", $gebruikersnaam);
    $stmt->execute();
    $result = $stmt->get_result();

    // Check if a row is found
    if ($result->num_rows == 1) {
        // Get user data
        $row = $result->fetch_assoc();

        // Check if the entered password matches the hashed password in the database
        if (password_verify($wachtwoord, $row["wachtwoord"])) {
            // Store the username in the session instead of user_id
            $_SESSION["gebruiker"] = $gebruikersnaam;
            header("Location: index.php");
            exit();
        } else {
            // Show error message if password is incorrect
            $error = "Invalid username or password.";
        }
    } else {
        // Show error message if user is not found
        $error = "User not found.";
    }

    // Close the statement
    $stmt->close();
}
?>
<!DOCTYPE html>
<html lang="nl">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Inloggen</title>
    <link rel="stylesheet" href="login2.css">
</head>
<body>

<?php include_once "navbar.php"; ?>
<main>
    <div class="login-box">
        <h2>Login</h2>
        <form method="post" action="<?php echo htmlspecialchars($_SERVER["PHP_SELF"]); ?>">
            <div class="user-box">
                <input type="text" id="gebruikersnaam" name="gebruikersnaam" required="">
                <label for="gebruikersnaam">Gebruikersnaam</label>
            </div>
            <div class="user-box">
                <input type="password" id="wachtwoord" name="wachtwoord" required="">
                <label for="wachtwoord">Wachtwoord</label>
            </div>
            <button type="submit">
                <span></span>
                <span></span>
                <span></span>
                <span></span>
                Submit
            </button>
        </form>
        <?php if(!empty($error)) { ?>
            <p><?php echo $error; ?></p>
        <?php } ?>
        <p>Heb je nog geen account? <a href="registreren.php">Registreer hier</a>.</p>
    </div>
</main>

</body>
</html>
