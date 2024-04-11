<?php
session_start();

class Database {
    // Database connection details
    private $host = "localhost";
    private $dbname = "producten";
    private $username = "root";
    private $password = "root";
    private $db;

    // Constructor to establish database connection
    public function __construct() {
        try {
            // Establishing a PDO database connection
            $this->db = new PDO("mysql:host=$this->host;dbname=$this->dbname", $this->username, $this->password);
            // Setting PDO error mode to exception
            $this->db->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
        } catch (PDOException $e) {
            // Display error message if connection fails
            die("Error!: " . $e->getMessage());
        }
    }

    // Method to add a laptop to the database
    public function addLaptop($brand, $model, $price, $addedUser) {
        $query = $this->db->prepare("INSERT INTO laptops (Brand, Model, Price, added_user) VALUES (:brand, :model, :price, :addedUser)");
        $query->bindParam(':brand', $brand);
        $query->bindParam(':model', $model);
        $query->bindParam(':price', $price);
        $query->bindParam(':addedUser', $addedUser);
        $query->execute();
    }

    // Method to update a laptop in the database
    public function updateLaptop($laptopId, $updatedBrand, $updatedModel, $updatedPrice, $addedUser) {
        $updateQuery = $this->db->prepare("UPDATE laptops SET Brand = :updatedBrand, Model = :updatedModel, Price = :updatedPrice WHERE id = :laptopId AND added_user = :addedUser");
        $updateQuery->bindParam(':updatedBrand', $updatedBrand);
        $updateQuery->bindParam(':updatedModel', $updatedModel);
        $updateQuery->bindParam(':updatedPrice', $updatedPrice);
        $updateQuery->bindParam(':laptopId', $laptopId);
        $updateQuery->bindParam(':addedUser', $addedUser);
        $updateQuery->execute();
    }

    // Method to delete a laptop from the database
    public function deleteLaptop($laptopId, $addedUser) {
        $deleteQuery = $this->db->prepare("DELETE FROM laptops WHERE id = :laptopId AND added_user = :addedUser");
        $deleteQuery->bindParam(':laptopId', $laptopId);
        $deleteQuery->bindParam(':addedUser', $addedUser);
        $deleteQuery->execute();
    }

    // Method to retrieve all laptops from the database
    public function getAllLaptops() {
        $query = $this->db->prepare("SELECT * FROM laptops");
        $query->execute();
        return $query->fetchAll(PDO::FETCH_ASSOC);
    }
}

// Creating a new instance of the Database class
$db = new Database();

// Handling POST requests
if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    // Checking if the user is logged in
    if (!isset($_SESSION['username'])) {
        // Alerting the user and redirecting to the registration page if not logged in
        echo "<script>alert('Please register or log in to add a laptop.'); window.location='register.php';</script>";
        exit;
    }

    // Handling add laptop request
    if (isset($_POST['add_laptop'])) {
        // Retrieving form data
        $brand = $_POST['brand'];
        $model = $_POST['model'];
        $price = $_POST['price'];
        $addedUser = $_SESSION['username'];
        // Calling addLaptop method to add laptop to the database
        $db->addLaptop($brand, $model, $price, $addedUser);
    }

    // Handling update laptop request
    if (isset($_POST['update_laptop'])) {
        // Retrieving form data
        $laptopId = $_POST['laptop_id'];
        $addedUser = $_SESSION['username'];
        $updatedBrand = $_POST['edit_brand'];
        $updatedModel = $_POST['edit_model'];
        $updatedPrice = $_POST['edit_price'];
        // Calling updateLaptop method to update laptop in the database
        $db->updateLaptop($laptopId, $updatedBrand, $updatedModel, $updatedPrice, $addedUser);
    }

    // Handling delete laptop request
    if (isset($_POST['delete_laptop'])) {
        // Retrieving form data
        $laptopId = $_POST['laptop_id'];
        $addedUser = $_SESSION['username'];
        // Calling deleteLaptop method to delete laptop from the database
        $db->deleteLaptop($laptopId, $addedUser);
    }
}

// Retrieving all laptops from the database
$laptops = $db->getAllLaptops();
?>
