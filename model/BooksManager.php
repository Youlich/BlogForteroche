<?php
namespace model;
use entity\Books;

/**
 * Class BooksManager
 * @package model
 * Class qui permet la gestion des livres dans la table books
 */
class BooksManager extends Manager
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
    public function addBook(Books $book)
    {
        $db = $this->dbConnect();
        $req = $db->prepare('INSERT INTO books (title) VALUES (?)');
        $Addbook = $req->execute(array($book->getTitle()));
        while ($data = $req->fetch()) {
            $bookadd= new Books();
            $bookadd->setTitle($book->getTitle());
        }
        if ($Addbook == "success") {
            return true;
        } else {
            return false;
        }
    }



}