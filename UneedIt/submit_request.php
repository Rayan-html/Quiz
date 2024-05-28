<?php
session_start();

if (!isset($_SESSION['user'])) {
    header("Location: login.php");
    exit();
}

$idvanklant = $_SESSION['idvanklant'];

$mysql = new PDO('mysql:host=localhost;dbname=uneedit', 'root', '');

if (!$mysql) {
    die("Verbindingsfout: " . $mysql->errorInfo()[2]);
}


$defect = $_POST['defect'];
$machine = $_POST['machine'];
$garantie = $_POST['garantie'];
$datum = $_POST['datum'];


$stmt_check_user = $mysql->prepare("SELECT * FROM users WHERE id = ?");
$stmt_check_user->execute([$idvanklant]);
$user_exists = $stmt_check_user->fetch(PDO::FETCH_ASSOC);

if (!$user_exists) {
    echo "Fout: De gebruiker van idvanklant = $idvanklant bestaat niet in de gebruikerstabel.";
    exit();
}

$photo_path = "";
if(isset($_FILES['photo']) && $_FILES['photo']['error'] == UPLOAD_ERR_OK) {
    $target_dir = "uploads/";
    $target_file = $target_dir . basename($_FILES["photo"]["name"]);
    move_uploaded_file($_FILES["photo"]["tmp_name"], $target_file);
    $photo_path = $target_file;
}

$stmt = $mysql->prepare("INSERT INTO requests (idvanklant, typemachine, garantie, datum, photo_path, omschrijving) 
                        VALUES (?, ?, ?, ?, ?, ?)");
$stmt->execute([$idvanklant, $machine, $garantie, $datum, $photo_path, $defect]);

if ($stmt->rowCount() > 0) {
    echo "Verzoek succesvol verzonden";
} else {
    echo "Fout: Het verzoek kon niet worden verzonden";
}
?>
