<?php
namespace model;
use entity\Books;

require_once("DbConnect.php");

/**
 * Class BooksManager
 * @package model
 * Class qui permet la gestion des livres dans la table books
 */
class BooksManager extends DbConnect
{
    public function getBooks() // Affiche tous les livres
    {
        $books = array();
        $db = $this->dbConnect();
        $req = $db->query('SELECT * FROM books');
        while ($data = $req->fetch()) {
            $book = new Books();
            $book->hydrate($data);
            $books[] = $book;
        }
        return $books;
    }

    public function getBook($Id) // affiche un livre selon son Id
    {
        $db = $this->dbConnect();
        $req = $db->prepare('SELECT * FROM books WHERE id = ?');
        $req->execute(array($Id));
        while ($data = $req->fetch()) {
            $book = new Books();
            $book->hydrate($data);
        }
        return $book;
    }

    public function AddBook($title)
    {
        $db = $this->dbConnect();
        $req = $db->prepare('INSERT INTO books (title) VALUES (?)');
        $Addbook = $req->execute(array($title));
        while ($data = $req->fetch()) {
            $bookadd= new Books();
            $bookadd->setTitle($title);
        }
        if ($Addbook == "success") {
            $_SESSION['success'] = "Votre nouveau titre de livre est bien créé";
            return $_SESSION['success'];
        } else {
            $_SESSION['error'] = "Votre nouveau titre de livre n'a pas pu être créé, retentez plus tard";
            return $_SESSION['error'];
        }
    }



}