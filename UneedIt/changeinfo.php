<?php
session_start();
if (isset($_SESSION['user']) && isset($_POST['newName']) && isset($_POST['newPhoneNumber']) && isset($_POST['newAddress']) && isset($_POST['newEmail'])) {

    $user = $_SESSION['user'];
    $newName = $_POST['newName'];
    $newPhoneNumber = $_POST['newPhoneNumber'];
    $newAddress = $_POST['newAddress'];
    $newEmail = $_POST['newEmail'];


    if (empty($newName) || empty($newPhoneNumber) || empty($newAddress) || empty($newEmail)) {
        echo "Vul alstublieft alle velden in.";
        exit();
    }


    if (!preg_match("/^[0-9]{10}$/", $newPhoneNumber)) {
        echo "Voer alstublieft een geldig telefoonnummer in.";
        exit();
    }

    if (!filter_var($newEmail, FILTER_VALIDATE_EMAIL)) {
        echo "Gelieve een geldig e-mailadres in te geven.";
        exit();
    }

    try {

        $pdo = new PDO('mysql:host=localhost;dbname=uneedit', 'root', '');
        $pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);


        $stmt = $pdo->prepare("UPDATE users SET naam=?, telefoonnummer=?, address=?, email=? WHERE id=?");
        $stmt->execute([$newName, $newPhoneNumber, $newAddress, $newEmail, $user['id']]);


        header("Location: account.php");
        exit();
    } catch (PDOException $e) {
        echo "Error: " . $e->getMessage();
    }
} else {
    header("Location: login_or_signup.php");
    exit();
}
?>

