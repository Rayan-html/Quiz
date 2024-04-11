<?php
// Database configuratie
$servername = "localhost"; // Verander dit naar de naam van je database server als deze anders is
$username = "root"; // Verander dit naar je database gebruikersnaam
$password = "root"; // Verander dit naar je database wachtwoord
$dbname = "verkoopplatform"; // Verander dit naar de naam van je database

// Maak verbinding met de database
$conn = new mysqli($servername, $username, $password, $dbname);

// Controleer de verbinding
if ($conn->connect_error) {
    die("Connectie met de database mislukt: " . $conn->connect_error);
}
?>
