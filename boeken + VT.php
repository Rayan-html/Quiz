<?php
session_start();

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    if (!isset($_SESSION['username'])) {
        echo "<script>alert('Please register or log in to add a book.'); window.location='register.php';</script>";
        exit;
    }

    try {
        $db = new PDO("mysql:host=localhost;dbname=techniekmarkt", "root", "root");
        $db->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);

        // Producten toevoegen
        if (isset($_POST['add_book'])) {
            $title = $_POST['title'];
            $description = $_POST['description'];
            $price = $_POST['price'];
            $addedUser = $_SESSION['username'];

            $query = $db->prepare("INSERT INTO boeken (Titel, Omschrijving, Prijs, added_user) VALUES (:title, :description, :price, :addedUser)");
            $query->bindParam(':title', $title);
            $query->bindParam(':description', $description);
            $query->bindParam(':price', $price);
            $query->bindParam(':addedUser', $addedUser);
            $query->execute();
        }

        // Boeken updaten
        if (isset($_POST['update_book'])) {
            $bookId = $_POST['book_id'];
            $addedUser = $_SESSION['username'];
            $updatedTitle = $_POST['edit_title'];
            $updatedDescription = $_POST['edit_description'];
            $updatedPrice = $_POST['edit_price'];

            $updateQuery = $db->prepare("UPDATE boeken SET Titel = :updatedTitle, Omschrijving = :updatedDescription, Prijs = :updatedPrice WHERE id = :bookId AND added_user = :addedUser");
            $updateQuery->bindParam(':updatedTitle', $updatedTitle);
            $updateQuery->bindParam(':updatedDescription', $updatedDescription);
            $updateQuery->bindParam(':updatedPrice', $updatedPrice);
            $updateQuery->bindParam(':bookId', $bookId);
            $updateQuery->bindParam(':addedUser', $addedUser);
            $updateQuery->execute();
        }

        // Boeken verwijderen
        if (isset($_POST['delete_book'])) {
            $bookId = $_POST['book_id'];
            $addedUser = $_SESSION['username'];

            $deleteQuery = $db->prepare("DELETE FROM boeken WHERE id = :bookId AND added_user = :addedUser");
            $deleteQuery->bindParam(':bookId', $bookId);
            $deleteQuery->bindParam(':addedUser', $addedUser);
            $deleteQuery->execute();
        }
    } catch (PDOException $e) {
        die("Error!: " . $e->getMessage());
    }
}

try {
    $db = new PDO("mysql:host=localhost;dbname=techniekmarkt", "root", "root");
    $db->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);

    $query = $db->prepare("SELECT * FROM boeken");
    $query->execute();
    $books = $query->fetchAll(PDO::FETCH_ASSOC);
} catch (PDOException $e) {
    die("Error!: " . $e->getMessage());
}
?>

