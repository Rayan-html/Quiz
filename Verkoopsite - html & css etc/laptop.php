<?php
// laptop.php

class Laptop {
    private $merk;
    private $model;
    private $specificaties;
    private $prijs;
    private $gebruikers_id;

    public function __construct($merk, $model, $specificaties, $prijs, $gebruikers_id) {
        $this->merk = $merk;
        $this->model = $model;
        $this->specificaties = $specificaties;
        $this->prijs = $prijs;
        $this->gebruikers_id = $gebruikers_id;
    }

    // Getter-methodes
    public function getMerk() {
        return $this->merk;
    }

    public function getModel() {
        return $this->model;
    }

    public function getSpecificaties() {
        return $this->specificaties;
    }

    public function getPrijs() {
        return $this->prijs;
    }

    public function getGebruikersId() {
        return $this->gebruikers_id;
    }
}
?>

