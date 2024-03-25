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

<!DOCTYPE html>
<html>
<head>
    <link rel="stylesheet" href="styles.css">
</head>
<body>
<nav class="navbar">
    <ul>
        <li><a href="boeken.php">Boeken</a></li>
        <li><a href="laptops.php">Laptops</a></li>
        <li><a href="home.php">Home</a></li>
    </ul>
</nav>
<div class="content">
    <table>
        <tr>
            <th>Titel</th>
            <th>Omschrijving</th>
            <th>Prijs</th>
            <th>Acties</th>
        </tr>
        <?php foreach ($books as $book) : ?>
            <tr>
                <td><?php echo $book['Titel']; ?></td>
                <td><?php echo $book['Omschrijving']; ?></td>
                <td><?php echo $book['Prijs']; ?></td>
                <td>
                    <?php if ($_SESSION['username'] === $book['added_user']) : ?>
                        <form method="POST" action="">
                            <input type="hidden" name="book_id" value="<?php echo $book['id']; ?>">
                            <input type="hidden" name="edit_title" value="<?php echo $book['Titel']; ?>">
                            <input type="hidden" name="edit_description" value="<?php echo $book['Omschrijving']; ?>">
                            <input type="hidden" name="edit_price" value="<?php echo $book['Prijs']; ?>">
                            <button type="submit" name="update_book">Edit</button>
                            <button type="submit" name="delete_book">Delete</button>
                        </form>
                    <?php endif; ?>
                </td>
            </tr>
        <?php endforeach; ?>
    </table>

    <h2>Add a Book</h2>
    <?php if (isset($_SESSION['username'])) : ?>
        <form method="POST" action="">
            <input type="text" name="title" placeholder="Title" required>
            <input type="text" name="description" placeholder="Description" required>
            <input type="text" name="price" placeholder="Price" required>
            <button type="submit" name="add_book">Add Book</button>
        </form>
    <?php else : ?>
        <button onclick="registerPrompt()">Add Book</button>

        <script>
            function registerPrompt() {
                alert("Please register or log in to add a book.");
                window.location = "register.php";
            }
        </script>
    <?php endif; ?>
</div>
</body>
</html>
