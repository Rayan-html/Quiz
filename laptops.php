<?php
session_start();

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    if (!isset($_SESSION['username'])) {
        echo "<script>alert('Please register or log in to add a laptop.'); window.location='register.php';</script>";
        exit;
    }

    try {
        $db = new PDO("mysql:host=localhost;dbname=producten", "root", "root");
        $db->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);

        if (isset($_POST['add_laptop'])) {
            $brand = $_POST['brand'];
            $model = $_POST['model'];
            $price = $_POST['price'];
            $addedUser = $_SESSION['username'];

            $query = $db->prepare("INSERT INTO laptops (Brand, Model, Price, added_user) VALUES (:brand, :model, :price, :addedUser)");
            $query->bindParam(':brand', $brand);
            $query->bindParam(':model', $model);
            $query->bindParam(':price', $price);
            $query->bindParam(':addedUser', $addedUser);
            $query->execute();
        }

        if (isset($_POST['update_laptop'])) {
            $laptopId = $_POST['laptop_id'];
            $addedUser = $_SESSION['username'];
            $updatedBrand = $_POST['edit_brand'];
            $updatedModel = $_POST['edit_model'];
            $updatedPrice = $_POST['edit_price'];

            $updateQuery = $db->prepare("UPDATE laptops SET Brand = :updatedBrand, Model = :updatedModel, Price = :updatedPrice WHERE id = :laptopId AND added_user = :addedUser");
            $updateQuery->bindParam(':updatedBrand', $updatedBrand);
            $updateQuery->bindParam(':updatedModel', $updatedModel);
            $updateQuery->bindParam(':updatedPrice', $updatedPrice);
            $updateQuery->bindParam(':laptopId', $laptopId);
            $updateQuery->bindParam(':addedUser', $addedUser);
            $updateQuery->execute();
        }

        if (isset($_POST['delete_laptop'])) {
            $laptopId = $_POST['laptop_id'];
            $addedUser = $_SESSION['username'];

            $deleteQuery = $db->prepare("DELETE FROM laptops WHERE id = :laptopId AND added_user = :addedUser");
            $deleteQuery->bindParam(':laptopId', $laptopId);
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

    $query = $db->prepare("SELECT * FROM laptops");
    $query->execute();
    $laptops = $query->fetchAll(PDO::FETCH_ASSOC);
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
            <th>Brand</th>
            <th>Model</th>
            <th>Price</th>
            <th>Actions</th>
        </tr>
        <?php foreach ($laptops as $laptop) : ?>
            <tr>
                <td><?php echo $laptop['Brand']; ?></td>
                <td><?php echo $laptop['Model']; ?></td>
                <td><?php echo $laptop['Price']; ?></td>
                <td>
                    <?php if ($_SESSION['username'] === $laptop['added_user']) : ?>
                        <form method="POST" action="">
                            <input type="hidden" name="laptop_id" value="<?php echo $laptop['id']; ?>">
                            <input type="hidden" name="edit_brand" value="<?php echo $laptop['Brand']; ?>">
                            <input type="hidden" name="edit_model" value="<?php echo $laptop['Model']; ?>">
                            <input type="hidden" name="edit_price" value="<?php echo $laptop['Price']; ?>">
                            <button type="submit" name="update_laptop">Edit</button>
                            <button type="submit" name="delete_laptop">Delete</button>
                        </form>
                    <?php endif; ?>
                </td>
            </tr>
        <?php endforeach; ?>
    </table>

    <h2>Add a Laptop</h2>
    <?php if (isset($_SESSION['username'])) : ?>
        <form method="POST" action="">
            <input type="text" name="brand" placeholder="Brand" required>
            <input type="text" name="model" placeholder="Model" required>
            <input type="text" name="price" placeholder="Price" required>
            <button type="submit" name="add_laptop">Add Laptop</button>
        </form>
    <?php else : ?>
        <button onclick="registerPrompt()">Add Laptop</button>

        <script>
            function registerPrompt() {
                alert("Please register or log in to add a laptop.");
                window.location = "register.php";
            }
        </script>
    <?php endif; ?>
</div>
</body>
</html>
