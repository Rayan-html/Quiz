<?php
session_start();

if (empty($_POST['naam']) || empty($_POST['telefoonnummer']) || empty($_POST['email']) || empty($_POST['address']) || empty($_POST['password'])) {
    echo "Vul alstublieft alle velden in";
    exit();
}

$mysql = new PDO('mysql:host=localhost;dbname=uneedit', 'root', '');

$naam = filter_var(trim($_POST['naam']), FILTER_SANITIZE_STRING);
$telefoonnummer = filter_var(trim($_POST['telefoonnummer']), FILTER_SANITIZE_STRING);
$email = filter_var(trim($_POST['email']), FILTER_SANITIZE_STRING);
$address = filter_var(trim($_POST['address']), FILTER_SANITIZE_STRING);
$password = filter_var(trim($_POST['password']), FILTER_SANITIZE_STRING);

$stmt = $mysql->prepare("INSERT INTO `users` (`naam`, `telefoonnummer`, `email`, `address`, `password`, `role`) VALUES (:naam, :telefoonnummer, :email, :address, :password, 'klant')");$stmt->bindParam(':naam', $naam);
$stmt->bindParam(':telefoonnummer', $telefoonnummer);
$stmt->bindParam(':email', $email);
$stmt->bindParam(':address', $address);
$stmt->bindParam(':password', $password);

if ($stmt->execute()) {
    $user = [
        'naam' => $naam,
        'telefoonnummer' => $telefoonnummer,
        'email' => $email,
        'address' => $address,
        'password' => $password
    ];

    $_SESSION['user'] = $user;

    header("Location: home.php");
    exit();
} else {
    echo "Fout bij gebruikersregistratie";
    exit();
}
?>