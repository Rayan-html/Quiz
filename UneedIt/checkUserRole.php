<?php
session_start();

$mysql = new PDO('mysql:host=localhost;dbname=uneedit', 'root', '');

$id = $_SESSION['idvanklant'];

$stmt = $mysql->prepare("SELECT `role` FROM `users` WHERE `id` = :id");
$stmt->bindParam(':id', $id);
$stmt->execute();

$user = $stmt->fetch(PDO::FETCH_ASSOC);

if ($user) {
    echo $user['role'];
} else {
    echo "error";
}
?>
