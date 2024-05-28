<?php
session_start();
include_once "Product.php";
include_once "CartItem.php";
include_once "Cart.php";

// Initialiseer de winkelwagen in de sessie als deze nog niet bestaat
if (!isset($_SESSION['cart'])) {
    $_SESSION['cart'] = new Cart();
}

$cart = $_SESSION['cart'];

// Voeg producten toe aan de winkelwagen (voorbeeld)
// Dit gedeelte zou normaal gesproken worden afgehandeld door een formulier op een productpagina
if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $productId = $_POST['product_id'];
    $productNaam = $_POST['product_naam'];
    $productPrijs = $_POST['product_prijs'];
    $aantal = $_POST['aantal'];

    $product = new Product($productId, $productNaam, $productPrijs);
    $cart->addProduct($product, $aantal);
}

// Verwijder een product uit de winkelwagen
if (isset($_GET['remove'])) {
    $productId = $_GET['remove'];
    $cart->removeProduct($productId);
}

// Bewaar de bijgewerkte winkelwagen in de sessie
$_SESSION['cart'] = $cart;
?>

<!DOCTYPE html>
<html lang="nl">
<head>
    <meta charset="UTF-8">
    <title>

