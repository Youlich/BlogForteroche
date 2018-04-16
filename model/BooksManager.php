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
    /**
     * @return array : tableau de tous les livres
     */

    public function getBooks()
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

    /**
     * @param $Id : affiche un livre selon son id indiqué en paramètre
     * @return Books
     */

    public function getBook($Id)
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

    /**
     * @param $title : permet d'ajouter un nouveau livre avec son titre obligatoire
     * @return bool
     */
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
            return true;
        } else {
            return false;
        }
    }



}