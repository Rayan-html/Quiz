<?php
session_start();

class Book {
    private $title;
    private $author;
    private $description;
    private $price;
    private $userId;

    public function __construct($title, $author, $description, $price, $userId) {
        $this->title = $title;
        $this->author = $author;
        $this->description = $description;
        $this->price = $price;
        $this->userId = $userId;
    }

    // Getter-methodes
    public function getTitle() {
        return $this->title;
    }

    public function getAuthor() {
        return $this->author;
    }

    public function getDescription() {
        return $this->description;
    }

    public function getPrice() {
        return $this->price;
    }

    public function getUserId() {
        return $this->userId;
    }
}
?>
