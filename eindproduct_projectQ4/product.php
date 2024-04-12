<?php
//// product.php
//class Product {
//    protected $merk;
//    protected $model;
//    protected $specificaties;
//    protected $prijs;
//    protected $gebruikers_id;
//
//    public function __construct($merk, $model, $specificaties, $prijs, $gebruikers_id) {
//        $this->merk = $merk;
//        $this->model = $model;
//        $this->specificaties = $specificaties;
//        $this->prijs = $prijs;
//        $this->gebruikers_id = $gebruikers_id;
//    }
//
//    public function insertProduct($conn) {
//        // Deze methode wordt overschreven in de subklassen (Laptop en Boek)
//        return false;
//    }
//}
//
//// laptop.php
//class Laptop extends Product {
//    public function insertProduct($conn) {
//        $query = "INSERT INTO laptops (merk, model, specificaties, prijs, gebruikers_id) VALUES (?, ?, ?, ?, ?)";
//        $stmt = $conn->prepare($query);
//        $stmt->bind_param("ssssd", $this->merk, $this->model, $this->specificaties, $this->prijs, $this->gebruikers_id);
//        return $stmt->execute();
//    }
//}
//
//// boek.php
//class Boek extends Product {
//    public function insertProduct($conn) {
//        $query = "INSERT INTO boeken (titel, auteur, beschrijving, prijs, gebruikers_id) VALUES (?, ?, ?, ?, ?)";
//        $stmt = $conn->prepare($query);
//        $stmt->bind_param("ssssd", $this->merk, $this->model, $this->specificaties, $this->prijs, $this->gebruikers_id);
//        return $stmt->execute();
//    }
//}
//?>

<?php
// product.php
class Product {
    protected $merk; // Beschermd eigenschap voor het merk van het product
    protected $model; // Beschermd eigenschap voor het model van het product
    protected $specificaties; // Beschermd eigenschap voor de specificaties van het product
    protected $prijs; // Beschermd eigenschap voor de prijs van het product
    protected $gebruikers_id; // Beschermd eigenschap voor de gebruikers-ID van de eigenaar van het product

    public function __construct($merk, $model, $specificaties, $prijs, $gebruikers_id) {
        $this->merk = $merk; // Initialiseer het merk van het product
        $this->model = $model; // Initialiseer het model van het product
        $this->specificaties = $specificaties; // Initialiseer de specificaties van het product
        $this->prijs = $prijs; // Initialiseer de prijs van het product
        $this->gebruikers_id = $gebruikers_id; // Initialiseer de gebruikers-ID van de eigenaar van het product
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
