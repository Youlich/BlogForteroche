<?php

namespace entity;


class Comment
{
    private $id;
    private $comment;
    private $commentDate;
    private $chapterId;
    private $membreId;
    private $membrePseudo;
    private $etat;

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
    public function getEtat ()
    {
        return $this->etat;
    }

    /**
     * @param mixed $etat
     */
    public function setEtat ($etat)
    {
        $this->etat = $etat;
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
     * @param mixed $postId
     */
    public function setPostId ($chapterId)
    {
        $this->chapterId = $chapterId;
    }

    /**
     * @return mixed
     */
    public function getMembreId ()
    {
        return $this->membreId;
    }

    /**
     * @param mixed $membreId
     */
    public function setMembreId ($membreId)
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


}