<?php
// product.php
class Product {
    protected $merk;
    protected $model;
    protected $specificaties;
    protected $prijs;
    protected $gebruikers_id;

    public function __construct($merk, $model, $specificaties, $prijs, $gebruikers_id) {
        $this->merk = $merk;
        $this->model = $model;
        $this->specificaties = $specificaties;
        $this->prijs = $prijs;
        $this->gebruikers_id = $gebruikers_id;
    }

    public function insertProduct($conn) {
        // Deze methode wordt overschreven in de subklassen (Laptop en Boek)
        return false;
    }
}

// laptop.php
class Laptop extends Product {
    public function insertProduct($conn) {
        $query = "INSERT INTO laptops (merk, model, specificaties, prijs, gebruikers_id) VALUES (?, ?, ?, ?, ?)";
        $stmt = $conn->prepare($query);
        $stmt->bind_param("ssssd", $this->merk, $this->model, $this->specificaties, $this->prijs, $this->gebruikers_id);
        return $stmt->execute();
    }
}

// boek.php
class Boek extends Product {
    public function insertProduct($conn) {
        $query = "INSERT INTO boeken (titel, auteur, beschrijving, prijs, gebruikers_id) VALUES (?, ?, ?, ?, ?)";
        $stmt = $conn->prepare($query);
        $stmt->bind_param("ssssd", $this->merk, $this->model, $this->specificaties, $this->prijs, $this->gebruikers_id);
        return $stmt->execute();
    }
}
?>

