<?php

namespace entity;

/**
 * Class Comment
 * @package entity
 */

class Comment
{
    /**
     * @var colonnes de la table des commentaires
     */
    private $id;
    private $comment;
    private $commentDate;
    private $chapterId;
    private $membreId;
    private $membrePseudo;
    private $statut;
    /**
     * @var : variables contenant le livre et le chapitre associé aux commentaires
     */
    private $chapter;
    private $book;

    /**
     * @param array $donnees : permet d'appeler les setters
     */
    public function hydrate(array $donnees)
    {
        foreach ($donnees as $key => $value)
        {
            // On récupère le nom du setter correspondant à l'attribut.
            $method = 'set'.ucfirst($key);
            // Si le setter correspondant existe.
            if (method_exists($this, $method))
            {
                // On appelle le setter.
                $this->$method($value);
            }
        }
    }

    /**
     * @return mixed
     */
    public function getStatut ()
    {
        return $this->statut;
    }

    /**
     * @param mixed $statut
     */
    public function setStatut ($statut)
    {
        $this->statut = $statut;
    }


    /**
     * @return mixed
     */
    public function getId ()
    {
        return $this->id;
    }

    /**
     * @param mixed $id
     */
    public function setId ($id)
    {
        $this->id = $id;
    }

    /**
     * @return mixed
     */
    public function getComment ()
    {
        return $this->comment;
    }

    /**
     * @param mixed $comment
     */
    public function setComment ($comment)
    {
        $this->comment = $comment;
    }

    /**
     * @return mixed
     */
    public function getCommentDate()
    {
        return $this->commentDate;
    }

    /**
     * @param mixed $commentDate
     */
    public function setCommentDate ($commentDate)
    {
        $this->commentDate = $commentDate;
    }

    /**
     * @return mixed
     */
    public function getChapterId()
    {
        return $this->chapterId;
    }

    /**
     * @param mixed $chapterId
     */
    public function setChapterId ($chapterId)
    {
        $this->chapterId = $chapterId;
    }



    /**
     * @param mixed $postId
     */
    public function setPostId ($chapterId)
    {
        $this->chapterId = $chapterId;
    }

    /**
     * @return mixed
     */
    public function getMembreId()
    {
        return $this->membreId;
    }

    /**
     * @param mixed $membreId
     */
    public function setMembreId($membreId)
    {
        $this->membreId = $membreId;
    }

    /**
     * @return mixed
     */
    public function getMembrePseudo()
    {
        return $this->membrePseudo;
    }

    /**
     * @param mixed $membrePseudo
     */
    public function setMembrePseudo ($membrePseudo)
    {
        $this->membrePseudo = $membrePseudo;
    }

    /**
     * @return mixed
     */
    public function getChapter ()
    {
        return $this->chapter;
    }

    /**
     * @param mixed $chapter
     */
    public function setChapter ($chapter)
    {
        $this->chapter = $chapter;
    }

    /**
     * @return mixed
     */
    public function getBook ()
    {
        return $this->book;
    }

    /**
     * @param mixed $book
     */
    public function setBook ($book)
    {
        $this->book = $book;
    }


}