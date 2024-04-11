<?php
class Gebruiker {
    private $id;
    private $gebruikersnaam;
    private $wachtwoord;
    private $email;
    private $adres;

    public function __construct($id, $gebruikersnaam, $wachtwoord, $email, $adres) {
        $this->id = $id;
        $this->gebruikersnaam = $gebruikersnaam;
        $this->wachtwoord = $wachtwoord;
        $this->email = $email;
        $this->adres = $adres;
    }

    // Getter-methode voor ID
    public function getId() {
        return $this->id;
    }

    // Getter-methode voor gebruikersnaam
    public function getGebruikersnaam() {
        return $this->gebruikersnaam;
    }

    // Getter-methode voor e-mail
    public function getEmail() {
        return $this->email;
    }

    // Getter-methode voor adres
    public function getAdres() {
        return $this->adres;
    }

    // Getter-methode voor wachtwoord
    public function getWachtwoord() {
        return $this->wachtwoord;
    }
}
?>
