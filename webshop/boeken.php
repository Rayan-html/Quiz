<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="main.css">
    <title>Homepage</title>
</head>
<body>
<header>
    <h1>Welcome to my Tech Store</h1>
</header>

<main>
    <nav>
        <a href="boeken.php" class="button">Boeken</a>
        <a href="laptops.php" class="button">Laptops</a>
    </nav>
</main>

<footer>
    &copy; 2023 Your Name
</footer>
</body>
</html>



<?php

session_start();

// Book Class
class Book
{
    private $id;
    private $title;
    private $description;
    private $price;
    private $addedUser;

    public function __construct($title, $description, $price, $addedUser)
    {
        $this->title = $title;
        $this->description = $description;
        $this->price = $price;
        $this->addedUser = $addedUser;
    }

    // Getters
    public function getId()
    {
        return $this->id;
    }

    public function getTitle()
    {
        return $this->title;
    }

    // ... (Getters for description, price, addedUser)

    // Setters (optional)
    public function setTitle($title)
    {
        $this->title = $title;
    }

    // ... (Setters for description, price, addedUser)

    public function save($db)
    {
        if ($this->id === null) {
            $query = $db->prepare("INSERT INTO boeken (Titel, Omschrijving, Prijs, added_user) VALUES (:title, :description, :price, :addedUser)");
        } else {
            $query = $db->prepare("UPDATE boeken SET Titel = :title, Omschrijving = :description, Prijs = :price WHERE id = :id AND added_user = :addedUser");
        }

        // ... (Query preparation and execution - same as before)
    }

    public function delete($db)
    {
        // ... (Delete query preparation and execution - same as before)
    }
}

// Database Connection Function
function getDBConnection()
{
    try {
        $db = new PDO("mysql:host=localhost;dbname=techniekmarkt", "root", "root");
        $db->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
        return $db;
    } catch (PDOException $e) {
        die("Error!: " . $e->getMessage());
    }
}

// ... (Rest of your code: fetching books, handling actions)

// HTML Structure
?>
<!DOCTYPE html>
<!-- ... (Rest of your HTML structure)
<?php
session_start();

// Book Class
class Book {
    private $id;
    private $title;
    private $description;
    private $price;
    private $addedUser;

    public function __construct($title, $description, $price, $addedUser) {
        $this->title = $title;
        $this->description = $description;
        $this->price = $price;
        $this->addedUser = $addedUser;
    }

    // Getters
    public function getId() {
        return $this->id;
    }

    public function getTitle() {
        return $this->title;
    }

    // ... (Getters for description, price, addedUser)

    // Setters (optional)
    public function setTitle($title) {
        $this->title = $title;
    }

    // ... (Setters for description, price, addedUser)

    public function save($db) {
        if ($this->id === null) {
            $query = $db->prepare("INSERT INTO boeken (Titel, Omschrijving, Prijs, added_user) VALUES (:title, :description, :price, :addedUser)");
        } else {
            $query = $db->prepare("UPDATE boeken SET Titel = :title, Omschrijving = :description, Prijs = :price WHERE id = :id AND added_user = :addedUser");
        }

        // ... (Query preparation and execution - same as before)
    }

    public function delete($db) {
        // ... (Delete query preparation and execution - same as before)
    }
}

// Database Connection Function
function getDBConnection() {
    try {
        $db = new PDO("mysql:host=localhost;dbname=techniekmarkt", "root", "root");
        $db->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
        return $db;
    } catch (PDOException $e) {
        die("Error!: " . $e->getMessage());
    }
}

// ... (Rest of your code: fetching books, handling actions)

// HTML Structure
?>
<!DOCTYPE html>

