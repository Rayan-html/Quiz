<?php
//// laptop.php
//
//class Laptop {
//    private $merk;
//    private $model;
//    private $specificaties;
//    private $prijs;
//    private $gebruikers_id;
//
//    public function __construct($merk, $model, $specificaties, $prijs, $gebruikers_id) {
//        $this->merk = $merk;
//        $this->model = $model;
//        $this->specificaties = $specificaties;
//        $this->prijs = $prijs;
//        $this->gebruikers_id = $gebruikers_id;
//    }
//
//    // Getter-methodes
//    public function getMerk() {
//        return $this->merk;
//    }
//
//    public function getModel() {
//        return $this->model;
//    }
//
//    public function getSpecificaties() {
//        return $this->specificaties;
//    }
//
//    public function getPrijs() {
//        return $this->prijs;
//    }
//
//    public function getGebruikersId() {
//        return $this->gebruikers_id;
//    }
//}
//?>

Hier is de code met Nederlandse opmerkingen:

```php
<?php
// laptop.php

class Laptop {
    private $merk; // Privé eigenschap voor het merk van de laptop
    private $model; // Privé eigenschap voor het model van de laptop
    private $specificaties; // Privé eigenschap voor de specificaties van de laptop
    private $prijs; // Privé eigenschap voor de prijs van de laptop
    private $gebruikers_id; // Privé eigenschap voor de gebruikers-ID van de eigenaar van de laptop

    public function __construct($merk, $model, $specificaties, $prijs, $gebruikers_id) {
        $this->merk = $merk; // Initialiseer het merk van de laptop
        $this->model = $model; // Initialiseer het model van de laptop
        $this->specificaties = $specificaties; // Initialiseer de specificaties van de laptop
        $this->prijs = $prijs; // Initialiseer de prijs van de laptop
        $this->gebruikers_id = $gebruikers_id; // Initialiseer de gebruikers-ID van de eigenaar van de laptop
    }

    // Getter-methodes om de waarden van de eigenschappen op te halen

    public function getMerk() {
        return $this->merk; // Retourneer het merk van de laptop
    }

    public function getModel() {
        return $this->model; // Retourneer het model van de laptop
    }

    public function getSpecificaties() {
        return $this->specificaties; // Retourneer de specificaties van de laptop
    }

    public function getPrijs() {
        return $this->prijs; // Retourneer de prijs van de laptop
    }

    public function getGebruikersId() {
        return $this->gebruikers_id; // Retourneer de gebruikers-ID van de eigenaar van de laptop
    }
}
?>


