<?php
<<<<<<< Updated upstream
=======
session_start();
//
//class Book {0
//    private $title;
//    private $author;
//    private $description;
//    private $price;
//    private $userId;
//
//    public function __construct($title, $author, $description, $price, $userId) {
//        $this->title = $title;
//        $this->author = $author;
//        $this->description = $description;
//        $this->price = $price;
//        $this->userId = $userId;
//    }
//
//    // Getter-methodes
//    public function getTitle() {
//        return $this->title;
//    }
//
//    public function getAuthor() {
//        return $this->author;
//    }
//
//    public function getDescription() {
//        return $this->description;
//    }
//
//    public function getPrice() {
//        return $this->price;
//    }
//
//    public function getUserId() {
//        return $this->userId;
//    }
//}
//?>


<?php
>>>>>>> Stashed changes
session_start(); // Start of hervat sessie

class Book
{
    private $title; // Privé eigenschap voor de titel van het boek
    private $author; // Privé eigenschap voor de auteur van het boek
    private $description; // Privé eigenschap voor de beschrijving van het boek
    private $price; // Privé eigenschap voor de prijs van het boek
    private $userId; // Privé eigenschap voor de gebruikers-ID van de eigenaar van het boek

    public function __construct($title, $author, $description, $price, $userId)
    {
        $this->title = $title; // Initialiseer de titel van het boek
        $this->author = $author; // Initialiseer de auteur van het boek
        $this->description = $description; // Initialiseer de beschrijving van het boek
        $this->price = $price; // Initialiseer de prijs van het boek
        $this->userId = $userId; // Initialiseer de gebruikers-ID van de eigenaar van het boek
    }

    // Getter-methoden om de waarden van de eigenschappen op te halen

    public function getTitle()
    {
        return $this->title; // Retourneer de titel van het boek
    }

    public function getAuthor()
    {
        return $this->author; // Retourneer de auteur van het boek
    }

    public function getDescription()
    {
        return $this->description; // Retourneer de beschrijving van het boek
    }

    public function getPrice()
    {
        return $this->price; // Retourneer de prijs van het boek
    }

    public function getUserId()
    {
        return $this->userId; // Retourneer de gebruikers-ID van de eigenaar van het boek
    }
}

?>
