<?php
//class Gebruiker {
//    private $id;
//    private $gebruikersnaam;
//    private $wachtwoord;
//    private $email;
//    private $adres;
//
//    public function __construct($id, $gebruikersnaam, $wachtwoord, $email, $adres) {
//        $this->id = $id;
//        $this->gebruikersnaam = $gebruikersnaam;
//        $this->wachtwoord = $wachtwoord;
//        $this->email = $email;
//        $this->adres = $adres;
//    }
//
//    // Getter-methode voor ID
//    public function getId() {
//        return $this->id;
//    }
//
//    // Getter-methode voor gebruikersnaam
//    public function getGebruikersnaam() {
//        return $this->gebruikersnaam;
//    }
//
//    // Getter-methode voor e-mail
//    public function getEmail() {
//        return $this->email;
//    }
//
//    // Getter-methode voor adres
//    public function getAdres() {
//        return $this->adres;
//    }
//
//    // Getter-methode voor wachtwoord
//    public function getWachtwoord() {
//        return $this->wachtwoord;
//    }
//}
//?>

<?php
class Gebruiker {
    private $id; // Privé eigenschap voor de ID van de gebruiker
    private $gebruikersnaam; // Privé eigenschap voor de gebruikersnaam van de gebruiker
    private $wachtwoord; // Privé eigenschap voor het wachtwoord van de gebruiker
    private $email; // Privé eigenschap voor het e-mailadres van de gebruiker
    private $adres; // Privé eigenschap voor het adres van de gebruiker

    public function __construct($id, $gebruikersnaam, $wachtwoord, $email, $adres) {
        $this->id = $id; // Initialiseer de ID van de gebruiker
        $this->gebruikersnaam = $gebruikersnaam; // Initialiseer de gebruikersnaam van de gebruiker
        $this->wachtwoord = $wachtwoord; // Initialiseer het wachtwoord van de gebruiker
        $this->email = $email; // Initialiseer het e-mailadres van de gebruiker
        $this->adres = $adres; // Initialiseer het adres van de gebruiker
    }

    // Getter-methode voor ID
    public function getId() {
        return $this->id; // Retourneer de ID van de gebruiker
    }

    // Getter-methode voor gebruikersnaam
    public function getGebruikersnaam() {
        return $this->gebruikersnaam; // Retourneer de gebruikersnaam van de gebruiker
    }

    // Getter-methode voor e-mail
    public function getEmail() {
        return $this->email; // Retourneer het e-mailadres van de gebruiker
    }

    // Getter-methode voor adres
    public function getAdres() {
        return $this->adres; // Retourneer het adres van de gebruiker
    }

    // Getter-methode voor wachtwoord
    public function getWachtwoord() {
        return $this->wachtwoord; // Retourneer het wachtwoord van de gebruiker
    }
}
?>
